<?php

    class Registers extends AppModel{
        public $useTable = 'users';
        public $primaryKey = 'user_id';
        public $validate = array (
            'full_name' => array(
                'rule' => array ('between', 5, 50),
                    'message' => 'Full name must be between 5 and 20 characters.'
            ),

            'email' => array(
                'rule' => 'isUnique',
                    'message' => 'Email is already taken.'
            ),

            'password' => array(
                'rule' => array('minLength', 8),
                'message' => 'Password must be at least 8 characters long.'
            ),

            'gender' => array(
                'rule' => array('inList', array('Male', 'Female', 'Others')),
                'message' => 'Invalid gender.'
            ),

            'birthdate' => array(
                'rule' => 'date',
                'message' => 'Invalid date format.'
            )
        );

        public function beforeSave($options = array()){
            if(isset($this->data[$this->alias]['password'])){
                $this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], 'blowfish');
            }
            return true;
        }
    }

?>