<?php

App::uses('AppController', 'Controller');
App::uses('UserProfilesController', 'Controller');
App::uses('User', 'Model');



class PageController extends AppController
{
    public $components = array('Flash', 'Session');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'MyDayStory', 'Event', 'Page');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function createPage(){
        $this->autoRender = false;
        $this->layout - null;

        if($this->request->is('post')) {

            $data = $this->request->data;

            // echo "<pre>"; print("Data : " ); print_r($data); "</pre>"; 

            if( isset($data['Page']['profile_picture'])) {

                $filename = $this->imageUploader($data);
                $new['Page']['profile_picture'] = $filename;
            }

            if( isset($data['Page']['cover_photo']) ) {

                $filename = $this->imageUploader($data);
                $new['Page']['cover_photo'] = $filename;
            }

            $new['Page']['category'] = $data['Page']['category'];
            if($data['Page']['category'] == 'Other' && !empty($data['Page']['other_category'])) 
            {
                $new['Page']['category'] = $data['Page']['other_category'];
            }
            $new['Page']['name'] = $data['Page']['name'];
            $new['Page']['created_by'] = $this->Session->read('Auth.User.user_id');
            $new['Page']['created_at'] = date('Y-m-d H:i:s');
            $new['Page']['description'] = $data['Page']['description'];

            $this->Page->create();
            $this->Page->save($new);
            if( $this->Page->save($new) ) {
                $this->redirect('/page');
            }else{
                echo "<pre>"; print_r($new); echo "</pre>";
            }
        }
    }


    public function imageUploader($data){

        if ( isset($data['Page']['profile_picture']['name']) && !empty($data['Page']['profile_picture']['name']) ) {
            $file = $data['Page']['profile_picture'];

            $uploadPath = WWW_ROOT . 'images' . DS;

            if($file['error'] == 0){
                if (in_array($file['type'], ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'])) {
                    $filename = $file['name'];
                    $uploadFile = $uploadPath . $filename;

                    if(move_uploaded_file($file['tmp_name'], $uploadFile)){
                        return "images/" . $filename;
                    }else {
                       $this->log('Error uploading file: ' . $file['name'], 'error');
                    }
                }else {
                    $this->log('Invalid file type: ' . $file['name'], 'error');
                }
            }else {
                $this->log('There is an error with the file: ' . $file['name'], 'error');
            }

        } 
        if ( isset($data['Page']['cover_photo']['name']) && !empty($data['Page']['cover_photo']['name']) ) {
            $file = $data['Page']['cover_photo'];

            $uploadPath = WWW_ROOT . 'images' . DS;

            if($file['error'] == 0){
                if (in_array($file['type'], ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'])) {
                    $filename = $file['name'];
                    $uploadFile = $uploadPath . $filename;

                    if(move_uploaded_file($file['tmp_name'], $uploadFile)){
                        return "images/" . $filename;
                    }else {
                        $this->log('Error uploading file: ' . $file['name'], 'error');
                    }
                }else {
                    $this->log('Invalid file type: ' . $file['name'], 'error');
                }
            }else {
                $this->log('There is an error with the file: ' . $file['name'], 'error');
            }

        } 
        return;
    }
}