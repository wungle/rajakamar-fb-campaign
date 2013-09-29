<div class="container">
  	<div class="row">
    	<div class="span12">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Campaign User</h3>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
					<dl class="dl-horizontal form-horizontal">
						<dt><?php echo __('Facebook Id'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['facebook_id']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Name'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['name']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Email'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['email']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Phone'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['phone']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Address'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['address']; ?>
							&nbsp;
						</dd>


						<dt><?php echo __('Age'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['age']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Score'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['score']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Refferal'); ?></dt>
						<dd>
							<?php echo $campaignUser['CampaignUser']['refferal']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Created'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $campaignUser['CampaignUser']['created']); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Updated'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $campaignUser['CampaignUser']['updated']); ?>
							&nbsp;
						</dd>

						<div class="form-actions">
							<?php echo $this->Html->link(__('Back'), '/admin/campaignUsers', array('class' => 'btn')); ?>
						</div>
					</dl>
        		</div>
        		<!-- /widget-content --> 
			</div>
			<!-- /widget --> 
	    </div>
	    <!-- /span12 -->
	</div>
	<!-- /row --> 
</div>
<!-- /container -->