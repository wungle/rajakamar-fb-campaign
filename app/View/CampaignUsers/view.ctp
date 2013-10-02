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

<?php if($campaignClosed == true) { ?>
	<?php echo $this->Facebook->share(Router::url('/', true) . 'campaigns/' . $refferalId); //(default is the current page). ?>
<?php } ?>