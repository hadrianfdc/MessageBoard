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
    public $uses = array('User', 'Posts');
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
    
}
