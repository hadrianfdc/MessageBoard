<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class FriendsListController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList');

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
    
    
    
}