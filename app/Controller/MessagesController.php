<?php
class MessagesController extends AppController
{

    public $uses = array('User', 'Message'); // Add User model here

    public function index()
    {
        $this->layout = null;

        $user_id = $this->Session->read('Auth.User.user_id');
        $receivedMessages = $this->Message->find('all', array(
            'conditions' => array('Message.receiver_id' => $user_id),
            'contain' => array('Sender'),
            'order' => array('Message.timestamp' => 'DESC') // Order by timestamp in descending order
        ));
        $sentMessages = $this->Message->find('all', array(
            'conditions' => array('Message.sender_id' => $user_id),
            'contain' => array('Receiver'),
            'order' => array('Message.timestamp' => 'DESC') // Order by timestamp in descending order
        ));

        $this->set(compact('receivedMessages', 'sentMessages'));
    }




    public function view($conversation_id)
    {
        // Fetch messages for the selected conversation
        $messages = $this->Message->find('all', array(
            'conditions' => array('Message.conversation_id' => $conversation_id),
            'order' => array('Message.created ASC'),
            'contain' => array('Sender', 'Receiver')
        ));
        $this->set('messages', $messages);
    }





    public function viewConversation($userid = null)
    {
        $this->loadModel('Posts');
        $this->layout = null;
        $user_id = $this->Session->read('Auth.User.user_id');

        $conditions = array(
            'OR' => array(
                array('sender_id' => $user_id, 'receiver_id' => $userid),
                array('sender_id' => $userid, 'receiver_id' => $user_id)
            )
        );

        $imageRecord = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $userid]
        ]);
        $this->set(compact('imageRecord'));

        $imageRecord2 = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $user_id]
        ]);
        $this->set(compact('imageRecord2'));


        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array('Message.timestamp' => 'DESC'), 
            'limit' => 10 
        );


        $conversation = $this->paginate('Message');

        $this->set('conversation', $conversation);
        $this->set('userid', $userid);
    }


    public function searchMessages()
    {
        $user_id = $this->Session->read('Auth.User.user_id');
        $searchTerm = $this->request->data['searchTerm'];

        // Perform the search query to fetch messages matching the search term
        // Adjust your search query according to your database schema and requirements
        $searchResults = $this->Message->find('all', array(
            'conditions' => array(
                'OR' => array(
                    array('sender_id' => $user_id, 'receiver_id' => $user_id),
                    array('sender_id' => $user_id, 'receiver_id' => $user_id)
                ),
                'Message.message_content LIKE' => "%$searchTerm%"
            ),
            'order' => array('Message.timestamp' => 'DESC'), // Display newest messages first
            'limit' => 10 // Limit to 10 items per page
        ));

        // Pass the search results to the view
        $this->set(compact('searchResults'));
        $this->render('search_results', 'ajax'); // Render a different view for search results
    }





    public function send()
    {
        $user_id = $this->Session->read('Auth.User.user_id');
        $this->layout = null;
        if ($this->request->is('post')) {
            // Assuming form fields are named conversation_id, sender_id, receiver_id, and message_content
            $this->Message->create();
            $data = array(
                'Message' => array(
                    'sender_id' => $user_id,
                    'receiver_id' => $this->request->data['Message']['receiver_id'],
                    'message_content' => $this->request->data['Message']['message_content']
                )
            );
            if ($this->Message->save($data)) {
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Failed to send message.');
            }
        }
    }

    public function sendInside()
    {
        $user_id = $this->Session->read('Auth.User.user_id');
        $this->layout = null;
        if ($this->request->is('post')) {
            // Assuming form fields are named conversation_id, sender_id, receiver_id, and message_content
            $this->Message->create();
            $data = array(
                'Message' => array(
                    'sender_id' => $user_id,
                    'receiver_id' => $this->request->data['Message']['receiver_id'],
                    'message_content' => $this->request->data['Message']['message_content']
                )
            );
            if ($this->Message->save($data)) {
                $this->set(array('success', true));
                // Redirect back to the same conversation page
                $this->redirect(array('action' => 'viewConversation', $this->request->data['Message']['receiver_id']));
            } else {
                $this->Session->setFlash('Failed to send message.');
            }
        }
    }




    public function compose($recipient_id = null)
    {

        $this->loadModel('Posts');

        $this->layout = null;
        $user_id = $this->Session->read('Auth.User.user_id');

        $imageRecord = $this->Posts->find('first', [
            'conditions' => ['Posts.id' => $recipient_id]
        ]);
        $this->set(compact('imageRecord'));

        if (!$recipient_id) {
            $this->Session->setFlash('Recipient ID is required.');
            $this->redirect(array('controller' => 'users', 'action' => 'search'));
        }

        $recipient = $this->User->find('first', array(
            'conditions' => array('User.user_id' => $recipient_id)
        ));
        if (!$recipient) {
            $this->Session->setFlash('Recipient not found.');
            $this->redirect(array('controller' => 'users', 'action' => 'search'));
        }
        $this->set('recipient', $recipient);

        if ($this->request->is('post')) {
            $this->Message->create();
            $data = array(
                'Message' => array(
                    'sender_id' => $user_id,
                    'receiver_id' => $recipient_id,
                    'message_content' => $this->request->data['Message']['message_content']
                )
            );
            if ($this->Message->save($data)) {
                $this->redirect(array('controller' => 'messages', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Failed to send message.');
            }
        }
    }

    public function deleteMessage()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $messageId = $this->request->data['message_id'];
            $userId = $this->Session->read('Auth.User.user_id');

            // Find the message by message_id
            $message = $this->Message->find('first', array(
                'conditions' => array(
                    'Message.message_id' => $messageId
                )
            ));

            // Check if the message exists and if the user is the sender
            if ($message && $message['Message']['sender_id'] == $userId) {
                if ($this->Message->delete($messageId)) {
                    // Return success response if deletion is successful
                    $this->response->body(json_encode(['success' => true]));
                    return;
                }
            }
        }

        // Return failure response if deletion fails or user is not authorized
        $this->response->body(json_encode(['success' => false]));
    }
}
