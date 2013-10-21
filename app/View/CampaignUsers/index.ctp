<div id="login_now">
    <?php if($campaignClosed == false) { ?>
        <form style="" id="button">
            <input type="button" onclick="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>');" value='Daftar' />
        </form>
    <?php } ?>
</div>

<div style="border-bottom:2px dotted #999; margin:0 auto; width:900px; padding-top:25px;"class="clearfix"></div>


<?php echo $this->Form->create('CampaignUsers', array('action' => 'search/' . $campaignSlug, 'class' => 'form-wrapper cf')); ?>
    <?php echo $this->Form->input('CampaignUser.keyword', array('placeholder' => 'Cari berdasarkan nama, skor dan refferal...', 'label' => false)); ?>
    <button type="submit">Cari</button>
<?php echo $this->Form->end(); ?>

<div class="wrap-table1">
    <table style="width:450px; margin:0 auto;padding-top:220px;margin-left:100px;"class="skor-sementara" border="0" width="100%">
        <tbody>
            <tr>
                <td><?php echo $this->Paginator->sort('ranking'); ?></td>
                <td><?php echo $this->Paginator->sort('name', 'Nama'); ?></td>
                <td><?php echo $this->Paginator->sort('score', 'Skor'); ?></td>
                <td><?php echo $this->Paginator->sort('refferal', 'Jumlah Refferal'); ?></td>
            </tr>
            <?php foreach ($campaignUsers as $key => $campaignUser) { ?>
                <tr>
                    <td><?php echo (isset($campaignUser[0]) ? $campaignUser[0]['position'] : ''); ?></td>
                    <!-- <td><?php //echo ++$key; ?>&nbsp;</td> -->
                    <td><?php echo $campaignUser['CampaignUser']['name']; ?>&nbsp;</td>
                    <td><span class="point1_"><?php echo $campaignUser['CampaignUser']['score']; ?></span></td>
                    <td><span class="point2_"><?php echo (isset($campaignUser[0]) && isset($campaignUser[0]['refferal']) ? $campaignUser[0]['refferal'] : 0); ?></span></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>                    
</div>  
        
<div id="lihatskor">
    <form style="" id="button"> 
        <input type="button" onClick="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>')" value="Lihat Skor Saya">  
    </form>  
</div>                    

<?php if ( ($this->Paginator->counter() != "1 of 1") && ($this->Paginator->counter() != "0 of 1")) { ?>
    <div class="pagination pagination-small pagination-centered">
        <ul>
            <?php
                echo $this->Paginator->prev(__('«'), array('tag' => 'li', 'disabledTag' => 'span', 'escape' => false));
                echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                echo $this->Paginator->next(__('»'), array('tag' => 'li', 'disabledTag' => 'span', 'escape' => false));
            ?>
        </ul>
    </div>
<?php } ?>

<div style="clear: both; padding-top:30px;"id="footer">
    <p style="color:#999; font-size:11px;">copyright &copy; RajaKamar 2012 All Rights Reserved.</p>
</div>