<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations</title>
</head>

<body>

    <!--------------------- conversations/index.ctp --------------------->
    <h2>Conversations</h2>
    <ul>
        <?php foreach ($conversations as $conversation) : ?>
            <li><?php echo $this->Html->link(
                    $conversation['Conversation']['id'],
                    array('controller' => 'conversations', 'action' => 'view', $conversation['Conversation']['id'])
                ); ?></li>
        <?php endforeach; ?>
    </ul>


</body>

</html>