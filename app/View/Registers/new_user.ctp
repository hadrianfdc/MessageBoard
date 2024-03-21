<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php
    echo $this->Html->css('Register/new_user');
    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    echo $this->Html->css('Register/new_user');
    echo $this->fetch('script');

    echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css');
    echo $this->Html->css('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css');
    echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');

    echo $this->fetch('https://code.jquery.com/jquery-3.2.1.slim.min.js');
    echo $this->fetch('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js');
    echo $this->fetch('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js');

    echo $this->Html->script('https://cdn.jsdelivr.net/npm/sweetalert2@11');
    ?>

    <title>Message Board - Register</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <h1>Registration</h1>
            <div class="error-message"><?php echo $this->Session->flash('auth'); ?></div>
            <?php
            echo $this->Form->create('Registers');
            echo $this->Form->input('full_name', ['type' => 'text', 'class' => 'form-control','required']);
            echo $this->Form->input('gender', ['type' => 'select', 'options' => ['Male' => 'Male', 'Female' => 'Female'], 'class' => 'form-control']);
            echo $this->Form->input('birthdate', ['type' => 'date', 'class' => 'form-control','required']);
            echo $this->Form->input('email', ['class' => 'form-control','required']);
            echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control','required']);
            echo $this->Form->input('date_created', ['type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
            echo $this->Form->input('last_login_time', ['type' => 'hidden']);
            echo $this->Form->submit('Register', ['class' => 'btn btn-primary']);
            echo $this->Form->end();

            echo $this->Html->link("Already have an account ? Sign up", ['controller' => 'logins', 'action' => 'login']);

            ?>

            <script>
                <?php
                if (isset($success) && $success === true) {
                    echo "Swal.fire({
                        title: 'Success!',
                        text: 'Account created successfully!',
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '" . $this->Html->url(array('controller' => 'Registers', 'action' => 'thank_you')) . "';
                        }
                    });";
                } elseif (isset($success) && $success === false) {
                    echo "Swal.fire('Error!', 'Error saving user data. Please try again.', 'error');";
                }
                ?>
            </script>

        </div>
    </div>

</body>

</html>