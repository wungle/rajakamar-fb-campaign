<div class="guest">
	<div style="margin-top:20px;"class="photo"><?php echo $this->Facebook->picture($fbId, array('width' => '80')); ?></div>
	<div class="insert">
		<p>Jumlah nilai & ranking sementara kamu adalah sebagai berikut:</p>
	</div>
</div>
                                
<div style="border-bottom:1px dashed #ccc; width:700px; margin:0 auto; padding-bottom:20px;"class="split-top"></div>
                    
<div id="scoreboard">
	<div class="wrapper">
		<div class="wrapper-board">
	        <div class="point">
	            <p><?php echo $ranking; ?></p>
            </div>
            <div class="btm-txt">
                <h2>Rangking</h2>
            </div>
		</div>
		                              
		<div class="wrapper-board">
	        <div class="point">
	            <p><?php echo $score; ?></p>
            </div>
	        <div class="btm-txt">
                <h2>Nilai</h2>
            </div>
      	</div>

		<div class="wrapper-board">
	        <div class="point">
            	<p><?php echo ($refferal == null ? 0 : $refferal); ?></p>
            </div>
            <div class="btm-txt">
                <h2>Jumlah Referal</h2>
            </div>
      	</div>
	</div>
		                 
	<div class="btm-txt-2" >
		<h4 style="color:#66cc33;">Kamu bisa menambahkan skormu dengan share Singapore 360 Exploration. Yuk Share!</h4>
	</div>
                                                              
	<div style="margin-top:-50px;" id="lihatskor">
		<form style=""id="button"> 
			<?php if($campaignClosed == false) { ?>
				<?php if($campaignShared == false) { ?>
					<input type="button" value="SHARE TIME <?php echo $shareTime; ?>">
				<?php } else { ?>
            		<input type=button onClick="<?php echo 'share_refferal(\'' . $refferalId . '\', \'' . $campaignTitle . '\')'; ?>" value="SHARE">  
				<?php } ?>
			<?php } ?>
    		<input type=button onClick="parent.location='/campaignUsers/<?php echo $campaignSlug; ?>'" value="BACK">  
        </form>  
    </div>                    

</div>