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
				                <th class="span2"><?php echo $this->Paginator->sort('facebook_id', 'Facebook Id'); ?></th>
				                <th class="span5"><?php echo $this->Paginator->sort('name'); ?></th>
				                <th class="span1 center"><?php echo $this->Paginator->sort('email'); ?></th>
				                <th class="span1 center"><?php echo $this->Paginator->sort('phone'); ?></th>
				                <th class="span1 center"><?php echo $this->Paginator->sort('score'); ?></th>
				                <th class="span1 center"><?php echo $this->Paginator->sort('refferal'); ?></th>
				                <th class="td-actions span1 center"> </th>
				            </tr>
			            </thead>
			            <tbody>
							<?php foreach ($campaignUsers as $campaignUser) { ?>
				              	<tr>
									<td><?php echo $campaignUser['CampaignUser']['facebook_id']; ?>&nbsp;</td>
									<td><?php echo $campaignUser['CampaignUser']['name']; ?>&nbsp;</td>
									<td><?php echo $campaignUser['CampaignUser']['email']; ?>&nbsp;</td>
									<td><?php echo $campaignUser['CampaignUser']['phone']; ?>&nbsp;</td>
									<td class="center"><?php echo $campaignUser['CampaignUser']['score']; ?>&nbsp;</td>
									<td class="center"><?php echo $campaignUser['CampaignUser']['refferal']; ?>&nbsp;</td>
					                <td class="td-actions center">
										<?php echo $this->Html->link(__('<i class="btn-icon-only icon-search"> </i>'), array('action' => 'view', $campaignUser['CampaignUser']['id']), array('class' => 'btn btn-small', 'escape' => false)); ?>
										<?php //echo $this->Form->postLink(__('<i class="btn-icon-only icon-remove"> </i>'), array('action' => 'delete', $campaignUser['CampaignUser']['id']), array('class' => 'btn btn-danger btn-small', 'escape' => false), __('Are you sure you want to delete # %s?', $campaignUser['CampaignUser']['id'])); ?>
					                </td>
					            </tr>
					        <?php } ?>
            			</tbody>
          			</table>
					<!-- PAGINATION START -->
					<?php if ( ($this->Paginator->counter() != "1 of 1") && ($this->Paginator->counter() != "0 of 1")) { ?>
						<div class="accordion-heading">
							<?php $replacement = "<span></span>"; ?>
							<div class="pagination">
								<div class="pagination-body" align="center">
									<?php echo str_replace("MyPrevious", $replacement, $this->Paginator->prev("MyPrevious", array("class" => "prev"))) . "\n"; ?>
									<?php echo $this->Paginator->numbers(array("separator" => " ", "class" => "numbers")) . "\n"; ?>
									<?php echo str_replace("MyNext", $replacement, $this->Paginator->next("MyNext", array("class" => "next"))) . "\n"; ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<!-- PAGINATION ENDS -->
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