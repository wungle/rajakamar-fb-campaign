<?php $disabled = isset($registered) && $registered == true ? 'disabled' : ''; ?>

<div class="login">
	<h1>Silahkan Isi</h1>
	<?php echo $this->Form->create('Campaign', array('action' => 'register/' . $campaignSlug)); ?>
		<p><?php echo $this->Form->input('CampaignUser.name', array('value' => $fbName, $disabled, 'label' => false, 'div' => false)); ?></p>
		<p><?php echo $this->Form->input('CampaignUser.email', array('value' => $fbEmail, $disabled, 'label' => false, 'div' => false)); ?></p>
		<p><?php echo $this->Form->submit(isset($registered) && $registered == true ? 'Lanjutkan' : 'Daftar', array($disabled)); ?></p>
	<?php echo $this->Form->end(); ?>

	<?php //echo $this->Facebook->like(array('href' => Configure::read('FB_URL_PAGE'), 'show_faces' => false, 'layout' => 'button_count')); ?>

	<?php //echo $this->Html->link($this->Html->image('/main/images/facebookShare.png'), '#', array('onclick' => 'share_me()', 'escape' => false)); ?>
</div>