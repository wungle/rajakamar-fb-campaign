<div class="container">
  	<div class="row">
    	<div class="span6">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Campaign Users</h3>
          			<?php $linkCampUser = isset($campaignUsers[0]) ? $campaignUsers[0]['CampaignUser']['id'] : ''; ?>
					<?php echo $this->Html->link(__('View All'), '/admin/campaignUsers/index/' . $linkCampUser, array('class' => 'btn btn-small btn-float-right')); ?>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
          			<table class="table table-striped table-bordered">
            			<thead>
			              	<tr>
				                <th class="span2">Facebook Id</th>
				                <th class="span3">Name</th>
				                <th class="span2">Email</th>
				            </tr>
			            </thead>
			            <tbody>
			            	<?php foreach($campaignUsers as $campaignUser) { ?>
				              	<tr>
					                <td><?php echo $campaignUser['CampaignUser']['facebook_id']; ?></td>
					                <td><?php echo $campaignUser['CampaignUser']['name']; ?></td>
					                <td><?php echo $campaignUser['CampaignUser']['email']; ?></td>
					            </tr>
					        <?php } ?>
            			</tbody>
          			</table>
        		</div>
        		<!-- /widget-content --> 
			</div>
			<!-- /widget --> 
	    </div>
	    <!-- /span6 --> 
    	<div class="span6">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Campaigns</h3>
					<?php echo $this->Html->link(__('View All'), '/admin/campaigns', array('class' => 'btn btn-small btn-float-right')); ?>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
          			<table class="table table-striped table-bordered">
            			<thead>
			              	<tr>
				                <th class="span3">Name</th>
				                <th class="span1 center">Score</th>
				                <th class="span1 center">Published</th>
				                <th class="span2 center">Published Date</th>
				            </tr>
			            </thead>
			            <tbody>
			            	<?php foreach($campaigns as $campaign) { ?>
				              	<tr>
					                <td><?php echo $campaign['Campaign']['name']; ?></td>
					                <td class="center"><?php echo $campaign['Campaign']['max_score']; ?></td>
					                <td class="center"><?php echo ($campaign['Campaign']['published'] == 1 ? 'Yes' : 'No'); ?></td>
					                <td class="center"><?php echo $this->Time->format('d M Y', $campaign['Campaign']['publish_date']); ?></td>
					            </tr>
					        <?php } ?>
            			</tbody>
          			</table>
        		</div>
        		<!-- /widget-content --> 
			</div>
			<!-- /widget --> 
	    </div>
	    <!-- /span6 --> 
	</div>
	<!-- /row --> 
</div>
<!-- /container --> 