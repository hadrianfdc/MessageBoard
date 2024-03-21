<!DOCTYPE html>
<html>

<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.20.0/css/mdb.lite.min.css');
    echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.20.0/css/mdb.min.css');
	echo $this->Html->css('cake.generic');

	echo $this->Html->css('Navbar/navbar');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	// echo $this->Html->css('path/to/sweetalert.css');
	// echo $this->Html->script('path/to/sweetalert.min.js');
	?>
</head>

<body>
	<div id="container">

		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		</div>
	</div>
</body>

</html>