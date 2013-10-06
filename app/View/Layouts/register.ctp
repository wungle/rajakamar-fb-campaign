<?php echo $this->Facebook->html(); ?>
    <head>
        <title><?php echo $title_for_layout ?></title>
		<?php
	    	echo $this->Html->meta('icon');
	    	echo $this->Html->css('/main/css/user_register');

			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
    </head>
    <body>
    	<?php echo $this->Session->flash(); ?>

        <?php echo $content_for_layout; ?>

	    <?php echo $this->Facebook->init(); ?>
    </body>
</html>

<?php echo $this->fetch('sql_dump'); ?>