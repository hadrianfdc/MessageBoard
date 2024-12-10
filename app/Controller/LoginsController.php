<?php

class LoginsController extends AppController
{
    public $components = array('Flash');
    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'MyDayStory');

    public function login()
    {
        $this->layout = null;
        $this->loadModel('Logins');

        if ($this->request->is('post')) {
            $this->Logins->set($this->request->data);

            if ($this->Logins->validates()) {
                $email = $this->request->data['Logins']['email'];
                $enteredPassword = $this->request->data['Logins']['password'];

                $user = $this->Logins->find('first', array(
                    'conditions' => array('email' => $email)
                ));

                if ($user) {
                    $hashedEnteredPassword = Security::hash($enteredPassword, 'blowfish', $user['Logins']['password']);

                    if ($hashedEnteredPassword === $user['Logins']['password']) {

                        $this->Logins->id = $user['Logins']['user_id'];
                        $this->Logins->saveField('last_login_time', date('Y-m-d H:i:s'));

                        // Update is_online to 1
                        $this->Logins->saveField('is_online', 1);

                        $this->Session->write('Auth.User.user_id', $user['Logins']['user_id']);
                        $this->Session->write('Auth.User.full_name', $user['Logins']['full_name']);


                        $this->set('success', true);
                    } else {
                        $this->set('success', false);
                    }
                } else {

                    $this->redirect(array('controller' => 'registers', 'action' => 'new_user'));
                }
            } else {
                $this->redirect(array('controller' => 'registers', 'action' => 'new_user'));
            }
        }
    }

    public function logout()
    {
        $this->loadModel('Logins');

        $user_id = $this->Session->read('Auth.User.user_id');

        if (!empty($user_id)) {
            $this->Logins->id = $user_id;
            $this->Logins->saveField('is_online', 0);
        }
        $this->Logins->saveField('last_login_time',  date('Y-m-d H:i:s'));

        $this->Session->delete('Auth.User');
        CakeSession::delete('Auth.User.user_id');
        CakeSession::delete('Auth.User.full_name');

        $this->redirect(['controller' => 'logins', 'action' => 'login']);
    }


    public function change_password()
    {
        $this->layout = null;
    }


    public function changePassword()
    {
        $this->layout = null;
        if ($this->request->is('post')) {
            $this->loadModel('Registers');

            if ($this->Registers->validates()) {
                $user_id = $this->Session->read('Auth.User.user_id');
                $user = $this->Registers->find('first', array(
                    'conditions' => array(
                        'user_id' => $user_id
                    )
                ));

                // $this->log(print_r($this->request->data, true));
                $oldPassword = $this->request->data['Registers']['old_password'];
                $newPassword = $this->request->data['Registers']['password'];
                $confirmPassword = $this->request->data['Registers']['confirm_password'];

                $hashedEnteredPassword = Security::hash($oldPassword, 'blowfish', $user['Registers']['password']);

                if ($hashedEnteredPassword === $user['Registers']['password']) {

                    if ($newPassword !== $confirmPassword) {
                        $message = 'New Password and Confirm Password do not match';
                        $this->set('message', $message);
                        $this->set('success', false);
                        return;
                    } else {

                        $hashedPassword = Security::hash($newPassword, 'sha256', true);
                        $this->Registers->set('password', $hashedPassword);
                        $user['Registers']['password'] = $this->request->data['Registers']['password'];
                    

                        if ($this->Registers->save($user)) {
                            $this->set('success', true);
                        } else {
                            $message = 'New Password does not save!';
                            $this->set('message', $message);
                            $this->set('success', false);
                        }
                    }
                } else {
                    $message = 'Old Password is incorrect';
                    $this->set('message', $message);
                    $this->set('success', false);
                }
            } else {
                $this->Flash->error('Please correct the errors below.');
            }
        }
    }

    public function changePasswordJson()
    {
        $this->layout = null;
        $this->autoRender = false; // Prevent default view rendering
        
        if ($this->request->is('post')) {
            $this->loadModel('Registers');

            if ($this->Registers->validates()) {
                $user_id = $this->Session->read('Auth.User.user_id');
                $user = $this->Registers->find('first', array(
                    'conditions' => array(
                        'user_id' => $user_id
                    )
                ));

                // $this->log(print_r($this->request->data, true));
                $oldPassword = $this->request->data['Registers']['old_password'];
                $newPassword = $this->request->data['Registers']['password'];
                $confirmPassword = $this->request->data['Registers']['confirm_password'];

                $hashedEnteredPassword = Security::hash($oldPassword, 'blowfish', $user['Registers']['password']);

                if ($hashedEnteredPassword === $user['Registers']['password']) {

                    if ($newPassword !== $confirmPassword) {
                        $response = array(
                            'success' => false,
                            'message' => 'New Password and Confirm Password do not match'
                        );
                        echo json_encode($response);
                        return;
                    }

                    $hashedPassword = Security::hash($newPassword, 'sha256', true);
                    $user['Registers']['password'] = $hashedPassword;

                    if ($this->Registers->save($user)) {
                        $response = array(
                            'success' => true,
                            'message' => 'Password updated successfully'
                        );
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Failed to save the new password'
                        );
                    }
                } else {
                    $response = array(
                        'success' => false,
                        'message' => 'Old Password is incorrect'
                    );
                }
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Validation failed. Please correct the errors below.'
                );
            }

            echo json_encode($response);
            return;
        }
    }

}
