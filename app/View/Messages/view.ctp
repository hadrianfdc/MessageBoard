<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation</title>
</head>
<body>
    <!-- messages/view.ctp -->
<h2>Conversation</h2>
<?php foreach ($messages as $message): ?>
    <p>
        <strong><?php echo $message['Sender']['fullname']; ?>:</strong>
        <?php echo $message['Message']['message_content']; ?>
    </p>
<?php endforeach; ?>

</body>
</html>