<?php echo $this->Facebook->html(); ?>
    <head>
        <title><?php echo $title_for_layout ?></title>
        <?php
	    	echo $this->Html->meta('icon');
	    	echo $this->Html->css('/main/css/user_score');

			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
    </head>
    <body>
		<div id="top-bg"></div>
		<div id="container">
            <div id="logo">
            	<a href="http://www.rajakamar.com/">
            		<img src="/main/images/Logo-Rajakamar.png" width="250" height="76" alt="Logo" />
            	</a>
        	</div>

	        <div id="logo-singapore">
				<img src="/main/images/logo_360.png" width="250" height="65" alt="Icon" /></div>
		        <div style=" padding-top: 10px; padding-bottom: 0px;"class="clearfix"></div>
	            <div style="padding-top:30px;"class="clearfix"></div>

	        	<!-- Content -->
	        	<?php echo $this->fetch('content'); ?>

	        	<div style="clear: both; padding-top:30px;"id="footer">
	            	<p style="color:#999; font-size:11px;">copyright &copy; RajaKamar 2012 All Rights Reserved.</p>
	            </div>
			</div>
		</div>

	    <?php echo $this->Facebook->init(); ?>
    </body>
</html>