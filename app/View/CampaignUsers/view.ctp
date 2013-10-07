<?php echo $this->Facebook->picture($fbId); ?> Hai, <?php echo $fbName; ?>

<br>
<br>

Ranking : 
<br>
Score : <?php echo $score; ?>
<br>
Jumlah Referal : <?php echo ($refferal == null ? 0 : $refferal); ?>

<br>
<br>

<?php if($campaignClosed == false) { ?>
	<?php if($campaignShared == false) { ?>
		<?php echo $this->Html->image('/main/images/facebookShare.png'); ?>
		<?php echo $shareTime; ?>
	<?php } else { ?>
		<?php echo $this->Html->link($this->Html->image('/main/images/facebookShare.png'), '#', array('onclick' => 'share_refferal(\'' . $refferalId . '\', \'' . $campaignTitle . '\')', 'escape' => false)); ?>
	<?php } ?>
<?php } ?>

<?php echo $this->Html->link('Back to scores', '/campaignUsers/' . $campaignSlug); ?>