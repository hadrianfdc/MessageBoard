<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class MyDayStoryController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'MyDayStory');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function addStory() {

        $this->layout = null;
        $this->render = null;

        if ($this->request->is('post')) {
            $this->MyDayStory->create(); 
    
            $data = $this->request->data['MyDayStory'];
    
            // echo "<pre>"; print_r($data); echo "</pre>"; die();
            $data['user_id'] = $this->Session->read('Auth.User.user_id'); 
            $data['date_created'] = date('Y-m-d H:i:s'); 
    
            if (isset($data['file']['name']) && !empty($data['file']['name'])) {
                $file = $data['file']; 
    
                $uploadPath = WWW_ROOT . 'images' . DS;
    
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
    
                $validTypes = [
                    'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg',  
                    'video/mp4', 'video/webm', 'video/ogg'  
                ];
                
                if (in_array($file['type'], $validTypes)) {

                    $filename = time() . '_' . $file['name'];
                    $filePath = $uploadPath . $filename;
    
                    if (move_uploaded_file($file['tmp_name'], $filePath)) {

                        $data['path'] = 'images/' . $filename; 
    
                        if ($this->MyDayStory->save($data)) {
                            $this->log('Save Data : ' . print_r($data, true), 'error');
                            $this->redirect('/newsfeed');
                        } else {
                            $this->log('Failed to save Data : ' . print_r($data, true), 'error');
                            $this->redirect('/newsfeed');
                        }
                    } else {
                        $this->log('Failed to move Data : ' . print_r($data, true), 'error');
                        $this->redirect('/newsfeed');
                    }
                } else {
                    $this->log('Not Valid in Array Data : ' . print_r($data, true), 'error');
                    $this->redirect('/newsfeed');
                }
            } else {
                $this->log('No Path Name Data : ' . print_r($data, true), 'error');
                $this->redirect('/newsfeed');
            }
        }
    }
    
}