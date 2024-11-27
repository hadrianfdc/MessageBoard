<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css('Messages/search');  ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <title>Search Users</title>
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



    <div class="messenger-search" id="searchContainer">
        <h2>Search Users</h2>

        <div class="search-bar">
            <input type="text" id="received-search-input" placeholder="Search by sender's name" class="search-input">
            <button type="button" class="search-button">Search</button>
        </div>

        <div id="initialResults" class="initial-results">
            <?php if (!empty($users)) : ?>
                <ul class="search-results">
                    <?php foreach ($users as $user) : ?>
                        <li class="search-result">
                            <div class="user-details">

                                <div class="rounded-circle overflow-hidden mr-3" id="user-pic">
                                    <?php if (!empty($imagesByUser[$user['User']['user_id']])) : ?>
                                        <?php foreach ($imagesByUser[$user['User']['user_id']] as $imageRecord) : ?>
                                            <a href="http://localhost/MessageBoard/Userprofiles/userprofiledetails/<?php echo $user['User']['user_id']; ?>">
                                                <img src="<?php echo $this->Html->url('/' . $imageRecord['Post']['path']); ?>" alt="Uploaded Image" class="w-100 h-100"></a>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                                    <?php endif; ?>
                                </div>
                                <div class="user-info">
                                    <span hidden><?php echo $user['User']['user_id']; ?></span>
                                    <span class="user-name"><?php echo $user['User']['full_name']; ?></span>
                                    <span style="font-size: 11px;">(<?php echo $user['User']['email']; ?>) </span>
                                </div>

                            </div>

                            <div class="send-message-button">
                                <?php echo $this->Html->link('Send Message |', array(
                                    'controller' => 'messages',
                                    'action' => 'compose',
                                    $user['User']['user_id']
                                )); ?>


                                <?php echo $this->Html->link(' Profile', array(
                                    'controller' => 'userprofiles',
                                    'action' => 'userprofiledetails',
                                    $user['User']['user_id']
                                )); ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div id="noUserFoundMessage" class="noUserFoundMessage">
            <p>No User Found</p>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('received-search-input');
            const initialResults = document.getElementById('initialResults');
            const noUserFoundMessage = document.getElementById('noUserFoundMessage'); // Add this line

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.trim().toLowerCase(); // Trim whitespace from the search term
                const users = document.querySelectorAll('.user-name');
                let found = false; // Add this line

                users.forEach(function(user) {
                    const userName = user.textContent.toLowerCase();
                    const li = user.closest('.search-result');

                    if (userName.includes(searchTerm)) {
                        li.style.display = 'block';
                        found = true; // Set found to true if any user is found
                    } else {
                        li.style.display = 'none';
                        noUserFoundMessage.style.display = 'none';
                    }
                });

                // Show or hide initial results section based on search input and whether users are found
                if (searchTerm === '') {
                    initialResults.style.display = 'none';
                    noUserFoundMessage.style.display = 'none';
                } else if (found) { // Show initial results only if users are found
                    initialResults.style.display = 'block';
                    noUserFoundMessage.style.display = 'none'; // Hide the "No User found" message if users are found
                } else {
                    initialResults.style.display = 'none';
                    noUserFoundMessage.style.display = 'block'; // Show the "No User found" message if no users are found
                }
            });
        });
    </script>




</body>

</html>