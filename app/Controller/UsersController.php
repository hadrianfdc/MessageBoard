<?php


class UsersController extends AppController
{
    public function index()
    {
        $this->set('users', $this->User->find('all'));
    }


    public function search()
    {
        $this->layout = null;

        $this->loadModel('User');
        $this->loadModel('Post');

        // Fetch all users
        $users = $this->User->find('all');

        // Extract user ids
        $userIds = [];
        foreach ($users as $user) {
            $userIds[] = $user['User']['user_id']; 
        }

        // Find posts associated with users
        $imageRecords = $this->Post->find('all', [
            'conditions' => ['Post.id IN' => $userIds]
        ]);

        // Reorganize image records by user_id for easier access
        $imagesByUser = [];
        foreach ($imageRecords as $record) {
            $userId = $record['Post']['id']; 
            if (!isset($imagesByUser[$userId])) {
                $imagesByUser[$userId] = [];
            }
            $imagesByUser[$userId][] = $record;
        }

        $this->set(compact('users', 'imagesByUser'));
    }
}
