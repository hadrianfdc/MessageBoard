<?php
echo $this->Html->css('Register/thank_you');
?>

<div class=content>
  <div class="wrapper-1">
    <div class="wrapper-2">
      <h1>Thank you !</h1>
      <p>Welcome! You are successfully created an account. </p>
      <p>We appreciated your patience in filling out. </p>

      <button class="go-home">
        <?php echo $this->Html->link('Go Home!', array('controller' => 'logins', 'action' => 'login')); ?>
      </button>

      <?php
      CakeSession::delete('Auth.User.user_id');
      CakeSession::delete('Auth.User.full_name');
      ?>

    </div>
  </div>
</div>



<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">