<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <title>www.rajakamar.com</title>

	    <?php
	    	echo $this->Html->meta('icon');

		    echo $this->Html->css('/css/base-admin-responsive');
		    echo $this->Html->css('/css/bootstrap.min');
		    echo $this->Html->css('/css/bootstrap-responsive.min');
		    echo $this->Html->css('/css/font-awesome.min');
		    echo $this->Html->css('/css/jquery-ui-1.8.21.custom');
		    echo $this->Html->css('/css/style');
		    echo $this->Html->css('/css/pages/signin');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>

	    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->

  	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="http://www.rajakamar.com/" style="padding-bottom: 10px">
						<?php echo $this->Html->image('/img/hotel-murah-logo.png', array('width' => '100')); ?>
					</a>	
				</div> <!-- /container -->
			</div> <!-- /navbar-inner -->
		</div> <!-- /navbar -->

		<!-- Content -->
		<?php echo $this->fetch('content'); ?>

	</body>
</html>