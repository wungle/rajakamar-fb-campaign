<div class="container">
  	<div class="row">
    	<div class="span12">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Page</h3>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
					<dl class="dl-horizontal form-horizontal">
						<dt><?php echo __('Title'); ?></dt>
						<dd>
							<?php echo $page['Page']['title']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Resume'); ?></dt>
						<dd>
							<?php echo $page['Page']['resume']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Content'); ?></dt>
						<dd>
							<?php echo $page['Page']['content']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Published'); ?></dt>
						<dd>
							<?php echo ($page['Page']['published'] == 1 ? 'Yes' : 'No'); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Created'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $page['Page']['created']); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Updated'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $page['Page']['updated']); ?>
							&nbsp;
						</dd>

						<div class="form-actions">
							<?php echo $this->Html->link(__('<i class="btn-icon-only icon-edit"> </i>Edit'), array('action' => 'edit', $page['Page']['id']), array('class' => 'btn btn-medium btn-success', 'escape' => false)); ?>
							<?php echo $this->Html->link(__('Back'), '/admin/pages', array('class' => 'btn')); ?>
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