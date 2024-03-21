<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Message</title>
</head>

<body>

    <!-------------------------------------- messages/send.ctp ---------------------------------------->
    <h2>New Message</h2>
    <?php
    echo $this->Form->create('Message', array('action' => 'send'));
    echo $this->Form->hidden('sender_id', array('value' => $this->Session->read('Auth.User.user_id')));
    ?>
    <div>
        <?php echo $this->Form->input('receiver_id', array('label' => 'Recipient')); ?>
    </div>
    <div>
        <?php echo $this->Form->input('message_content', array('label' => 'Message')); ?>
    </div>
    <div>
        <?php echo $this->Form->submit('Send'); ?>
    </div>
    <?php echo $this->Form->end(); ?>

</body>

</html>