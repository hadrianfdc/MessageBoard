<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class FriendsListController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'FriendsListNotification');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function deleteFriendRequest() {
        if ($this->request->is('ajax')) {
            $requestId = $this->request->data['request_id'];
            $userId = $this->request->data['user_id'];
            
            // Check if the friend request exists and the current user is the one who made the request
            $friendRequest = $this->FriendsList->find('first', [
                'conditions' => [
                    'FriendsList.id' => $requestId,
                    'FriendsList.user_id' => $userId
                ]
            ]);
    
            if ($friendRequest) {
                // Delete the friend request from the table
                if ($this->FriendsList->delete($requestId)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
    
            // Ensure the response is set to JSON
            $this->autoRender = false;
            $this->response->type('json');
        }
    }

    public function addFriendRequest() {
        if ($this->request->is('ajax')) {
            $friendUserId = $this->request->data['friend_user_id'];
            $userId = $this->request->data['user_id'];
            
            $existingRequest = $this->FriendsList->find('first', [
                'conditions' => [
                    'OR' => [
                        ['FriendsList.user_id' => $userId, 'FriendsList.acceptor' => $friendUserId],
                        ['FriendsList.user_id' => $friendUserId, 'FriendsList.acceptor' => $userId]
                    ]
                ]
            ]);
    
            if (!$existingRequest) {
                $this->FriendsList->create();
                $data = [
                    'user_id' => $userId,
                    'acceptor' => $friendUserId,
                    'status' => 'pending'
                ];
    
                if ($this->FriendsList->save($data)) {
                    echo json_encode(['success' => true]);
                    $type = 1;
                    $this->saveToNotificationList($data , $type);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                // Friend request already exists
                echo json_encode(['success' => false]);
            }
    
            // Ensure the response is set to JSON
            $this->autoRender = false;
            $this->response->type('json');
        }
    }
    
    public function acceptFriendRequest() {
        if ($this->request->is('ajax')) {

            $friendUserId = $this->request->data['friend_user_id'];
            $userId = $this->request->data['user_id'];
            
            $friendRequest = $this->FriendsList->find('first', [
                'conditions' => [
                    'FriendsList.user_id' => $friendUserId,
                    'FriendsList.acceptor' => $userId,
                    'FriendsList.status' => 'pending'
                ]
            ]);
            
            if ($friendRequest) {
                $friendRequest['FriendsList']['status'] = 'accepted';
                
                if ($this->FriendsList->save($friendRequest)) {
                    echo json_encode(['success' => true]);
                    $type = 2;
                    $data = [
                        'user_id' => $userId,
                        'acceptor' => $friendUserId
                    ];
                    $this->saveToNotificationList($data, $type);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
            
            $this->autoRender = false;
            $this->response->type('json');
        }
    }

    public function unfriend() {
        if ($this->request->is('ajax')) {

            $friendUserId = $this->request->data['friend_user_id'];
            $userId = $this->request->data['user_id'];
    
            $friendship = $this->FriendsList->find('first', [
                'conditions' => [
                    'FriendsList.user_id' => $userId,
                    'FriendsList.acceptor' => $friendUserId,
                    'FriendsList.status' => 'accepted'
                ]
            ]);
    
            if ($friendship) {
                if ($this->FriendsList->delete($friendship['FriendsList']['id'])) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
    
            $this->autoRender = false;
            $this->response->type('json');
        }
    }


    public function searchFriends() {
        $this->autoRender = false;
        $this->layout = null;
    
        if ($this->request->is('get')) {
            $query = $this->request->query['query'];
    
            // Find users matching the search query
            $results = $this->User->find('all', [
                'conditions' => [
                    'User.full_name LIKE' => '%' . $query . '%'
                ],
                'fields' => ['User.user_id', 'User.full_name', 'User.is_online'],
                'limit' => 10
            ]);
    
            $friends = [];
            foreach ($results as $result) {
                $userId = $result['User']['user_id'];
                $fullName = $result['User']['full_name'];
    
                $profilePic = $this->Posts->find('first', [
                    'conditions' => ['Posts.id' => $userId],
                    'fields' => ['Posts.path']
                ]);
    
                $profilePicPath = isset($profilePic['Posts']['path']) ? $profilePic['Posts']['path'] : 'path/to/default/profile-pic.jpg';

                $isFriend = $this->FriendsList->find('first', [
                    'conditions' => [
                        'OR' => [
                            [
                                'FriendsList.user_id' => $this->Session->read('Auth.User.user_id'),
                                'FriendsList.acceptor' => $userId
                            ],
                            [
                                'FriendsList.user_id' => $userId,
                                'FriendsList.acceptor' => $this->Session->read('Auth.User.user_id')
                            ]
                        ]
                    ]
                ]);
                
                //    echo "<pre>"; print_r($isFriend); echo "</pre>"; 
                $friends[] = [
                    'user_id' => $userId,
                    'full_name' => $fullName,
                    'profile_pic' => $profilePicPath,
                    'is_online' => $result['User']['is_online'],
                    'is_friend' => empty($isFriend) ? false : true
                ];
            }
    
            echo json_encode($friends);
        }
    }

    private function saveToNotificationList($data, $type){


        $User = $this->User->find('first',array(
            'conditions' => ['User.user_id' => $data['acceptor']]
        ));
        $this->FriendsListNotification->create();
        $notification = [
            'FriendsListNotification' => [
                'for_who_acceptor' => $data['acceptor'],
                'from_who_user_id' => $data['user_id'],
                'type' => $type,
                'created' => date('Y-m-d H:i:s'), 
                'is_seen' => 0
            ]
        ];
        $this->FriendsListNotification->set($notification);

        if($User['User']['friend_req_notif'] == 1){
            if(!$this->FriendsListNotification->save()){
                $this->response->body(json_encode(['success' => true, 'message' => 'Notification was not save successfully.']));
            }
        }
    }

    public function updateSeen() {
        $this->autoRender = false;
        $this->response->type('json');
    
        if ($this->request->is('post')) {
            $data = json_decode($this->request->input(), true);
    
            $notifId = $data['id'];
            $notifSource = $data['source'];
    
            if ($notifSource === 'friends_list') {
                $this->loadModel('FriendsListNotification');
                $this->FriendsListNotification->id = $notifId;
                if ($this->FriendsListNotification->save(['is_seen' => 1])) {
                    return json_encode(['success' => true]);
                }
            } elseif ($notifSource === 'notification') {
                $this->loadModel('Notification');
                $this->Notification->id = $notifId;
                if ($this->Notification->save(['is_seen' => 1])) {
                    return json_encode(['success' => true]);
                }
            }
        }
    
        return json_encode(['success' => false]);
    }
    
    
    
    
    
}