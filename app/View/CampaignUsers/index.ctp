<div id="top-bg"></div>
<div id="container">
    <div id="logo">
        <a href="http://www.rajakamar.com/">
            <img src="/main/images/Logo-Rajakamar.png" width="250" height="76" alt="Logo" />
        </a>
    </div>
    <div id="logo-singapore">
        <img src="/main/images/logo_360.png" width="250" height="65" alt="Icon" />
    </div>
    <div style="padding-top: 10px; padding-bottom: 0px;" class="clearfix"></div>
    <div style="padding-top: 30px;" class="clearfix"></div>
    <div id="header_title">
        <img src="/main/images/boottom_title.png" width="750" height="64" alt="Title_bottom" />
    </div>
    <div style="border-bottom: 1px dotted #999; margin: 0 auto; width: 900px; padding-top: 25px;" class="clearfix">
    </div>
    <?php echo $this->Form->create('CampaignUser', array('action' => 'search', 'class' => 'form-wrapper cf')); ?>
    	<?php echo $this->Form->input('CampaignUser.keyword', array('placeholder' => 'Cari berdasarkan nama...', 'label' => false)); ?>
        <button type="submit">Cari</button>
    <?php echo $this->Form->end(); ?>
    <div class="campaign">
        <div style="clear: both;">
            &nbsp;
        </div>
        <span>Kamu punya kesempatan untuk berlibur ke Singapura 3 hari 2 malam. Semua akomodasi ditanggung Rajakamar.
        </span>
        <div id="login_now" style="padding-top: 20px;">
            <form style="" id="Form1">
                <input type="button" onclick="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>');" value='Daftar' />
            </form>
        </div>
    </div>
    <div style="clear:both; padding-top:10px;">
        <img src="/main/images/title.png" width="910" height="78" alt="header-title" />
    </div>
    <div class="wrap-table1">
        <table style="width: 450px; margin: 0 auto; padding-top: 220px;" class="skor-sementara" border="0" width="100%">
            <tbody>
            	<tr>
					<td><?php echo $this->Paginator->sort('ranking'); ?></td>
					<td><?php echo $this->Paginator->sort('name', 'Nama'); ?></td>
					<td><?php echo $this->Paginator->sort('score', 'Skor'); ?></td>
					<td><?php echo $this->Paginator->sort('refferal', 'Jumlah Refferal'); ?></td>
				</tr>
				<?php foreach ($campaignUsers as $campaignUser) { ?>
					<tr>
						<td><?php echo $campaignUser['CampaignUser']['id']; ?>&nbsp;</td>
						<td><?php echo $campaignUser['CampaignUser']['name']; ?>&nbsp;</td>
						<td><span class="point1_"><?php echo $campaignUser['CampaignUser']['score']; ?></span></td>
						<td><span class="point2_"><?php echo $campaignUser['CampaignUser']['refferal']; ?></span></td>
					</tr>
				<?php } ?>
            </tbody>
        </table>
    </div>
    <div id="lihatskor">
        <form style="" id="button">
            <input type="button" onclick="parent.location = '/campaignUsers/view/<?php echo $campaignSlug; ?>'" value='Lihat Skor'>
        </form>
    </div>

    <div class="pagination pagination-small pagination-centered">
    	<ul>
			<?php
				echo $this->Paginator->prev(__('«'), array('tag' => 'li', 'disabledTag' => 'span', 'escape' => false));
				echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
				echo $this->Paginator->next(__('»'), array('tag' => 'li', 'disabledTag' => 'span', 'escape' => false));
			?>
		</ul>
	</div>
    <div style="clear: both; padding-top: 30px;" id="footer">
        <p style="color: #999; font-size: 11px;">copyright &copy; RajaKamar 2012 All Rights Reserved.</p>
    </div>
</div>