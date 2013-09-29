<div class="container">
  	<div class="row">
    	<div class="span12">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>Campaign</h3>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
					<dl class="dl-horizontal form-horizontal">
						<dt><?php echo __('Name'); ?></dt>
						<dd>
							<?php echo $campaign['Campaign']['name']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Title'); ?></dt>
						<dd>
							<?php echo $campaign['Campaign']['title']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Terms'); ?></dt>
						<dd>
							<?php echo $campaign['Campaign']['terms']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Image'); ?></dt>
						<dd>
							<?php echo $campaign['Campaign']['name']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Published'); ?></dt>
						<dd>
							<?php echo $campaign['Campaign']['published']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Publish Date'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $campaign['Campaign']['publish_date']); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Created'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $campaign['Campaign']['created']); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Updated'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $campaign['Campaign']['updated']); ?>
							&nbsp;
						</dd>

						<div class="form-actions">
							<?php echo $this->Html->link(__('<i class="btn-icon-only icon-edit"> </i>Edit'), array('action' => 'edit', $campaign['Campaign']['id']), array('class' => 'btn btn-medium btn-success', 'escape' => false)); ?>
							<?php echo $this->Html->link(__('Back'), '/admin/campaigns', array('class' => 'btn')); ?>
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