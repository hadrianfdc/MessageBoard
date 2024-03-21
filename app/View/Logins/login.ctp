<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php
    echo $this->Html->css('Login/login');
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


    <title>Message Board - Login</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <h1>Login</h1>
            <div class="error-message"><?php echo $this->Session->flash('auth'); ?></div>
            <?php
            echo $this->Form->create('Logins');
            echo $this->Form->input('email', ['class' => 'form-control']);
            echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control']);
            echo $this->Form->submit('Login', ['class' => 'btn btn-primary']);
            echo $this->Form->end();

            echo $this->Html->link("Don't have an account yet? Sign up", ['controller' => 'registers', 'action' => 'new_user']);
            ?>


            <script>
                console.log("Script executed");
                <?php
                if (isset($success)) {
                    if ($success === true) {
                        echo "console.log('Success!');";
                        echo "Swal.fire({
                            title: 'Success!',
                            text: 'Login successfully!',
                            icon: 'success',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: false,
                            customClass: {
                                confirmButton: 'custom-okay-button'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '" . $this->Html->url(array('controller' => 'Userprofiles', 'action' => 'user_profile')) . "';
                            }
                        });";
                    } elseif ($success === false) {
                        echo "console.log('Error!');";
                        echo "Swal.fire('Error!', 'Error credentials. Please try again.', 'error');";
                    } else {
                        echo "console.log('Unknown status: " . $success . "');";
                    }
                }
                ?>
            </script>

            <style>
                .custom-okay-button {
                    background-color: green !important;
                }
            </style>
        </div>
    </div>

</body>

</html>