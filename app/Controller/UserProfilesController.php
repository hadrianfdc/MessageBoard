<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class UserProfilesController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'MyDayStory');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    public function newsfeed() {
        $this->layout = null;
        $this->checkReactNullOrEmpty();
        $user_id = $this->Session->read('Auth.User.user_id');

        $friendIdsResult = $this->FriendsList->find('all', [
            'conditions' => [
                'OR' => [
                    ['FriendsList.user_id' => $user_id],
                    ['FriendsList.acceptor' => $user_id]
                ],
                'FriendsList.status' => 'accepted' // Only accepted friends
            ],
            'fields' => ['FriendsList.user_id', 'FriendsList.acceptor']
        ]);
        
        $friendIds = [];
        foreach ($friendIdsResult as $friend) {
            $friendIds[] = $friend['FriendsList']['user_id'];
            $friendIds[] = $friend['FriendsList']['acceptor'];
        }
        $friendIds = array_unique($friendIds);
        $friendIds[] = $user_id;
                
        $findPost = $this->ProfilePost->find('all', [
            'conditions' => [
                'OR' => [
                    ['ProfilePost.privacy' => 1, 'ProfilePost.user_id' => $user_id],
                    ['ProfilePost.privacy' => [2, 3]]
                ],
                'ProfilePost.is_archieve !=' => 1, 
                'ProfilePost.user_id' => $friendIds, // Only posts from friends
                'OR' => [
                    ['ProfilePost.sharer_id' => null], 
                    ['ProfilePost.sharer_id' => $friendIds] 
                ]
            ],
            'order' => ['ProfilePost.user_id' => 'ASC', 'ProfilePost.created_date' => 'DESC', 'ProfilePost.date_shared' => 'DESC'],
        ]);

        $organizedPosts = $this->getPost($findPost);
        $organizedMyDaysPost = $this->getMyDayAndStory();
        // echo "<pre>"; print_r($organizedPosts); echo "</pre>"; 

        if (empty($user_id)) {
            $this->redirect(['controller' => 'logins', 'action' => 'login']);
        }
        $findUsers = $this->User->find('all', [
            'conditions' => ['User.user_id' => $user_id]
        ]);
        $findMyPics = $this->Posts->find('all', [
            'conditions' => ['Posts.id' => $user_id]
        ]);

        $this->getFriendList();
     
        $this->set('findMyPics', $findMyPics);
        $this->set('users', $findUsers);
        $this->set('findPost', $organizedPosts);
        $this->set('user_id', $user_id);
        $this->set('organizedMyDaysPost', $organizedMyDaysPost);
    }

    public function getFriendList() {

        $user_id = $this->Session->read('Auth.User.user_id');
    

        $friendIdsResult = $this->FriendsList->find('all', [
            'conditions' => [
                'OR' => [
                    ['FriendsList.user_id' => $user_id],
                    ['FriendsList.acceptor' => $user_id]
                ],
                'FriendsList.status' => 'accepted' 
            ],
            'fields' => ['FriendsList.user_id', 'FriendsList.acceptor']
        ]);
    
        $friendsData = [];
    
        foreach ($friendIdsResult as $friend) {

            $friendUserIds = [
                $friend['FriendsList']['user_id'],
                $friend['FriendsList']['acceptor']
            ];
    
         
            $friendUserIds = array_diff($friendUserIds, [$user_id]);
    
            foreach ($friendUserIds as $friendUserId) {

                $user = $this->User->find('first', [
                    'conditions' => ['User.user_id' => $friendUserId],
                    'fields' => ['User.full_name', 'User.is_online','User.user_id'] 
                ]);
    
                $profilePicture = $this->Posts->find('first', [
                    'conditions' => ['Posts.id' => $friendUserId],
                    'fields' => ['Posts.id', 'Posts.path'] 
                ]);
    
                $friendsData[] = [
                    'user_id' => $user['User']['user_id'], 
                    'full_name' => $user['User']['full_name'], 
                    'profile_picture' => isset($profilePicture['Posts']['path']) ? $profilePicture['Posts']['path'] : 'default.jpg' ,
                    'is_online' => $user['User']['is_online']
                ];
            }
        }
    
        // echo "<pre>"; print_r($friendsData); echo "</pre>"; 
        // Set the data to be available in the view
        $this->set('friendsData', $friendsData);
    }
    

    private function checkReactNullOrEmpty(){
        $posts = $this->ProfilePost->find('all', array(
            'conditions' => array('ProfilePost.react' => NULL),
        ));
    
        foreach ($posts as $post) {
            if (empty($post['ProfilePost']['react'])) {
                // Default reaction counts
                $reactionCounts = [
                    'Like' => 0,
                    'Love' => 0,
                    'Care' => 0,
                    'Haha' => 0,
                    'Wow' => 0,
                    'Sad' => 0,
                    'Angry' => 0
                ];
    
                // Update the 'react' field with the default reaction counts
                $post['ProfilePost']['react'] = json_encode($reactionCounts);
    
                // Save the updated post
                $this->ProfilePost->save($post);
            }
        }
    }
    
    
    private function getPost($findPost){
        $organizedPosts = [];
        if (!empty($findPost)) {
            $reactor = $this->Session->read('Auth.User.user_id');
            foreach ($findPost as $key => $post) {
                $myReaction = $this->Reactions->find('first', [
                    'fields' => ['Reactions.reaction_type'],
                    'conditions' => [
                        'Reactions.user_id' => $this->Session->read('Auth.User.user_id'),
                        'Reactions.profile_post_id' => $post['ProfilePost']['id']
                    ]
                ]);
                $certainReaction = $this->Reactions->find('first', [
                    'fields' => ['Reactions.reaction_type', 'Reactions.profile_post_id', 'Reactions.user_id'],
                    'conditions' => [
                        'Reactions.profile_post_id' => $post['ProfilePost']['id']
                    ],
                    'order' => ['Reactions.created' => 'DESC']
                ]);
                $myNameOrSharerName = $this->User->find('first', [
                    'fields' => ['User.full_name', 'User.is_online'],
                    'conditions' => [
                        'User.user_id' => $post['ProfilePost']['user_id']
                    ]
                ]);
                $sharerName = '';
                if(!empty($post['ProfilePost']['sharer_id'])){
                    $findSharerName = $this->User->find('first', [
                        'fields' => ['User.full_name'],
                        'conditions' => [
                            'User.user_id' => $post['ProfilePost']['sharer_id']
                        ]
                    ]);
                    $sharerName = $findSharerName['User']['full_name'];
                }
                $recentReactorName = '';
                if (!empty($certainReaction) && !empty($certainReaction['Reactions']['user_id'])) {
                    $recentReactor = $this->User->find('first', [
                        'fields' => ['User.full_name'],
                        'conditions' => [
                            'User.user_id' => $certainReaction['Reactions']['user_id']
                        ]
                    ]);

                    if (!empty($recentReactor) && !empty($recentReactor['User']['full_name'])) {
                        $recentReactorName = $recentReactor['User']['full_name'];
                    }
                }
                $totalNumberOfSharedPost = $this->ProfilePost->find('count', [
                    'conditions' => [
                        'ProfilePost.shared_id' => $post['ProfilePost']['id']
                    ]
                ]);    

                $originalPrivacy = '';
                if (!empty($post['ProfilePost']['shared_id']) || $post['ProfilePost']['shared_id'] != NULL) {
                    $findOriginalPrivacy = $this->ProfilePost->find('first', [
                        'fields' => ['ProfilePost.privacy'],
                        'conditions' => [
                            'ProfilePost.id' => $post['ProfilePost']['shared_id']
                        ]
                    ]);     
                    if (!empty($findOriginalPrivacy)) {
                        $originalPrivacy = $findOriginalPrivacy['ProfilePost']['privacy'];
                    }
                } 
                $certainReaction = isset($certainReaction['Reactions']['reaction_type'])
                        ? [
                            1 => 'Like',
                            2 => 'Heart',
                            3 => 'Care',
                            4 => 'Haha',
                            5 => 'Wow',
                            6 => 'Sad',
                            7 => 'Angry'
                        ][$certainReaction['Reactions']['reaction_type']] : '';
                if (!empty($post['ProfilePost'])) {
                    $organizedPost = [
                        'id' => $post['ProfilePost']['id'],
                        'user_id' => $post['ProfilePost']['user_id'],
                        'reactor' => $reactor,
                        'my_reaction' => isset($myReaction['Reactions']['reaction_type']) ? $myReaction['Reactions']['reaction_type'] : 0,
                        'other_reaction' => $certainReaction,
                        'recent_reactor' => $recentReactorName,
                        'fullname' => $myNameOrSharerName['User']['full_name'],
                        'is_online' => $myNameOrSharerName['User']['is_online'],
                        'captions' => $post['ProfilePost']['captions'],
                        'react' => $post['ProfilePost']['react'],
                        'is_pinned' => $post['ProfilePost']['is_pinned'],
                        'is_saved' => $post['ProfilePost']['is_saved'],
                        'is_archieve' => $post['ProfilePost']['is_archieve'],
                        'privacy' => $post['ProfilePost']['privacy'],
                        'file_paths' => json_decode($post['ProfilePost']['file_paths']),
                        'is_shared' => $post['ProfilePost']['is_shared'],
                        'shared_id' => $post['ProfilePost']['shared_id'],
                        'sharer_caption' => $post['ProfilePost']['sharer_caption'],
                        'sharer_id' => $post['ProfilePost']['sharer_id'],
                        'sharer_full_name' =>  $sharerName,
                        'original_privacy' => $originalPrivacy,
                        'total_number_of_shared_post' => $totalNumberOfSharedPost,
                        'date_shared' => $post['ProfilePost']['date_shared'],
                        'created_date' => $post['ProfilePost']['created_date'],
                        'updated_date' => $post['ProfilePost']['updated_date'],
                        'images' => [] 
                    ];
                    
                    $findImage = $this->Posts->find('all', [
                        'fields' => ['Posts.id', 'Posts.path'],
                        'conditions' => ['Posts.id' => $post['ProfilePost']['user_id']]
                    ]);
                    $findSharerImage = $this->Posts->find('all', [
                        'fields' => ['Posts.id', 'Posts.path'],
                        'conditions' => ['Posts.id' => $post['ProfilePost']['sharer_id']]
                    ]);
    
                    if (!empty($findImage)) {
                        foreach ($findImage as $image) {
                            $organizedPost['images'][] = $image['Posts']['path'];
                        }
                    }
                    if (!empty($findSharerImage)) {
                        foreach ($findSharerImage as $image) {
                            $organizedPost['sharer_images'][] = $image['Posts']['path'];
                        }
                    }
                    $organizedPosts[] = $organizedPost;
                }
            }
        }
        // $this->log(print_r($organizedPosts, true), 'error');
        return $organizedPosts;
    }

    private function getMyDayAndStory(){

        $findAll = $this->MyDayStory->find('all', [
            'fields' => [
                'MyDayStory.id',
                'MyDayStory.user_id',
                'MyDayStory.path',
                'MyDayStory.date_created'
            ],
            'order' => ['MyDayStory.date_created' => 'DESC'],
        ]);
    
        $organizedData = [];
    
        foreach ($findAll as $story) {

            $findUserDetails = $this->User->find('first', [
                'fields' => ['User.full_name', 'User.is_online'],
                'conditions' => ['User.user_id' => $story['MyDayStory']['user_id']] 
            ]);
            $findProfilePic = $this->Posts->find('first', [
                'fields' => ['Posts.path'],
                'conditions' => ['Posts.id' => $story['MyDayStory']['user_id']] 
            ]);

            $organizedData[] = [
                'id' => $story['MyDayStory']['id'],
                'profile_picture' => !empty($findProfilePic['Posts']['path']) ? $findProfilePic['Posts']['path'] : '',
                'full_name' => $findUserDetails['User']['full_name'],
                'is_online' => $findUserDetails['User']['is_online'],
                'user_id' => $story['MyDayStory']['user_id'],
                'image_story' => $story['MyDayStory']['path'],
                'date_created' => $story['MyDayStory']['date_created'],
            ];
        }
    
        return $organizedData;
    }
    
    

    public function createPost(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $data = $this->request->data['Posts'];
            //  echo "<pre>"; print_r($data); echo "</pre>"; die();
            $getFullname = $this->User->find('first', [
                'fields' => ['User.full_name'],
                'conditions' => ['User.user_id' => $this->Session->read('Auth.User.user_id')]
            ]);

            if (isset($data['file'][0]['name']) && !empty($data['file'][0]['name'])) {
                $files = $data['file'];

                $uploadPath = WWW_ROOT . 'images' . DS;
                $filePaths = [];

                foreach($files as $file){
                    if($file['error'] == 0){
                        if (in_array($file['type'], ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'])) {
                            $filename = $file['name'];
                            $uploadFile = $uploadPath . $filename;

                            if(move_uploaded_file($file['tmp_name'], $uploadFile)){
                                $filePaths[] = 'images/' . $filename;
                            }else {
                                echo "<pre>"; $this->Session->setFlash('Error uploading file: ' . $file['name']); echo "</pre>"; die();
                            }
                        }else {
                            echo "<pre>"; $this->Session->setFlash('Invalid file type: ' . $file['name']); echo "</pre>"; die();
                        }
                    }else {
                        echo "<pre>"; $this->Session->setFlash('Error with file upload!'); echo "</pre>"; die();
                    }
                }

            } 

            $this->ProfilePost->create();
            
            $post = [
                'user_id' => $this->Session->read('Auth.User.user_id'),
                'fullname' => $getFullname['User']['full_name'],
                'captions' => $data['captions'],
                'privacy' => $data['privacy'],
                'file_paths' => json_encode($filePaths),
                'react' => 0,
                'created_date' => date('Y-m-d H:i:s')
            ];  
            if($this->ProfilePost->save($post)){
                $this->redirect(array('action' => 'newsfeed'));
            }else{
                $this->Session->setFlash('Error saving data!');
                echo "<pre>"; print_r($post); echo "</pre>"; die();
            }
        }
    }
    
    public function user_profile()
    {

        $this->layout = null;


        $user_id = $this->Session->read('Auth.User.user_id');

        $findPost = $this->ProfilePost->query("
            SELECT * 
            FROM profile_posts as ProfilePost
            WHERE ProfilePost.is_archieve = 0
            AND (
                (ProfilePost.user_id = {$user_id} AND ProfilePost.sharer_id IS NULL) 
                OR (ProfilePost.user_id = {$user_id} AND ProfilePost.sharer_id = {$user_id})
            )
            ORDER BY 
                ProfilePost.is_pinned DESC, 
                ProfilePost.date_shared DESC, 
                ProfilePost.created_date DESC
        ");

//  echo "<pre>"; print_r($findPost); echo "</pre>"; die();
        $organizedPosts = $this->getPost($findPost);

        if (empty($user_id)) {
            return $this->redirect(array('controller' => 'logins', 'action' => 'logut'));
        }

        $this->loadModel('Posts');
        $imageRecord = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $user_id]
        ]);
        $this->set(compact('imageRecord'));

        if (empty($user_id)) {
            $this->redirect(['controller' => 'logins', 'action' => 'login']);
        }

        $this->loadModel('UserProfiles');
        $this->loadModel('Posts');
        $this->loadModel('ProfilePost');
        $userProfileData = $this->UserProfiles->find('all', [
            'conditions' => ['UserProfiles.user_id' => $user_id]
        ]);

        $user_id = $this->Session->read('Auth.User.user_id');
        if (empty($user_id)) {
            $this->redirect(['controller' => 'logins', 'action' => 'login']);
        }
        $findUsers = $this->User->find('all', [
            'conditions' => ['User.user_id' => $user_id]
        ]);
        $findMyPics = $this->Posts->find('all', [
            'conditions' => ['Posts.id' => $user_id]
        ]);
        $photoList = $this->photoGrid();
        
        $this->set('findMyPics', $findMyPics);
        $this->set('users', $findUsers);

        $this->set('userProfileData', $userProfileData);
        $this->set('findPost', $organizedPosts);
        $this->set('photoList', $photoList); 
        $this->set('user_id', $user_id);
    }

    public function user_profile_by_others()
    {
        $this->layout = null;
        $user_id = $this->request->params['pass'][0];
        $my_user_Id = $this->Session->read('Auth.User.user_id');
        $isAFriend = $this->isFriend($this->Session->read('Auth.User.user_id'), $user_id);

        $findPost = $this->ProfilePost->query("
            SELECT * 
            FROM profile_posts as ProfilePost
            WHERE ProfilePost.is_archieve = 0
            AND (
                (ProfilePost.user_id = {$user_id} AND ProfilePost.sharer_id IS NULL) 
                OR (ProfilePost.user_id = {$user_id} AND ProfilePost.sharer_id = {$user_id})
            )
            ORDER BY 
                ProfilePost.is_pinned DESC, 
                ProfilePost.date_shared DESC, 
                ProfilePost.created_date DESC
        ");

        $organizedPosts = $this->getPost($findPost);

        if (empty($user_id)) {
            return $this->redirect(array('controller' => 'logins', 'action' => 'logut'));
        }

        $this->loadModel('Posts');
        $imageRecord = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $user_id]
        ]);
        $this->set(compact('imageRecord'));

        $this->loadModel('UserProfiles');
        $this->loadModel('Posts');
        $this->loadModel('ProfilePost');
        $userProfileData = $this->UserProfiles->find('all', [
            'conditions' => ['UserProfiles.user_id' => $user_id]
        ]);

        $findUsers = $this->User->find('all', [
            'conditions' => ['User.user_id' => $user_id]
        ]);
        $findMyPics = $this->Posts->find('all', [
            'conditions' => ['Posts.id' => $user_id]
        ]);
        // echo "<pre>"; print_r($isAFriend); echo "</pre>"; 
        $photoList = $this->photoGridOthers($user_id);
        $this->set('myPhoto', $findMyPics);
        $this->set('findMyPics', $findMyPics);
        $this->set('users', $findUsers);
        // echo "<pre>"; print_r($findUsers); echo "</pre>"; die();
        $this->set('userProfileData', $userProfileData);
        $this->set('findPost', $organizedPosts);
        $this->set('photoList', $photoList); 
        $this->set('user_id', $user_id);
        $this->set('isAFriend', $isAFriend);
        $this->set('my_user_Id', $my_user_Id);
        $this->set('acceptor', $user_id);
    }
    private function photoGridOthers($user_id) {
        $this->layout = null; 
    
        $findAllPhotos = $this->ProfilePost->find('all', [
            'fields' => ['ProfilePost.file_paths'], 
            'conditions' => ['ProfilePost.user_id' => $user_id], 
        ]);
    
        $photoList = [];
        foreach ($findAllPhotos as $post) {
            if (!empty($post['ProfilePost']['file_paths'])) {
                $decodedPaths = json_decode($post['ProfilePost']['file_paths'], true); // Decode JSON
                if (is_array($decodedPaths)) {
                    $photoList = array_merge($photoList, $decodedPaths); // Merge into one list
                }
            }
        }
        return $photoList;
    }

    private function isFriend($user_id, $friend_id) {
        $findIfExist = $this->FriendsList->find('first', [
            'conditions' => [
                'OR' => [
                    // Check if the current user sent the request
                    [
                        'FriendsList.user_id' => $user_id,
                        'FriendsList.acceptor' => $friend_id,
                    ],
                    // Check if the current user received the request
                    [
                        'FriendsList.user_id' => $friend_id,
                        'FriendsList.acceptor' => $user_id,
                    ],
                ],
            ],
        ]);
    
        return $findIfExist;
    }
    

    private function photoGrid() {
        $this->layout = null; 
    
        $user_id = $this->Session->read('Auth.User.user_id');
    
        $findAllPhotos = $this->ProfilePost->find('all', [
            'fields' => ['ProfilePost.file_paths'], 
            'conditions' => ['ProfilePost.user_id' => $user_id], 
        ]);
    
        $photoList = [];
        foreach ($findAllPhotos as $post) {
            if (!empty($post['ProfilePost']['file_paths'])) {
                $decodedPaths = json_decode($post['ProfilePost']['file_paths'], true); // Decode JSON
                if (is_array($decodedPaths)) {
                    $photoList = array_merge($photoList, $decodedPaths); // Merge into one list
                }
            }
        }
        return $photoList;
    }
    

    public function userprofiledetails($id = null)
    {

        $this->layout = null;


        if (empty($id)) {
            return $this->redirect(array('controller' => 'logins', 'action' => 'logut'));
        }

        $this->loadModel('Posts');


        $imageRecord = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $id]
        ]);


        $this->set(compact('imageRecord'));

        if (empty($id)) {
            $this->redirect(['controller' => 'logins', 'action' => 'login']);
        }

        $this->loadModel('UserProfiles');
        $this->loadModel('Posts');
        $userProfileData = $this->UserProfiles->find('all', [
            'conditions' => ['UserProfiles.user_id' => $id],
            'contain' => 'ProfileDetails'
        ]);

        $this->set('userProfileData', $userProfileData);
    }





    public function editDetails()
    {
        $userId = $this->Session->read('Auth.User.user_id');
        $userData = $this->UserProfiles->findByUserId($userId);

        if (!$userData) {
            $this->Session->setFlash(__('User profile not found.'), 'flash', array('class' => 'error'));
            return $this->redirect(array('controller' => 'UserProfiles', 'action' => 'user_profile'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $userData['UserProfiles']['full_name'] = $this->request->data['full_name'];
            $userData['UserProfiles']['gender'] = $this->request->data['gender'];
            $userData['UserProfiles']['birthdate'] = $this->request->data['birthdate'];
            $userData['UserProfiles']['hobby'] = $this->request->data['hobby'];
            $userData['UserProfiles']['links'] = $this->request->data['links'];
            $userData['UserProfiles']['education'] = $this->request->data['education'];
            $userData['UserProfiles']['work'] = $this->request->data['work'];
            $userData['UserProfiles']['relationship'] = $this->request->data['relationship'];
            $userData['UserProfiles']['location'] = $this->request->data['location'];

            if ($this->UserProfiles->save($userData)) {
                $this->Session->setFlash(__('User details updated successfully.'), 'flash', array('class' => 'success'));
                $this->ProfilePost->updateAll(
                    array('ProfilePost.fullname' => "'" . $this->request->data['full_name'] . "'"),
                    array('ProfilePost.sharer_full_name' => "'" . $this->request->data['full_name'] . "'"),
                    array('ProfilePost.user_id' => $userId)
                );
            } else {
                $this->Session->setFlash(__('Failed to update user details.'), 'flash', array('class' => 'error'));
            }
        }

        return $this->redirect(array('controller' => 'UserProfiles', 'action' => 'user_profile'));
    }

    public function post_whats_on_your_mind()
    {

        $this->autoRender = false;
        $this->loadModel('ProfilePost');
        $userID = $this->Session->read('Auth.User.user_id');

        if ($this->request->is('post')) {
            $this->ProfilePost->create();
            $data = array(
                'ProfilePost' => array(
                    'user_id' => $userID,
                    'captions' => $this->request->data['captions'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'fullname' => $this->Session->read('Auth.User.full_name')
                )
            );
            if ($this->ProfilePost->save($data)) {
                $this->response->statusCode(200);
                echo json_encode(array('success' => true));
            } else {
                $this->response->statusCode(400);

                // Log error message along with data
                $errorMessage = "Error saving data: " . json_encode($data) . ". Error: " . $this->User->validationErrorsToString();
                error_log($errorMessage);

                echo json_encode(array('success' => false, 'data' => $data));
            }
        }
        return;
    }

    public function togglePin()
    {
        $this->autoRender = false;
        $this->response->type('json');
        $this->loadModel('ProfilePost');
    
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
            // $this->log(print_r($data, true), 'error');
            $postId = $data['post_id'];
            $isPinned = $data['is_pinned'];
    
            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                $post['ProfilePost']['is_pinned'] = $isPinned;
                $post['ProfilePost']['updated_date'] = date('Y-m-d H:i:s'); 
                if ($this->ProfilePost->save($post)) {
                    return $this->response->body(json_encode(['success' => true]));
                }
            }
        }
    
        return $this->response->body(json_encode(['success' => false]));
    }

    public function toggleArchieve()
    {
        $this->autoRender = false;
        $this->response->type('json');
        $this->loadModel('ProfilePost');
    
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
            // $this->log(print_r($data, true), 'error');
            $postId = $data['post_id'];
            $isPinned = $data['is_archieve'];
    
            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                $post['ProfilePost']['is_archieve'] = $isPinned;
                $post['ProfilePost']['updated_date'] = date('Y-m-d H:i:s'); 
                if ($this->ProfilePost->save($post)) {
                    return $this->response->body(json_encode(['success' => true]));
                }
            }
        }
    
        return $this->response->body(json_encode(['success' => false]));
    }
    
    public function toggleTrash()
    {
        $this->autoRender = false; 
        $this->response->type('json'); 
        $this->loadModel('ProfilePost'); 

        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true); 

            $postId = $data['post_id']; 

            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                if ($this->ProfilePost->delete($postId)) {
                    
                } else {
                    $this->log("Failed to delete Post ID {$postId}.", 'error'); 
                }
            } else {
                $this->log("Post ID {$postId} not found.", 'error'); 
            }
        }

        return $this->response->body(json_encode(['success' => false])); 
    }

    public function getPostDetails($postId)
    {
        $this->autoRender = false;
        $this->response->type('json');

        $post = $this->ProfilePost->find('first', [
            'conditions' => ['ProfilePost.id' => $postId],
            'fields' => ['id', 'captions', 'privacy', 'file_paths', 'sharer_caption'], 
            'contain' => ['PostImages' => ['fields' => ['path']]]
        ]);

        if ($post) {
            $data = $this->response->body(json_encode([
                'success' => true,
                'data' => [
                    'id' => $post['ProfilePost']['id'],
                    'captions' => $post['ProfilePost']['captions'],
                    'privacy' => $post['ProfilePost']['privacy'],
                    'file_paths' => $post['ProfilePost']['file_paths'],
                    'sharer_caption' => $post['ProfilePost']['sharer_caption']
                ]
            ]));
            // $this->log(print_r($data, true), 'error');
            return $data;
        }

        return $this->response->body(json_encode(['success' => false]));
    }

    public function editPost()
    {
        $this->autoRender = false;
        $this->response->type('json');

        if ($this->request->is('post')) {
            $data = $this->request->data['Posts'];
            // $this->log(print_r($data, true), 'error');

            // Get data from the form
            $postId = $data['id'] ?? null; 
            $captions = $data['captions'] ?? ''; 
            $sharer_captions = $data['sharer_caption'] ?? ''; 
            $privacy = $data['privacy'] ?? null; 
            $files = $data['file'] ?? [];

            // Validate required fields
            if (!$postId || $captions === '' || $privacy === null) {
                $this->log("Invalid data: Missing required fields.", 'error');
                return $this->response->body(json_encode(['success' => false, 'message' => 'Invalid data.']));
            }

            // Find the post to update
            $post = $this->ProfilePost->findById($postId);
            if (!$post) {
                $this->log("Post ID {$postId} not found.", 'error');
                return $this->response->body(json_encode(['success' => false, 'message' => 'Post not found.']));
            }

            // Update the captions and privacy fields
            $post['ProfilePost']['captions'] = $captions;
            $post['ProfilePost']['sharer_caption'] = $sharer_captions;
            $post['ProfilePost']['privacy'] = $privacy;
            $post['ProfilePost']['updated_date'] = date('Y-m-d H:i:s'); 

            // If files were uploaded, process them
            if (!empty($files)) {
                $uploadedPaths = [];
                foreach ($files as $file) {
                    if ($file['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = WWW_ROOT . 'images' . DS; 
                        $fileName = basename($file['name']);
                        $targetPath = $uploadDir . $fileName;
                        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                            $uploadedPaths[] = 'images/' . $fileName; 
                        } else {
                            $this->log("Failed to upload file: {$file['name']}", 'error');
                        }
                    }
                }

                $existingFilePaths = json_decode($post['ProfilePost']['file_paths'], true);
                $updatedFilePaths = array_merge($existingFilePaths, $uploadedPaths);

                $post['ProfilePost']['file_paths'] = json_encode($updatedFilePaths);
            }

            // Save the updated post data
            if ($this->ProfilePost->save($post)) {
                $this->redirect(['controller' => 'UserProfiles', 'action' => 'user_profile']);
            } else {
                $this->log("Failed to update Post ID {$postId}.", 'error');
                return $this->response->body(json_encode(['success' => false, 'message' => 'Failed to update post.']));
            }
        }

        // If not a POST request
        $this->log("Invalid request method.", 'error');
        return $this->response->body(json_encode(['success' => false, 'message' => 'Invalid request method.']));
    }


    public function updatePostPrivacy() {
        $this->autoRender = false;
        $this->response->type('json');
    
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
    
            $postId = $data['post_id']; 
            $privacy = $data['privacy']; 
    
            // Find the post to update
            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                // Update the privacy field
                $post['ProfilePost']['privacy'] = $privacy;
                $post['ProfilePost']['updated_date'] = date('Y-m-d H:i:s'); 
                if ($this->ProfilePost->save($post)) {
                    return $this->response->body(json_encode(['success' => true]));
                } else {
                    $this->log("Failed to update privacy for Post ID {$postId}.", 'error'); 
                }
            } else {
                $this->log("Post ID {$postId} not found.", 'error'); 
            }
        }
    
        return $this->response->body(json_encode(['success' => false]));
    }

    public function sharedPost() {
        $this->autoRender = false;
        $this->response->type('json');
        
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
            $postId = $data['post_id']; 
            $reactor = $this->Session->read('Auth.User.user_id');
            $findSharerName = $this->User->find('first', array(
                'fields' => array('User.full_name'),
                'conditions' => array('User.user_id' => $reactor)
            ));

            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                $shareNow = [
                    'ProfilePost' => [
                        'user_id' => $post['ProfilePost']['user_id'],
                        'fullname' => $post['ProfilePost']['fullname'],
                        'captions' => $post['ProfilePost']['captions'],
                        'file_paths' => $post['ProfilePost']['file_paths'],
                        'privacy' => $post['ProfilePost']['privacy'],
                        'is_pinned' => 0,
                        'is_archieve' => 0,
                        'shared_id' => $post['ProfilePost']['id'],
                        'react' => NULL,
                        'is_shared' => 1,
                        'sharer_id' => $reactor,
                        'sharer_full_name' => $findSharerName['User']['full_name'],
                        'date_shared' => date('Y-m-d H:i:s'),
                        'created_date' => $post['ProfilePost']['created_date']
                    ]
                ];

                $this->ProfilePost->create();
                if ($this->ProfilePost->save($shareNow)) {
                    $this->response->body(json_encode(['success' => true]));
                } else {
                    $this->log("Failed to share Post ID {$postId}.", 'error');
                    $this->response->body(json_encode(['success' => false]));
                }
            } else {
                $this->log("Post ID {$postId} not found.", 'error');
                $this->response->body(json_encode(['success' => false]));
            }
        }
    }
    
    
    public function getSharedUsers($postId) {
        $this->autoRender = false; 
        $this->response->type('json');
    
        $sharedUsers = $this->ProfilePost->find('all', [
            'conditions' => ['ProfilePost.shared_id' => $postId],
            'fields' => ['sharer_full_name', 'date_shared', 'sharer_id', 'privacy'],
            'order' => ['date_shared' => 'DESC']
        ]);
    
        $sharedUsersData = [];
        foreach ($sharedUsers as $user) {
            $findName = $this->User->find('first', [
                'fields' => ['User.full_name'],
                'conditions' => ['User.user_id' => $user['ProfilePost']['sharer_id']]
            ]);
            $findSharerImage = $this->Posts->find('first', [
                'fields' => ['Posts.id', 'Posts.path'],
                'conditions' => ['Posts.id' => $user['ProfilePost']['sharer_id']]
            ]);
            $sharedUsersData[] = [
                'sharer_full_name' => $findName['User']['full_name'],
                'date_shared' => $user['ProfilePost']['date_shared'],
                'privacy' => $user['ProfilePost']['privacy'],
                'profile_picture' => $findSharerImage['Posts']['path']
            ];
        }
    
        echo json_encode($sharedUsersData);
    }
    


    public function update_dark_mode() {
        if ($this->request->is('post')) {
            $userId = $this->request->data('user_id');
    
            $user = $this->User->find('first', array('conditions' => array('User.user_id' => $userId)));
            if ($user) {
                $currentDarkModeSetting = $user['User']['is_dark_setting'];
    
                $newDarkModeSetting = ($currentDarkModeSetting == 1) ? 0 : 1;
    
                $this->User->id = $userId;
                if ($this->User->saveField('is_dark_setting', $newDarkModeSetting)) {
                    $this->set([
                        'success' => true,
                        'is_dark_setting' => $newDarkModeSetting,
                        '_serialize' => ['success', 'is_dark_setting']
                    ]);
                } else {
                    $this->set([
                        'success' => false,
                        '_serialize' => ['success']
                    ]);
                }
            } else {
                $this->set([
                    'success' => false,
                    '_serialize' => ['success']
                ]);
            }
        }
    }
    

}
