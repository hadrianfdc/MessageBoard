<?php

class RegistersController extends AppController
{



    public function new_user()
    {
        $this->layout = null;
        $this->loadModel('Registers');

        if ($this->request->is('post')) {
            $this->Registers->create();
            $this->Registers->set($this->request->data);

            $hashedPassword = Security::hash($this->request->data['Registers']['password'], 'sha256', true);
            $this->Registers->set('password', $hashedPassword);
            if ($this->Registers->validates()) {
                if ($this->Registers->save($this->request->data)) {
                    $user_id = $this->Registers->id;
                    $this->Session->write('Auth.User.user_id', $user_id);
                    $this->set('success', true);
                } else {
                    $this->set('success', false);
                }
            } else {
                $this->set('_serialize', ['success']);
            }
        }
    }


    public function thank_you()
    {
        $this->layout = null;
    }
}
