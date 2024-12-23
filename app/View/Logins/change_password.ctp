<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css('Login/changepassword');  ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include timeago.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/timeago.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <title>Change Password</title>
</head>

<body>

    <div class="change-password-container">
        <h2>Change Password</h2>

        <?php echo $this->Form->create('Registers', array('url' => array('controller' => 'logins', 'action' => 'changePassword'))); ?>

        <div class="form-group">
            <?php echo $this->Form->input('old_password', array('type' => 'text', 'label' => 'Old Password', 'class' => 'form-control', 'required')); ?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input('password', array('type' => 'password', 'label' => 'New Password', 'class' => 'form-control', 'required', 'id' => 'new-password')); ?>
            <div class="password-strength-meter">
                Password Strength:
                <span id="weak" class="weak" style="width: 40px;"></span>
                <span id="medium" class="medium" style="width: 40px;"></span>
                <span id="strong" class="strong" style="width: 40px;"></span>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirm Password', 'class' => 'form-control', 'required')); ?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->submit('Change Password', array('class' => 'btn btn-primary', 'id' => 'change-password-button', 'disabled' => 'disabled')); ?>
            <a class="btn btn-sm btn-secondary" href="/MessageBoard/user-profile">Back</a>
        </div>

        <?php echo $this->Form->end(); ?>
    </div>


    <script>
        document.getElementById('new-password').addEventListener('input', function() {
            var password = this.value;
            var changePasswordButton = document.getElementById('change-password-button');

            var mediumThreshold = 7;

            if (password.length < mediumThreshold) {
                changePasswordButton.setAttribute('disabled', 'disabled');
            } else {
                changePasswordButton.removeAttribute('disabled');
            }
        });


        document.getElementById('new-password').addEventListener('input', function() {
            var password = this.value;
            var strengthMeter = document.querySelector('.password-strength-meter');
            var weak = document.getElementById('weak');
            var medium = document.getElementById('medium');
            var strong = document.getElementById('strong');

            var weakThreshold = 6;
            var mediumThreshold = 11;

            if (password.length < weakThreshold) {
                weak.style.backgroundColor = '#dc3545';
                medium.style.backgroundColor = '';
                strong.style.backgroundColor = '';
            } else if (password.length < mediumThreshold) {
                weak.style.backgroundColor = '#ffc107';
                medium.style.backgroundColor = '#ffc107';
                strong.style.backgroundColor = '';
            } else {
                weak.style.backgroundColor = '#28a745';
                medium.style.backgroundColor = '#28a745';
                strong.style.backgroundColor = '#28a745';
            }
        });
    </script>

    <script>
        console.log("Script executed");
        var changePasswordButton = document.getElementById('change-password-button');
        changePasswordButton.removeAttribute('disabled');
        <?php
        if (isset($success)) {
            if ($success === true) {
                echo "console.log('Success!');";
                echo "Swal.fire({
                            title: 'Success!',
                            text: 'Change password successfully!',
                            icon: 'success',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '" . $this->Html->url(array('controller' => 'Logins', 'action' => 'logout')) . "';
                            }
                        });";
            } elseif ($success === false) {
                echo "console.log('Error!');";
                echo "Swal.fire('Error!', '$message.', 'error');";
            } else {
                echo "console.log('Unknown status: " . $success . "');";
            }
        }
        ?>
    </script>

</body>

</html>