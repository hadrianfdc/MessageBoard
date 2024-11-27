<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css('Messages/compose');  ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <title>Compose Message</title>
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
                        <li><a class="dropdown-item" href="#">Change Password</a></li>
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



    <style>
        .send-button[disabled] {
            background-color: #ccc;
            /* Grey background color */
            color: #666;
            /* Grey text color */
            cursor: not-allowed;
            /* Change cursor to not-allowed */
        }
    </style>

    <!-- Compose message form HTML -->
    <div class="compose-message-container">
        <h2>Compose Message</h2>
        <p class="message-recipient">To: <?php echo $recipient['User']['full_name']; ?></p>
        <center>
            <div class="rounded-circle overflow-hidden mr-3" style="width: 70px; height: 70px;">
                <?php if (!empty($imageRecord)) : ?>
                    <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100">
                <?php else : ?>
                    <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                <?php endif; ?>
            </div>
        </center>
        <?php echo $this->Form->create('Message', array('url' => array('controller' => 'messages', 'action' => 'compose', $recipient['User']['user_id']))); ?>
        <?php echo $this->Form->hidden('receiver_id', array('value' => $recipient['User']['user_id'])); ?>
        <div>
            <?php echo $this->Form->input('message_content', array('id' => 'message-content', 'class' => 'message-input', 'label' => false, 'placeholder' => 'Type a message...')); ?>
        </div>
        <div>
            <?php echo $this->Form->submit('Send', array('class' => 'send-button', 'id' => 'send-button', 'disabled' => 'disabled')); ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var messageInput = document.getElementById('message-content');
            var sendButton = document.getElementById('send-button');

            messageInput.addEventListener('input', function() {
                if (messageInput.value.trim() !== '') {
                    sendButton.removeAttribute('disabled');
                } else {
                    sendButton.setAttribute('disabled', 'disabled');
                }
            });
        });
    </script>




</body>

</html>