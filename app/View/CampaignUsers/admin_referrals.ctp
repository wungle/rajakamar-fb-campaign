<script>
	var datasets = <?php echo $dataSet; ?>
</script>

<div class="container">
  	<div class="row">
    	<div class="span12">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Campaign Users</h3>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
          			<table class="table table-striped table-bordered">
            			<thead>
			              	<tr>
				                <th class="span1">No.</th>
				                <th class="span2">Facebook Id</th>
				                <th class="span5">Name</th>
				                <th class="span1 center">Email</th>
				                <th class="span1 center">Ranking</th>
				                <th class="span1 center">Score</th>
				                <th class="span2 center">This Month</th>
				                <th class="td-actions span2 center"> </th>
				            </tr>
			            </thead>
			            <tbody>
							<?php foreach ($campaignUsers as $key => $campaignUser) { ?>
				              	<tr>
				              		<td><?php echo ++$key; ?></td>
									<td><?php echo $campaignUser['CampaignUser']['facebook_id']; ?>&nbsp;</td>
									<td><?php echo $campaignUser['CampaignUser']['name']; ?>&nbsp;</td>
									<td><?php echo $campaignUser['CampaignUser']['email']; ?>&nbsp;</td>
									<td class="center"><?php echo (isset($campaignUser[0]) && isset($campaignUser[0]['position']) ? $campaignUser[0]['position'] : ''); ?>&nbsp;</td>
									<td class="center"><?php echo $campaignUser['CampaignUser']['score']; ?>&nbsp;</td>
									<td class="center"><?php echo (isset($campaignUser[0]) && isset($campaignUser[0]['count']) ? $campaignUser[0]['count'] : ''); ?>&nbsp;</td>
					                <td class="td-actions center">
										<?php echo $this->Html->link(__('<i class="btn-icon-only icon-search"> </i>'), array('action' => 'view', $campaignUser['CampaignUser']['id']), array('class' => 'btn btn-small', 'escape' => false)); ?>
										<?php //echo $this->Form->postLink(__('<i class="btn-icon-only icon-remove"> </i>'), array('action' => 'delete', $campaignUser['CampaignUser']['id']), array('class' => 'btn btn-danger btn-small', 'escape' => false), __('Are you sure you want to delete # %s?', $campaignUser['CampaignUser']['id'])); ?>
					                </td>
					            </tr>
					        <?php } ?>
            			</tbody>
          			</table>
        		</div>
        		<!-- /widget-content --> 
			</div>
			<!-- /widget --> 
	    </div>
	    <!-- /span12 -->
	</div>
	<!-- /row --> 

  	<div class="row">
    	<div class="span12">
			<div class="demo-container span12">
				<div id="placeholder" class="demo-placeholder"></div>
				<p id="choices"></p>
			</div>
	    </div>
	    <!-- /span12 -->
	</div>
	<!-- /row --> 

</div>
<!-- /container -->