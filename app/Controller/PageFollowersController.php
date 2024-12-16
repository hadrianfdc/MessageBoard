<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class PageFollowersController extends AppController
{
    public $components = array('Flash', 'Session');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'MyDayStory', 'Event', 'Page', 'PageFollowers');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function like() {
        $this->autoRender = false;
        // Check if the request is AJAX
        if ($this->request->is('ajax')) {
            $response = array('success' => false); 

            $pageId = $this->request->data['page_id'];
            $userId = $this->Session->read('Auth.User.user_id');

            $existingFollow = $this->PageFollowers->find('first', array(
                'conditions' => array(
                    'PageFollowers.page_id' => $pageId,
                    'PageFollowers.user_id' => $userId
                )
            ));

            if (!$existingFollow) {
                $this->PageFollowers->create();
                $this->PageFollowers->save(array(
                    'page_id' => $pageId,
                    'user_id' => $userId,
                    'followed_at' => date('Y-m-d H:i:s')
                ));
                $response = array('success' => true); 
            }

            echo json_encode($response);
        }
    }

    public function unLike() {

        if ($this->request->is('ajax')) {
            $response = array('success' => false); 

            $pageId = $this->request->data['page_id'];
            $userId = $this->Session->read('Auth.User.user_id');

            $existingFollow = $this->PageFollowers->find('first', array(
                'conditions' => array(
                    'PageFollowers.page_id' => $pageId,
                    'PageFollowers.user_id' => $userId
                )
            ));

            if ($existingFollow) {
                $this->PageFollowers->delete($existingFollow['PageFollowers']['id']);
                $response['success'] = true;
            }

            echo json_encode($response);
            $this->autoRender = false;
        }
    }

    public function likePage() {
        $this->autoRender = false; 
    
        if ($this->request->is('ajax')) {
            $userId = $this->Session->read('Auth.User.user_id');
            $pageId = $this->request->data['page_id'];
            $action = $this->request->data['action']; 
    
            if ($action == 'Like') {
                $this->PageFollowers->create();
                $this->PageFollowers->save([
                    'page_id' => $pageId,
                    'user_id' => $userId,
                    'followed_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->PageFollowers->deleteAll([
                    'page_id' => $pageId,
                    'user_id' => $userId
                ]);
            }
    
            // Return success response
            echo json_encode(['success' => true]);
        }
    }
    

}