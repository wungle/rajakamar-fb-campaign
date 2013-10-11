<?php echo $this->Facebook->html(); ?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>RajaKamar | Singapore 360 Exploration</title>
		<script>
			// Win_Warning = window.open('Warning.html','Win_Warning','top=50,screenY=50,left=50,width=500,height=100,scrollbars=no,scrollbar=no,menubar=no');
   //      window.close('Win_Warning');
		</script>
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