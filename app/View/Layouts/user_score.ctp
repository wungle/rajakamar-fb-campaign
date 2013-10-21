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
		<div id="top-bg"></div>
		<div id="container">
            <div id="logo"> 
            	<a href="http://www.rajakamar.com/"><img src="/main/images/Logo-Rajakamar.png" width="250" height="76" alt="Logo" /></a>
          	</div>
            <div style="padding-top:150px;"class="clearfix"></div>
           	<div id="header_title">
            	<img src="/main/images/title.png" width="900" height="77" alt="header-title" />
            </div>
    		<div style="border-bottom:2px dotted #999; margin:0 auto; width:900px; padding-top:25px;"class="clearfix"></div>
          	<div class="campaign">
				<?php if($campaignClosed == false) { ?>
		          	<h1>Belum ikutan?</h1>
		          	<p>Segera daftarkan diri kamu untuk ikut Singapore 360 Exploration, dan dapatkan kesempatan untuk liburan ke Singapore bersama Rajakamar! Pesawat, hotel, dan akomodasinya ditanggung Rajakamar!</p>
	        	<?php } else { ?>
		          	<h1>Sorry, campaign is closed!!!</h1>
		        <?php } ?>
            </div>

            <?php echo $this->Session->flash(); ?>

            <!-- Content -->
			<?php echo $this->fetch('content'); ?>

		</div>

	    <?php echo $this->Facebook->init(); ?>
	</body>
</html>