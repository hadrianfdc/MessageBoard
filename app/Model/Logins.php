<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Logins extends AppModel
{
    public $useTable = 'users';
    public $primaryKey = 'user_id';

    public $validate = array(
        'email' => array(
            'rule' => 'email',
            'message' => 'Please enter a valid email address!'
        ),

        'password' => array(
            'rule' => 'notBlank',
            'message' => 'Please enter your password!'
        )
    );

    // public function beforeSave($options = array())
    // {
    //     if (isset($this->data[$this->alias]['password'])) {
    //         $passwordHasher = new BlowfishPasswordHasher();
    //         $this->data[$this->alias]['password'] = $passwordHasher->hash(
    //             $this->data[$this->alias]['password'] 
    //         );
    //     }
    // }

    public function beforeSave($options = array()){
        if(isset($this->data[$this->alias]['password'])){
            $this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], 'blowfish');
        }
        return true;
    }
    

}
