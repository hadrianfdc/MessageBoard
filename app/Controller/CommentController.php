<?php

class CommentController extends AppController
{
    public $uses = ['Reactions', 'User', 'ProfilePost', 'Notification', 'Comment'];

    public function beforeFilter()
    {
        parent::beforeFilter();
    }


    public function getComments($postId) {
        $this->autoRender = false; 
        $this->response->type('json');
    
        $comments = $this->Comment->find('all', [
            'conditions' => ['Comment.profile_post_id' => $postId],
            'order' => ['Comment.created' => 'ASC']
        ]);
    
        $comentsUserData = [];
        foreach ($comments as $comment) {
            $findName = $this->User->find('first', [
                'fields' => ['User.full_name'],
                'conditions' => ['User.user_id' => $comment['Comment']['user_id']]
            ]);
            $findCommenterImage = $this->Posts->find('first', [
                'fields' => ['Posts.id', 'Posts.path'],
                'conditions' => ['Posts.id' => $comment['Comment']['user_id']]
            ]);


            $comentsUserData[] = [
                'profile_post_id' => $comment['Comment']['profile_post_id'],
                'full_name' => $findName['User']['full_name'],
                'profile_picture' => $findCommenterImage['Posts']['path'],
                'comment' => $comment['Comment']['comment'],
                'images' => $comment['Comment']['images'],
                'created' => $comment['Comment']['created']
            ];
        }
    
        echo json_encode($comentsUserData);
    }

    public function saveComment() {
        $this->autoRender = false;
        $this->response->type('json');
        
        if ($this->request->is('post')) {
            $data = $this->request->data;
    
            $user_id = $this->Session->read('Auth.User.user_id');
            
            if (empty($data['profile_post_id']) || empty($data['comment'])) {
                $response = ['status' => 'error', 'message' => 'All fields are required.'];
                echo json_encode($response);
                return;
            }
    
            $file = $this->request->params['form']['file']; 
    
            if (isset($file['name']) && !empty($file['name'])) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
                if (in_array($file['type'], $allowedTypes)) {
                    $uploadPath = WWW_ROOT . 'images' . DS;
                    $filename = $file['name'];
                    $uploadFile = $uploadPath . $filename;
    
                    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                        $filePath = 'images/' . $filename;
                    } else {
                        $response = ['status' => 'error', 'message' => 'Error uploading file: ' . $file['name']];
                        echo json_encode($response);
                        return;
                    }
                } else {
                    $response = ['status' => 'error', 'message' => 'Invalid file type: ' . $file['name']];
                    echo json_encode($response);
                    return;
                }
            }
    
            // Save comment in the database
            $this->Comment->create();
    
            $commentData = [
                'profile_post_id' => $data['profile_post_id'],
                'user_id' => $user_id,
                'images' => isset($filePath) ? $filePath : null,  
                'comment' => $data['comment'],
                'created' => date('Y-m-d H:i:s')
            ];
    
            if ($this->Comment->save($commentData)) {
                $response = ['status' => 'success', 'message' => 'Comment posted successfully.'];
                echo json_encode($response);
            } else {
                $response = ['status' => 'error', 'message' => 'Unable to save comment. Please try again.'];
                echo json_encode($response);
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Invalid request type.'];
            echo json_encode($response);
        }
    }
    
    
    
    
}