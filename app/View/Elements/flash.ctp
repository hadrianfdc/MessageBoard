<?php
$messages = $this->Session->read('Message.flash');
if ($messages) :
    foreach ($messages as $message) :
        echo $this->Html->div('alert ' . $message['class'], $message['message']);
    endforeach;
endif;
?>