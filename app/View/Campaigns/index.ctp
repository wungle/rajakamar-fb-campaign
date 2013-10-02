<!-- <img src="http://flymetothehaven.bookpanorama.com/themes/thehaven/assets/image/ad-the-haven.png?20130816" usemap="#map">
<map id="map" name="map">
	<area shape="rect" alt="KLIK DISINI" title="KLIK DISINI" coords="355,473,611,532" href="javascript:login('<?php //echo $this->params->here; ?>');">
</map> -->

<a href="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>');">Klik Disini</a>

<?php //echo $this->Facebook->logout(array('img' => '/facebook-logout.png')); ?>

<?php //echo $this->Facebook->share('http://www.example.com/url_to_share'); //(default is the current page). ?>