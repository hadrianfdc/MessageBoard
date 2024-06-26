<?php

class LoginsController extends AppController
{
    public $components = array('Flash');


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

                $oldPassword = $this->request->data['Registers']['old_password'];
                $newPassword = $this->request->data['Registers']['password'];
                $confirmPassword = $this->request->data['Registers']['confirm_password'];

                $hashedEnteredPassword = Security::hash($oldPassword, 'blowfish', $user['Registers']['password']);

                if ($hashedEnteredPassword === $user['Registers']['password']) {

                    if ($newPassword !== $confirmPassword) {
                        $this->set('success', false);
                        return;
                    } else {

                        $hashedPassword = Security::hash($newPassword, 'sha256', true);
                        $this->Registers->set('password', $hashedPassword);
                        $user['Registers']['password'] = $this->request->data['Registers']['password'];
                    

                        if ($this->Registers->save($user)) {
                            $this->set('success', true);
                        } else {
                            $this->set('success', false);
                        }
                    }
                } else {
                    $this->set('success', false);
                }
            } else {
                $this->Flash->error('Please correct the errors below.');
            }
        }
    }
}
