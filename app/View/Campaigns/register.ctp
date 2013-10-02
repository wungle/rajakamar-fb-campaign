<?php $disabled = isset($registered) && $registered == true ? 'disabled' : ''; ?>

<?php echo $this->Form->create('Campaign', array('action' => 'register/' . $campaignSlug)); ?>
<?php echo $this->Form->input('CampaignUser.name', array('value' => $fbName, $disabled)); ?>
<?php echo $this->Form->input('CampaignUser.email', array('value' => $fbEmail, $disabled)); ?>
<?php echo $this->Form->submit(isset($registered) && $registered == true ? 'Lanjutkan' : 'Daftar', array($disabled)); ?>
<?php echo $this->Form->end(); ?>

<?php echo $this->Facebook->like(array('href' => Configure::read('FB_URL_PAGE'), 'show_faces' => false, 'layout' => 'button_count')); ?>

<?php echo $this->Facebook->share(Router::url('/', true) . 'campaigns/' . $refferalId); //(default is the current page). ?>