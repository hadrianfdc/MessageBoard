<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation Details</title>
</head>

<body>


    <!--------------------- conversations/view.ctp --------------------->
    <h2>Conversation Details</h2>
    <p><strong>ID:</strong> <?php echo $conversation['Conversation']['id']; ?></p>
    <p><strong>User 1 ID:</strong> <?php echo $conversation['User1']['id']; ?></p>
    <p><strong>User 2 ID:</strong> <?php echo $conversation['User2']['id']; ?></p>



</body>

</html>