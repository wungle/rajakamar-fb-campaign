<div class="container">
  	<div class="row">
    	<div class="span12">
      		<div class="widget widget-table action-table">
        		<div class="widget-header"> <i class="icon-th-list"></i>
          			<h3>User</h3>
        		</div>
        		<!-- /widget-header -->
        		<div class="widget-content">
					<dl class="dl-horizontal form-horizontal">
						<dt><?php echo __('Username'); ?></dt>
						<dd>
							<?php echo $user['User']['username']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Email'); ?></dt>
						<dd>
							<?php echo $user['User']['email']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Last Login'); ?></dt>
						<dd>
							<?php echo $user['User']['last_login']; ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Roles'); ?></dt>
						<dd>
							<?php echo ($user['User']['is_admin'] == 1 ? 'Admin' : 'User'); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Created'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $user['User']['created']); ?>
							&nbsp;
						</dd>

						<dt><?php echo __('Updated'); ?></dt>
						<dd>
							<?php echo $this->Time->format('d M Y', $user['User']['modified']); ?>
							&nbsp;
						</dd>

						<div class="form-actions">
							<?php echo $this->Html->link(__('<i class="btn-icon-only icon-edit"> </i>Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-medium btn-success', 'escape' => false)); ?>
							<?php echo $this->Html->link(__('Back'), '/admin/users', array('class' => 'btn')); ?>
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