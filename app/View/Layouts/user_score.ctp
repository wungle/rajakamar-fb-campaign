<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <title>RajaKamar | Daftar Skor Sementara Singapore 360 Exploration</title>
		<?php
	    	echo $this->Html->meta('icon');
	    	echo $this->Html->css('/main/css/user_score');

			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
	</head>

	<body>
		<?php echo $this->fetch('content'); ?>

	    <?php echo $this->Facebook->init(); ?>
	</body>
</html>