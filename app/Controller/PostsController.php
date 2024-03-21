<?php


class PostsController extends AppController
{
    public $components = ['Flash'];
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('Posts');
    }

    public function index()
    {

        $this->layout=null;
        $user_id = $this->Session->read('Auth.User.user_id');

        if(empty($user_id)){
            return $this->redirect(array('controller'=>'logins', 'action'=>'logut'));
        }


        $this->loadModel('Posts');

        $imageRecord = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $user_id]
        ]);


        $this->set(compact('imageRecord'));

        if ($this->request->is('post')) {
      
            if (!empty($this->request->data['Posts']['file']['name'])) {
                $file = $this->request->data['Posts']['file'];


                $filename = $file['name'];
                $uploadPath = WWW_ROOT . 'images' . DS; 
                $uploadFile = $uploadPath . $filename;

                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {

                    $this->Posts->create();
                    $this->request->data['Posts']['id'] = $user_id;
                    $this->request->data['Posts']['name'] = $filename;
                    $this->request->data['Posts']['path'] = 'images/' . $filename;
                    $this->request->data['Posts']['created'] = date("Y-m-d H:i:s");
                    $this->request->data['Posts']['modified'] = date("Y-m-d H:i:s");

            
                    if ($this->Posts->save($this->request->data)) {
                        $this->redirect(array('controller' => 'userprofiles', 'action' => 'user_profile'));
                    } else {
                        $this->Session->setFlash('Error saving data!');
                    }
                } else {
                    $this->Session->setFlash('Error uploading file!');
                }
            } else {
                $this->Session->setFlash('No file selected!');
            }
        }
    }
}
