<div id="top-bg"></div>
<div id="container">
    <div id="logo"> 
    	<a href="http://www.rajakamar.com/">
    		<img src="/main/images/Logo-Rajakamar.png" width="250" height="76" alt="Logo" />
    	</a>
  	</div>
    <div style="padding-top:150px;"class="clearfix"></div>
    <div id="landing-page">
        <div class="landing-box">
        	<img src="/main/images/Landing-Page.png" width="900" height="635" alt="landing page" />
        </div>
        <div class="faq">
          	<a href="/pages/<?php echo $pageFaq['Page']['slug']; ?>">
          		<img src="/main/images/sk.png" width="250" height="83" alt="FAQ" />
          	</a>
      	</div>
        <div class="clickhere">
        	<a href="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>')">
        		<img src="/main/images/klik_daftar.png" width="134" height="235" alt="daftar" />
        	</a>
        </div>
  	</div>
    <div style="margin-top:20px;" id="lihatskor">
		<form style=""id="button"> 
    		<input type=button onClick="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>')" value='Lihat Skor Saya'>  
		</form>  
    </div>                    
    <div style="clear: both; padding-top:30px;"id="footer">
    	<p style="color:#999; font-size:11px;">copyright &copy; RajaKamar 2012 All Rights Reserved.</p>
    </div>
</div>