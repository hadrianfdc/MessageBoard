<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>


    <?php echo $this->Html->css('Messages/index');  ?>
    <title>Messages</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true"></a>
                    </li>
                </ul>
                <ul class="d-flex navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" id="message" href="http://localhost/MessageBoard/Messages/index">Messages</a>
                    </li>
                </ul>
                <ul class="d-flex navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" id="message" href="http://localhost/MessageBoard/Users/search">Find</a>
                    </li>
                </ul>
                <div class="dropdown-center">
                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $this->Session->read('Auth.User.full_name'); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/MessageBoard/user-profile">Profile</a></li>
                        <li><a class="dropdown-item" href="http://localhost/MessageBoard/logins/change_password">Change Password</a></li>
                        <li><a class="dropdown-item" href="#" onclick="confirmLogout()">Logout!</a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will be logged out!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, logout!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo $this->Html->url(array("controller" => "logins", "action" => "logout")); ?>',
                            success: function(data) {
                                window.location.href = '<?php echo $this->Html->url(array("controller" => "logins", "action" => "login")); ?>';
                            }
                        });
                    }
                });
            }
        </script>
    </nav>



    <div class="message-container">
        <div class="received-messages scrollable">
            <h3>Received Messages</h3>
            <div class="search-bar">
                <input style="font-size: 12px;" type="text" id="received-search-input" placeholder="Search by sender's name" class="search-input">
                <button style="font-size: 12px;" type="button" class="search-button">Search</button>
            </div>
            <ul class="message-list">
                <?php
                // <<<<<------------------- Array to keep track of unique sender IDs ------------------->>>>>
                $uniqueSenderIds = array();
                ?>
                <?php foreach ($receivedMessages as $message) : ?>
                    <?php
                    // <<<<<<------------------- Get sender user ID ------------------->>>>>
                    $senderId = $message['Sender']['user_id'];

                    // <<<<------------------- Check if the sender ID is already encountered ------------------->>>>>
                    if (!in_array($senderId, $uniqueSenderIds)) {
                        // <<<<<<<<------------------- Add sender ID to the list of unique IDs ------------------->>>>>
                        $uniqueSenderIds[] = $senderId;
                    ?>
                        <li class="received-message" data-sender-name="<?php echo strtolower($message['Sender']['full_name']); ?>">
                            <a style="text-decoration: none;" href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'viewConversation', $senderId)); ?>">
                                <div class="message-content" style="font-size: 12px;">
                                    <?php echo $this->Text->truncate($message['Message']['message_content'], 100, array('ellipsis' => '...')); ?>
                                    <span style="color: blue; font-size:10px;">Read more</span>
                                </div>
                                <div class="message-metadata">
                                    <span class="message-from">From: <?php echo $message['Sender']['full_name']; ?></span>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="sent-messages scrollable">
            <h3>Sent Messages <a style="font-size: 12px;" class="btn btn-sm btn-primary" href="http://localhost/MessageBoard/Users/search">New message</a> </h3>
            <div class="search-bar">
                <input style="font-size: 12px;" type="text" id="sent-search-input" placeholder="Search by receiver's name" class="search-input">
                <button style="font-size: 12px;" type="button" class="search-button">Search</button>
            </div>
            <ul class="message-list">
                <?php
                // <<<<<------------------- Array to keep track of unique receiver IDs ------------------->>>>>>
                $uniqueReceiverIds = array();
                ?>
                <?php foreach ($sentMessages as $message) : ?>
                    <?php
                    // <<<<<------------------- Get receiver user ID ------------------->>>>>>>
                    $receiverId = $message['Receiver']['user_id'];

                    // <<<<<<------------------- Check if the receiver ID is already encountered ------------------->>>>>>
                    if (!in_array($receiverId, $uniqueReceiverIds)) {
                        // <<<<<<------------------- Add receiver ID to the list of unique IDs ------------------->>>>>
                        $uniqueReceiverIds[] = $receiverId;
                    ?>
                        <li class="sent-message" data-receiver-name="<?php echo strtolower($message['Receiver']['full_name']); ?>">
                            <a style="text-decoration: none;" href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'viewConversation', $receiverId)); ?>">
                                <div class="message-content" style="font-size: 12px;">
                                    <?php echo $this->Text->truncate($message['Message']['message_content'], 100, array('ellipsis' => '...')); ?>
                                    <span style="color: blue; font-size:10px;">Read more</span>
                                </div>
                                <div class="message-metadata">
                                    <span class="message-to">To: <?php echo $message['Receiver']['full_name']; ?></span>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const receivedSearchInput = document.getElementById('received-search-input');
            const receivedMessages = document.querySelectorAll('.received-message');

            receivedSearchInput.addEventListener('input', function() {
                const searchTerm = receivedSearchInput.value.trim().toLowerCase();

                receivedMessages.forEach(function(message) {
                    const senderName = message.dataset.senderName.toLowerCase();
                    if (senderName.includes(searchTerm)) {
                        message.style.display = 'block';
                    } else {
                        message.style.display = 'none';
                    }
                });
            });

            const sentSearchInput = document.getElementById('sent-search-input');
            const sentMessages = document.querySelectorAll('.sent-message');

            sentSearchInput.addEventListener('input', function() {
                const searchTerm = sentSearchInput.value.trim().toLowerCase();

                sentMessages.forEach(function(message) {
                    const receiverName = message.dataset.receiverName.toLowerCase();
                    if (receiverName.includes(searchTerm)) {
                        message.style.display = 'block';
                    } else {
                        message.style.display = 'none';
                    }
                });
            });
        });
    </script>



</body>

</html>