<?php

class ConversationsController extends AppController {

    public function index() {

        $user_id = $this->Session->read('Auth.User.user_id');
        $conversations = $this->Conversation->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Conversation.user1_id' => $user_id,
                    'Conversation.user2_id' => $user_id
                )
            ),
            'contain' => array('User1', 'User2')
        ));
        $this->set('conversations', $conversations);
    }

    public function view($conversation_id = null) {
        if (!$conversation_id) {
            // Handle case when no conversation_id is provided
            $this->redirect(array('action' => 'index'));
        }
        $conversation = $this->Conversation->find('first', array(
            'conditions' => array('Conversation.id' => $conversation_id),
            'contain' => array('User1', 'User2')
        ));
        if (!$conversation) {
            // Handle case when conversation is not found
            $this->redirect(array('action' => 'index'));
        }
        $this->set('conversation', $conversation);
    }

    // Additional actions for creating, updating, deleting conversations can be added here
}


?>
