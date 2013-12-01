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
			if($this->params->controller === 'campaignUsers' && $this->params->action === 'admin_referrals') {
			    echo $this->Html->css('/css/chart');
			}
		    echo $this->Html->css('/css/style');

			echo $this->fetch('meta');
			echo $this->fetch('css');
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
					<a class="brand" href="/">
						<?php echo $this->Html->image('/img/hotel-murah-logo.png', array('width' => '100')); ?>
					</a>
					<div class="nav-collapse">
						<ul class="nav pull-right">
							<li>
								<a href="/admin/users">
									<i class="icon-group"></i> 
									Users
								</a>					
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-user"></i> 
									<?php echo $this->Session->read('Auth.User.username'); ?>
									<b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
									<li><a href="javascript:;">Profile</a></li>
									<li><a href="/admin/users/users/change_password">Change Password</a></li>
									<li><a href="/admin/logout">Logout</a></li>
								</ul>						
							</li>
						</ul>
						<form class="navbar-search pull-right">
							<input type="text" class="search-query" placeholder="Search">
						</form>
					</div><!--/.nav-collapse -->	
				</div> <!-- /container -->
			</div> <!-- /navbar-inner -->
		</div> <!-- /navbar -->
		    
		<div class="subnavbar">
			<div class="subnavbar-inner">
				<div class="container">
					<ul class="mainnav">
						<li class="<?php echo ($this->params->controller === 'dashboards' ? 'active' : ''); ?>">
							<a href="/admin/dashboards">
								<i class="icon-home"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="<?php echo ($this->params->controller === 'campaigns' ? 'active' : ''); ?>">
							<a href="/admin/campaigns">
								<i class="icon-briefcase"></i>
								<span>Campaigns</span>
							</a>
						</li>
						<li class="dropdown <?php echo ($this->params->controller === 'campaignUsers' && $this->params->action !== 'admin_referrals' ? 'active' : ''); ?>">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
	                        	<i class="icon-group"></i>
	                        	<span>Campaign Users</span> <b class="caret"></b>
	                        </a>
	                        <ul class="dropdown-menu">
	                        	<?php foreach($campaignLists as $campaignList) { ?>
		                        	<li>
		                        		<?php $listActive = isset($this->params->pass[0]) && $this->params->pass[0] == $campaignList['Campaign']['id'] && $this->params->action !== 'admin_referrals' ? 'active' : ''; ?>
		                        		<?php echo $this->Html->link(__($campaignList['Campaign']['name']), '/admin/campaignUsers/index/' . $campaignList['Campaign']['id'], array('class' => $listActive)); ?>
			                        </li>
			                    <?php } ?>
		                    </ul>
	                    </li>
						<li class="dropdown <?php echo ($this->params->controller === 'campaignUsers' && $this->params->action === 'admin_referrals' ? 'active' : ''); ?>">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
	                        	<i class="icon-group"></i>
	                        	<span>User Rferrals</span> <b class="caret"></b>
	                        </a>
	                        <ul class="dropdown-menu">
	                        	<?php foreach($campaignLists as $campaignList) { ?>
		                        	<li>
		                        		<?php $listActive = isset($this->params->pass[0]) && $this->params->pass[0] == $campaignList['Campaign']['id'] && $this->params->action === 'admin_referrals' ? 'active' : ''; ?>
		                        		<?php echo $this->Html->link(__($campaignList['Campaign']['name']), '/admin/campaignUsers/referrals/' . $campaignList['Campaign']['id'], array('class' => $listActive)); ?>
			                        </li>
			                    <?php } ?>
		                    </ul>
	                    </li>
						<li class="<?php echo ($this->params->controller === 'pages' ? 'active' : ''); ?>">
							<a href="/admin/pages">
								<i class="icon-briefcase"></i>
								<span>Pages</span>
							</a>
						</li>
					</ul>
				</div> <!-- /container -->
			</div> <!-- /subnavbar-inner -->
		</div> <!-- /subnavbar -->

		<div class="main">
			<div class="main-inner">

				<?php echo $this->Session->flash(); ?>
				<!-- Content -->
				<?php echo $this->fetch('content'); ?>
					    
			</div> <!-- /main-inner -->
		</div> <!-- /main -->
		    
		<div class="footer">
			<div class="footer-inner">
				<div class="container">
					<div class="row">
		    			<div class="span12">
		    				&copy; 2013 <a href="http://www.rajakamar.com/">Rajakamar</a> is a registered trademark used under license by PT. Raja Kamar Indonesia.
		    			</div> <!-- /span12 -->
		    		</div> <!-- /row -->
				</div> <!-- /container -->
			</div> <!-- /footer-inner -->
		</div> <!-- /footer -->

	    <?php
			echo $this->Html->script('/js/jquery-1.7.2.min');
			echo $this->Html->script('/js/bootstrap');
			echo $this->Html->script('/js/base');
			echo $this->Html->script('/js/jquery-ui-1.8.21.custom.min');
			echo $this->Html->script('/js/jquery-ui-timepicker-addon');
			echo $this->Html->script('/js/tinymce/tinymce.min');
			if($this->params->controller === 'campaignUsers' && $this->params->action === 'admin_referrals') {
				echo $this->Html->script('/js/jquery.flot');
				echo $this->Html->script('/js/chart');
			}
			echo $this->Html->script('/js/main');

			echo $this->fetch('script');
		?>

  	</body>
</html>