<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class UserProfilesController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    public function newsfeed() {
        $this->layout = null;
        $this->checkReactNullOrEmpty();
        $user_id = $this->Session->read('Auth.User.user_id');

        $findPost = $this->ProfilePost->find('all', array(
            'conditions' => array(
                   'OR' => array(
                        array(
                            'ProfilePost.privacy' => 1,
                            'ProfilePost.user_id' => $user_id
                        ),
                        array(
                            'ProfilePost.privacy' => array(2, 3)
                        )
                    ),
                    'ProfilePost.is_archieve !=' => 1
            ),
            'order' => array('ProfilePost.created_date' => 'DESC','ProfilePost.date_shared' => 'DESC'),
        ));

        $organizedPosts = $this->getPost($findPost);

        if (empty($user_id)) {
            $this->redirect(['controller' => 'logins', 'action' => 'login']);
        }
        $findUsers = $this->User->find('all', [
            'conditions' => ['User.user_id' => $user_id]
        ]);
        $findMyPics = $this->Posts->find('all', [
            'conditions' => ['Posts.id' => $user_id]
        ]);
        // echo "<pre>"; print_r($organizedPosts); echo "</pre>"; die();
        $this->set('findMyPics', $findMyPics);
        $this->set('users', $findUsers);
        $this->set('findPost', $organizedPosts);
        $this->set('user_id', $user_id);
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
                        'fullname' => $post['ProfilePost']['fullname'],
                        'captions' => $post['ProfilePost']['captions'],
                        'react' => $post['ProfilePost']['react'],
                        'is_pinned' => $post['ProfilePost']['is_pinned'],
                        'is_saved' => $post['ProfilePost']['is_saved'],
                        'is_archieve' => $post['ProfilePost']['is_archieve'],
                        'privacy' => $post['ProfilePost']['privacy'],
                        'file_paths' => json_decode($post['ProfilePost']['file_paths']),
                        'is_shared' => $post['ProfilePost']['is_shared'],
                        'shared_id' => $post['ProfilePost']['shared_id'],
                        'sharer_id' => $post['ProfilePost']['sharer_id'],
                        'sharer_full_name' => isset($post['ProfilePost']['sharer_full_name']) ? $post['ProfilePost']['sharer_full_name'] : '',
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

        $findPost = $this->ProfilePost->find('all', array(
            'conditions' => array('ProfilePost.user_id' => $user_id, 'ProfilePost.is_archieve' => 0),
            'order' => array('ProfilePost.is_pinned' => 'DESC','ProfilePost.created_date' => 'DESC'),
        ));

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
        // echo "<pre>"; print_r($organizedPosts); echo "</pre>"; die();
        $this->set('findMyPics', $findMyPics);
        $this->set('users', $findUsers);

        $this->set('userProfileData', $userProfileData);
        $this->set('findPost', $organizedPosts);
        $this->set('photoList', $photoList); 
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
                    $this->log($this->response->body(json_encode(['success' => true]), 'error'));
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
                    $this->log($this->response->body(json_encode(['success' => true]), 'error'));
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
            $this->log(print_r($data, true), 'error'); 

            $postId = $data['post_id']; 

            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                if ($this->ProfilePost->delete($postId)) {
                    $this->log("Post ID {$postId} deleted successfully.", 'error'); 
                    return $this->response->body(json_encode(['success' => true])); 
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
            'fields' => ['id', 'captions', 'privacy', 'file_paths'], 
            'contain' => ['PostImages' => ['fields' => ['path']]]
        ]);

        if ($post) {
            $data = $this->response->body(json_encode([
                'success' => true,
                'data' => [
                    'id' => $post['ProfilePost']['id'],
                    'captions' => $post['ProfilePost']['captions'],
                    'privacy' => $post['ProfilePost']['privacy'],
                    'file_paths' => $post['ProfilePost']['file_paths'] 
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
            $this->log(print_r($data, true), 'error');

            // Get data from the form
            $postId = $data['id'] ?? null; 
            $captions = $data['captions'] ?? ''; 
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
                $this->log("Post ID {$postId} updated successfully.", 'error');
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
            $this->log(print_r($data, true), 'error');
    
            $postId = $data['post_id']; 
            $privacy = $data['privacy']; 
    
            // Find the post to update
            $post = $this->ProfilePost->findById($postId);
            if ($post) {
                // Update the privacy field
                $post['ProfilePost']['privacy'] = $privacy;
                $post['ProfilePost']['updated_date'] = date('Y-m-d H:i:s'); 
                if ($this->ProfilePost->save($post)) {
                    $this->log("Post ID {$postId} privacy updated to {$privacy}.", 'error'); 
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
    
    



}
