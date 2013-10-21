<div class="container">
  	<div class="row">
    	<div class="span12">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Pages</h3>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
          			<table class="table table-striped table-bordered">
            			<thead>
            				<!-- <tr>
            					<div class="accordion-heading">
									<?php //echo $this->Html->link(__('<i class="btn-icon-only icon-pencil"> </i> New'), array('action' => 'add'), array('class' => 'btn btn-small btn-add', 'escape' => false)); ?>
                                </div>
							</tr> -->
			              	<tr>
				                <th class="span5"><?php echo $this->Paginator->sort('title'); ?></th>
				                <th class="span5"><?php echo $this->Paginator->sort('resume'); ?></th>
				                <th class="span1 center"><?php echo $this->Paginator->sort('published'); ?></th>
				                <th class="span2 center"><?php echo $this->Paginator->sort('created'); ?></th>
				                <th class="td-actions span2 center"> </th>
				            </tr>
			            </thead>
			            <tbody>
							<?php foreach ($pages as $page) { ?>
				              	<tr>
									<td><?php echo $page['Page']['title']; ?>&nbsp;</td>
									<td><?php echo $page['Page']['resume']; ?>&nbsp;</td>
									<td class="center"><?php echo ($page['Page']['published'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
									<td class="center"><?php echo $this->Time->format('d M Y', $page['Page']['created']); ?>&nbsp;</td>
					                <td class="td-actions center">
										<?php echo $this->Html->link(__('<i class="btn-icon-only icon-search"> </i>'), array('action' => 'view', $page['Page']['id']), array('class' => 'btn btn-small', 'escape' => false)); ?>
										<?php echo $this->Html->link(__('<i class="btn-icon-only icon-ok"> </i>'), array('action' => 'edit', $page['Page']['id']), array('class' => 'btn btn-small btn-success', 'escape' => false)); ?>
										<?php //echo $this->Form->postLink(__('<i class="btn-icon-only icon-remove"> </i>'), array('action' => 'delete', $page['Page']['id']), array('class' => 'btn btn-danger btn-small', 'escape' => false), __('Are you sure you want to delete # %s?', $page['Page']['id'])); ?>
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