<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller
{
    public $components = array(
        'DebugKit.Toolbar',
        'Session'
    );
    public $uses = array('User', 'Posts','Notification', 'FriendsListNotification');
    public function beforeFilter()
    {
        parent::beforeFilter();

        // Check if user_id is not set in the session
        if (empty($this->Session->read('Auth.User.user_id'))) {

            $allowedActions = array('login', 'new_user');
            if (!in_array($this->request->params['action'], $allowedActions)) {
                $this->redirect(array('controller' => 'Logins', 'action' => 'login'));
            }
        }
        if ($this->Session->read('Auth.User.user_id')) {
            $user_id = $this->Session->read('Auth.User.user_id');
            $user = $this->User->find('first', [
                'conditions' => ['User.user_id' => $user_id]
            ]);
            $findMyPic = $this->Posts->find('first', [
                'conditions' => ['Posts.id' => $user_id]
            ]);
            $this->set(compact('user', 'findMyPic'));
        }

        $this->myNotifications();
    }

    protected function isUserLoggedIn(){
        return $this->Session->check('User.user_id');
    }

    protected function isLoginPage(){
        return $this->request->params['controller'] === 'Logins' && $this->request->params['actions'] === 'login';
    }

    public function Myprofile() {
        $this->layout = null;
        $user_id = $this->Session->read('Auth.User.user_id');
        $findUser = $this->User->find('all', [
            'conditions' => ['User.user_id' => $user_id]
        ]);
        $findMyPic = $this->Posts->find('all', [
            'conditions' => ['Posts.user_id' => $user_id]
        ]);
        $this->set('findMyPic', $findMyPic);
        $this->set('user', $findUser);
        
    }

    public function myNotifications() {
        $this->layout = null;
        
        $user_id = $this->Session->read('Auth.User.user_id');
        
        $friendsListNotifications = $this->FriendsListNotification->find('all', [
            'conditions' => [

                    'FriendsListNotification.for_who_acceptor' => $user_id
            ],
            'fields' => ['FriendsListNotification.id', 'FriendsListNotification.for_who_acceptor', 'FriendsListNotification.from_who_user_id', 'FriendsListNotification.type', 'FriendsListNotification.created', 'FriendsListNotification.is_seen'],
            'order' => ['FriendsListNotification.created' => 'desc'] 
        ]);
        
        // Fetch regular notifications
        $notifications = $this->Notification->find('all', [
            'conditions' => [
                'Notification.author' => $user_id
            ],
            'fields' => ['Notification.id', 'Notification.author', 'Notification.type', 'Notification.description', 'Notification.created', 'Notification.is_seen'],
            'order' => ['Notification.created' => 'desc']  // Latest notifications first
        ]);
        
        $allNotifications = [];
        
        // Loop through FriendsList notifications
        foreach ($friendsListNotifications as $friendNotification) {
            $findName = $this->User->find('first', [
                'conditions' => ['User.user_id' => $friendNotification['FriendsListNotification']['from_who_user_id']],
                'fields' => ['User.full_name']
            ]);
            $findImage = $this->Posts->find('first', [
                'conditions' => ['Posts.id' => $friendNotification['FriendsListNotification']['from_who_user_id']],
                'fields' => ['Posts.path']
            ]);
            $allNotifications[] = [
                'id' => $friendNotification['FriendsListNotification']['id'],
                'type' => $friendNotification['FriendsListNotification']['type'],
                'created' => $friendNotification['FriendsListNotification']['created'],
                'is_seen' => $friendNotification['FriendsListNotification']['is_seen'],
                'source' => 'friends_list', 
                'details' => [
                    'for_who_acceptor' => $friendNotification['FriendsListNotification']['for_who_acceptor'],
                    'from_who_user_id' => $friendNotification['FriendsListNotification']['from_who_user_id'],
                    'full_name' => $findName['User']['full_name'],
                    'profile_pic' => $findImage['Posts']['path']
                ]
            ];
        }
        
        // Loop through regular notifications
        foreach ($notifications as $notification) {
            $findName = $this->User->find('first', [
                'conditions' => ['User.user_id' => $notification['Notification']['author']],
                'fields' => ['User.full_name']
            ]);
            $findImage = $this->Posts->find('first', [
                'conditions' => ['Posts.id' => $notification['Notification']['author']],
                'fields' => ['Posts.path']
            ]);
            $allNotifications[] = [
                'id' => $notification['Notification']['id'],
                'type' => $notification['Notification']['type'],
                'created' => $notification['Notification']['created'],
                'is_seen' => $notification['Notification']['is_seen'],
                'source' => 'notification', 
                'details' => [
                    'description' => $notification['Notification']['description'],
                    'full_name' => $findName['User']['full_name'],
                    'profile_pic' => $findImage['Posts']['path']
                ]
            ];
        }
        
        usort($allNotifications, function ($a, $b) {
            return strtotime($b['created']) - strtotime($a['created']);
        });
        
        // echo "<pre>"; print_r($allNotifications); echo "</pre>"; 
        
        $this->set('allNotifications', $allNotifications);
    }
    
    
}
