<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class UserProfilesController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('UserProfiles');
    }

    public function user_profile()
    {

        $this->layout = null;


        $user_id = $this->Session->read('Auth.User.user_id');


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
        $userProfileData = $this->UserProfiles->find('all', [
            'conditions' => ['UserProfiles.user_id' => $user_id],
            'contain' => 'ProfileDetails'
        ]);

        $this->set('userProfileData', $userProfileData);
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

            if ($this->UserProfiles->save($userData)) {
                $this->Session->setFlash(__('User details updated successfully.'), 'flash', array('class' => 'success'));
            } else {
                $this->Session->setFlash(__('Failed to update user details.'), 'flash', array('class' => 'error'));
            }
        }

        return $this->redirect(array('controller' => 'UserProfiles', 'action' => 'user_profile'));
    }
}
