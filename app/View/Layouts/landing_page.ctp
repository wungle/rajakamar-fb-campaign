<?php echo $this->Facebook->html(); ?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>RajaKamar | Singapore 360 Exploration</title>
		<?php
	    	echo $this->Html->meta('icon');
	    	echo $this->Html->css('/main/css/landing');

			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
	</head>
	<body>
		<?php echo $this->fetch('content'); ?>		

	    <?php echo $this->Facebook->init(); ?>
	</body>
</html>