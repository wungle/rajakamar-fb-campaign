<div id="title-login">
	<img src="/main/images/title_login.png" width="800" height="144" alt="title" />
</div>

<div id="main">
	<div class="maincontent">
		<div class="follow">
			<img src="/main/images/ikuti_text.png"  alt="ikuti cara berikut" />
		</div>
		<div style="padding-top:30px;"class="numbering">
			<h4>1.</h4>
		</div>
		<div class="form-wrapper">
			<?php $disabled = isset($registered) && $registered == true ? 'disabled' : ''; ?>

			<?php echo $this->Form->create('Campaign', array('action' => 'register/' . $campaignSlug)); ?>
				<p><?php echo $this->Form->input('CampaignUser.name', array('value' => $fbName, $disabled, 'label' => false, 'div' => false)); ?></p>
				<p><?php echo $this->Form->input('CampaignUser.email', array('value' => $fbEmail, $disabled, 'label' => false, 'div' => false)); ?></p>
				<p><?php echo $this->Form->submit(isset($registered) && $registered == true ? 'Lanjutkan' : 'Daftar', array($disabled)); ?></p>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="socialmedia">
			<div style="padding-top:50px;"class="numbering">
				<h4>2.</h4>
			</div>
			<div class="sosmed">
				<p>Like dan Follow RajaKamar</p>
			</div>
			<div class="fb_like"> 
				<?php echo $this->Facebook->like(array('href' => Configure::read('FB_URL_PAGE'), 'show_faces' => false, 'layout' => 'button_count', 'send' => false)); ?>
			</div>
			<div class="share"> 
				<?php if($campaignShared == false) { ?>
					<?php echo $this->Html->link($this->Html->image('/main/images/like.png', array('width' => '65', 'height' => '23')), '#', array('onclick' => 'share_me()', 'escape' => false)); ?>
				<?php } else { ?>
					<a href="#">
						<img src="/main/images/like.png" width="65" height="23" alt="like" />
					</a>
				<?php } ?>
			</div>
			<div class="txt">
				<p>*semakin banyak share, semakin terbuka peluang untuk jadi pemenang!</p>
			</div>
		</div>
	</div>
</div>

<div class="text-bottom">
	<p>
		Pemenang akan diumumkan jika fans Facebook RajaKamar telah 500.000. Baca Syarat & Ketentuannya.
		<br />
		untuk melihat skor sementara, 
		<a style="color:#ff9900; font-weight:bold;"href="#">klik disini.</a>
	</p>
</div>