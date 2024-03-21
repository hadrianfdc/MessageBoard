<?php
class Conversation extends AppModel {
    public $name = 'Conversation';
    public $primaryKey = 'conversation_id';
    public $belongsTo = array(
        'User1' => array(
            'className' => 'User',
            'foreignKey' => 'user1_id'
        ),
        'User2' => array(
            'className' => 'User',
            'foreignKey' => 'user2_id'
        )
    );
}
?>
