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
		<div id="top-bg"></div>
		<div id="container">
            <div id="logo"> 
	            	<a href="http://www.rajakamar.com/"><img src="/main/images/Logo-Rajakamar.png" width="250" height="76" alt="Logo" />
	            </a>
			</div>
        	<div style="padding-top:150px;"class="clearfix"></div>

        	<!-- Content -->
        	<?php echo $this->fetch('content'); ?>

	        <div style="clear: both; padding-top:30px;"id="footer">
	    		<p style="color:#999; font-size:11px;">copyright &copy; RajaKamar 2012 All Rights Reserved.</p>
	        </div>
        </div>

	    <?php echo $this->Facebook->init(); ?>
    </body>
</html>