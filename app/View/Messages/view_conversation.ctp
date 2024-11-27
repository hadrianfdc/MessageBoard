<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css('Messages/viewconversation');  ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!---------------------------------------- Include timeago.js from CDN ---------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/timeago.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <title>View Message</title>
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



    <!------------------- messages/view_conversation.ctp ------------------------------->
    <?php if (!empty($conversation)) : ?>

        <?php
        // <<<<<<-------------------Get the name of the conversation participant ------------------------------->>>
        $conversationParticipantName = ($conversation[0]['Message']['sender_id'] != $this->Session->read('Auth.User.user_id')) ? $conversation[0]['Sender']['full_name'] : $conversation[0]['Receiver']['full_name'];
        ?>
        <div class="conversation-header d-flex align-items-center">
            <a class="btn btn-sm btn-secondary mr-2" href="http://localhost/MessageBoard/Messages/index"> <- </a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'userprofiles', 'action' => 'userprofiledetails', $userid)); ?>">
                        <div class="rounded-circle overflow-hidden mr-3" style="width: 50px; height: 50px;">
                            <?php if (!empty($imageRecord)) : ?>
                                <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100">
                            <?php else : ?>
                                <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div>
                        <h5 id="profileLink"><a href="<?php echo $this->Html->url(array('controller' => 'userprofiles', 'action' => 'userprofiledetails', $userid)); ?>"></a><?php echo $conversationParticipantName; ?> </h5>
                    </div>
        </div>

        <!---------------------------------------- Bootstrap Modal ---------------------------------------->
        <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <p class="modal-title" id="profileModalLabel">Click the photo to go to profile of</p>
                        <div class="conversation-header d-flex align-items-center">
                            <a href="<?php echo $this->Html->url(array('controller' => 'userprofiles', 'action' => 'userprofiledetails', $userid)); ?>">
                                <div class="rounded-circle overflow-hidden mr-3" style="width: 50px; height: 50px;">
                                    <?php if (!empty($imageRecord)) : ?>
                                        <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100">
                                    <?php else : ?>
                                        <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div>
                                <h5 id="profileLink"><a href="<?php echo $this->Html->url(array('controller' => 'userprofiles', 'action' => 'userprofiledetails', $userid)); ?>"></a><?php echo $conversationParticipantName; ?> </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // <<<<< ------------------- JavaScript to show and hide modal on hover ------------------->>>
            $(document).ready(function() {
                $('#profileLink').hover(function() {
                    $('#profileModal').modal('show');
                }, function() {
                    $('#profileModal').modal('hide');
                });
            });
        </script>




        <div class="conversation-container" id="conversationContainer">
            <?php if ($this->Paginator->numbers()) : ?>
                <!--------------------- Pagination links --------------------->
                <nav aria-label="Page navigation" class="pagination justify-content-center">
                    <ul class="pagination">
                        <li class="page-item <?php echo $this->Paginator->hasPrev() ? '' : 'disabled'; ?>">
                            <?php echo $this->Paginator->prev('Show newer', array('escape' => false, 'class' => 'page-link')); ?>
                        </li>
                        <!--------------------- Display only the buttons without numbers ---------------------------------------->
                        <li class="page-item">
                            <button class="page-link">...</button>
                        </li>
                        <li class="page-item <?php echo $this->Paginator->hasNext() ? '' : 'disabled'; ?>">
                            <?php echo $this->Paginator->next('Show older...', array('escape' => false, 'class' => 'page-link')); ?>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>

            <ul class="conversation-list">
                <?php
                // <<<<<<<<------------------- Reverse the conversation array to display messages from newest to oldest ------------------->>>>>
                $conversation = array_reverse($conversation);
                ?>
                <?php foreach ($conversation as $message) : ?>
                    <?php
                    $messageClass = ($message['Message']['sender_id'] == $this->Session->read('Auth.User.user_id')) ? 'sent' : 'received';
                    $messageBgColor = ($message['Message']['sender_id'] == $this->Session->read('Auth.User.user_id')) ? 'background-color: #86B6F6; font-size: 13px; color: black;' : '';
                    ?>

                    <li class="message <?php echo $messageClass; ?>" style="<?php echo $messageBgColor; ?>">
                        <?php if ($messageClass === 'received') : ?>
                            <!-- Display image for received message -->
                            <div class="rounded-circle overflow-hidden mr-3" style="width: 30px; height: 30px;float:left; margin-right:20px;">
                                <?php if (!empty($imageRecord)) : ?>
                                    <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100">
                                <?php else : ?>
                                    <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <!-- Display image for sent message -->
                            <div class="rounded-circle overflow-hidden mr-3" style="width: 30px; height: 30px; float:right; margin-left:20px;">
                                <?php if (!empty($imageRecord2)) : ?>
                                    <img src="<?php echo $this->Html->url('/' . $imageRecord2['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100">
                                <?php else : ?>
                                    <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="message-content message-text">
                            <?php echo $message['Message']['message_content']; ?> 
                        </div>

                        <div class="message-metadata">
                             <span style="font-weight:bold ;color:black; font-size: 9px;" class="message-sender"> Send by:<?php echo ($message['Message']['sender_id'] == $this->Session->read('Auth.User.user_id')) ? '( You )' : $message['Sender']['full_name']; ?></span>
                            <span style="color:black; font-size: 9px;" class="message-timestamp">
                                Time: <?php echo date("F j, Y g:i A", strtotime($message['Message']['created'])); ?>
                                <?php if ($message['Message']['is_seen'] == 1) : ?>
                                    <span style="color: green;">Seen</span>
                                <?php endif; ?>
                            </span>
                            <?php if ($message['Message']['sender_id'] == $this->Session->read('Auth.User.user_id')) : ?>
                                <button class="delete-message" data-message_id="<?php echo $message['Message']['message_id']; ?>">Delete</button> 
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>

        <style>
            .send-button[disabled] {
                background-color: #ccc;
                color: #666;
                cursor: not-allowed;
            }
        </style>

    <?php else : ?><div class="conversation-header d-flex align-items-center">
            <a class="btn btn-sm btn-secondary mr-2" href="http://localhost/MessageBoard/Messages/index"> <- </a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'userprofiles', 'action' => 'userprofiledetails', $userid)); ?>">
                        <div class="rounded-circle overflow-hidden mr-3" style="width: 50px; height: 50px;">
                            <?php if (!empty($imageRecord)) : ?>
                                <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100">
                            <?php else : ?>
                                <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                            <?php endif; ?>
                        </div>
                    </a>


        </div>
        <p>No messages found.</p>
    <?php endif; ?>

    <div class="send-message-container">
        <h5>Send Message</h5>
        <?php
        echo $this->Form->create('Message', array('url' => array('controller' => 'messages', 'action' => 'sendInside')));
        echo $this->Form->hidden('receiver_id', array('value' => $userid));
        echo $this->Form->hidden('sender_id', array('value' => $this->Session->read('Auth.User.user_id')));
        echo $this->Form->input('message_content', array('id' => 'message-content', 'label' => false, 'class' => 'message-input', 'placeholder' => 'Type a message...'));
        echo $this->Form->submit('Send', array('class' => 'send-button', 'id' => 'send-button', 'disabled' => 'disabled'));
        echo $this->Form->end();
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // <<<<<------------  Function to scroll to the bottom of the conversation container ---------------------------->>>>>
        function scrollToBottom() {
            var container = document.getElementById('conversationContainer');
            container.scrollTop = container.scrollHeight;
        }

        // <<<<<------------ Scroll to bottom when the page is fully loaded or redirected ---------------------------->>>>>
        window.addEventListener('load', scrollToBottom);

        // <<<<<------------ Send button disable if empty ---------------------------->>>>>
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

        $(document).ready(function() {
            // <<<<<------------ Maximum length of message content before truncating ---------------------------->>>>>
            var maxLength = 100;
            var seeLess = '( .....see less..... )';

            // <<<<<------------ Selecting all message-content divs ---------------------------->>>>>
            $('.message-text').each(function() {
                var content = $(this).text();
                // <<<<<------------ Check if content length exceeds maxLength ---------------------------->>>>>
                if (content.length > maxLength) {
                    // <<<<<------------ Truncate the content ---------------------------->>>>>
                    var truncatedText = content.substr(0, maxLength) + ' .....see more...... ';
                    // <<<<<------------ Display truncated text ---------------------------->>>>>
                    $(this).text(truncatedText);
                    // <<<<<------------ Add a click event to show/hide full text ---------------------------->>>>>
                    $(this).click(function() {
                        // <<<<<------------ Toggle between truncated and full text ---------------------------->>>>>
                        // $(this).text($(this).text() == truncatedText ? content : truncatedText);
                        // <<<<<------------ Toggle between truncated and full text ---------------------------->>>>>
                        if ($(this).text() === truncatedText) {
                            $(this).text(content + seeLess);
                        } else {
                            $(this).text(truncatedText);
                        }
                    });
                    // <<<<<------------ Add CSS style for cursor pointer to indicate it's clickable ---------------------------->>>>>
                    $(this).css('cursor', 'pointer');

                }
            });
        });

        // <<<<<------------ Delete function for message ---------------------------->>>>>

        $(document).ready(function() {
            $('.delete-message').click(function() {
                var messageId = $(this).data('message_id');
                var confirmation = confirm('Are you sure you want to delete this message?');

                var $deleteButton = $(this);
                if (confirmation) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'deleteMessage')); ?>',
                        data: {
                            message_id: messageId
                        },
                        success: function(response) {
                            if (response.success) {
                                $deleteButton.closest('.message').fadeOut(1000, function() {
                                    $(this).remove();
                                });
                            } else {
                                $deleteButton.closest('.message').fadeOut(1000, function() {
                                    $(this).remove();
                                });
                            }
                        },
                        error: function() {
                            alert('Failed to delete message.');
                        }
                    });
                }
            });
        });
    </script>












</body>

</html>