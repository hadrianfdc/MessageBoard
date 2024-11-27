<?php
$this->Html = $this->loadHelper('Html');
$this->loadHelper('Url');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css('Navbar/navbar');  ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <?php

    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    echo $this->fetch('script');

    echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css');
    echo $this->Html->css('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css');
    echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');

    echo $this->fetch('https://code.jquery.com/jquery-3.2.1.slim.min.js');
    echo $this->fetch('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js');
    echo $this->fetch('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js');

    echo $this->Html->script('https://cdn.jsdelivr.net/npm/sweetalert2@11');

    ?>

    <title>User Profile</title>
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

    <section style="background-color: #B4D4FF;height: 93vh;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-md-9 col-lg-7 col-xl-5">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <div class="d-flex text-black">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle overflow-hidden" style="width: 150px; height: 150px;">
                                        <?php if (!empty($imageRecord)) : ?>
                                            <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100" id="uploadedImage">
                                        <?php else : ?>
                                            <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="flex-grow-1 ms-1">
                                    <?php foreach ($userProfileData as $key => $profile) : ?>
                                        <h5 class="mb-1">Name: <?php echo h($profile['UserProfiles']['full_name']); ?></h5>
                                        <p class="mb-0"><b>Birthday:</b> <?php echo date('F j, Y', strtotime($profile['UserProfiles']['birthdate'])); ?></p>
                                        <p class="mb-0"><b> Gender: </b> <?php echo h($profile['UserProfiles']['gender']); ?></p>
                                        <p class="mb-0"><b>Joined:</b> <?php echo date('F j, Y h:i A', strtotime($profile['UserProfiles']['date_created'])); ?></p>
                                        <p class="mb-0"><b> Last time login: </b> <?php echo date('F j, Y h:i A', strtotime($profile['UserProfiles']['last_login_time'])); ?></p>
                                        <div class="d-flex flex-column pt-1">
                                            <a class="btn btn-primary">

                                                <?php echo $this->Html->link('Message', array(
                                                    'controller' => 'messages',
                                                    'action' => 'viewConversation',
                                                    $profile['UserProfiles']['user_id']
                                                )); ?>

                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-1">
                                <?php foreach ($userProfileData as $key => $profile) : ?>
                                    <h5 class="mb-1">Hobby</h5>
                                    <p class="mb-0" id="costumText"><?php echo h($profile['UserProfiles']['hobby']); ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--------------------- Modal for hovering Profile Photo -------------------------------------------------------->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <img src="" alt="Uploaded Image" class="img-fluid rounded" id="modalImage" style="width: 80%; height: 80%;">
                </div>
            </div>
        </div>
    </div>


    <script>
        // JavaScript to handle image hover and modal display
        document.addEventListener("DOMContentLoaded", function() {
            const uploadedImage = document.getElementById('uploadedImage');
            const modalImage = document.getElementById('modalImage');

            uploadedImage.addEventListener('mouseenter', function() {
                const imagePath = this.getAttribute('src');
                modalImage.setAttribute('src', imagePath);
                $('#imageModal').modal('show');
            });

            uploadedImage.addEventListener('mouseleave', function() {
                $('#imageModal').modal('hide');
            });
        });
    </script>
    <style>
        /* Zoom animation */
        .modal.fade .modal-dialog {
            transform: scale(0.1);
            transition: transform 0.3s ease;
        }

        .modal.fade.show .modal-dialog {
            transform: scale(1);
        }
    </style>



    <!--------------------------------------- Modal for editing profile details ----------------------------------------->
    <div class="modal fade" id="editProfileDetailsModal" tabindex="-1" role="dialog" aria-labelledby="editProfileDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileDetailsModalLabel">Edit Profile Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-----------------------------------------Form for editing profile details ----------------------------------------->
                    <form method="post" action="<?php echo $this->Html->url(array('controller' => 'UserProfiles', 'action' => 'editDetails')); ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo isset($profile['UserProfiles']['full_name']) ? h($profile['UserProfiles']['full_name']) : ''; ?>">
                        </div>

                        <!-- Your HTML form -->
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birthday:</label>
                            <input type="text" class="form-control" id="birthdate" name="birthdate" value="<?php echo date('Y-m-d', strtotime($profile['UserProfiles']['birthdate'])); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="hobby" class="form-label">Hobby:</label>
                            <textarea class="form-control" id="hobby" name="hobby" rows="5" maxlength="500"><?php echo isset($profile['UserProfiles']['hobby']) ? h($profile['UserProfiles']['hobby']) : ''; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function() {
            $('#birthdate').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                beforeShow: function(input, inst) {
                    var datepicker = inst.dpDiv;
                    setTimeout(function() {
                        var header = datepicker.find('.ui-datepicker-title'),
                            year = header.find('.ui-datepicker-year'),
                            month = header.find('.ui-datepicker-month');
                        year.attr('size', '5').css('overflow', 'auto');
                        month.attr('size', '5').css('overflow', 'auto');
                    }, 0);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Check if success flag is set
            <?php if ($success) : ?>
                swal("Success", "User profile updated successfully.", "success");
            <?php endif; ?>

            // Check if error flag is set
            <?php if ($error) : ?>
                swal("Error", "Error updating user profile.", "error");
            <?php endif; ?>
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.edit-profile-btn').on('click', function() {
                var fullName = $('#full_name').val();
                $('#editProfileForm #full_name').val(fullName);
            });

            $('#editProfileForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "<?php echo $this->Html->url(array('controller' => 'UserProfiles', 'action' => 'editDetails')); ?>",
                    data: $('#editProfileForm').serialize(),
                    success: function(response) {

                        $('#editProfileModal').modal('hide');

                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });
    </script>


</body>

</html>