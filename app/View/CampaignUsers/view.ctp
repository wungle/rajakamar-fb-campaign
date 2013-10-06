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

<?php echo $this->Html->link($this->Html->image('/main/images/facebookShare.png'), '#', array('onclick' => 'share_refferal(\'' . $refferalId . '\', \'' . $campaignTitle . '\')', 'escape' => false)); ?>

<?php echo $this->Html->link('Back to scores', '/campaignUsers/' . $campaignSlug); ?>