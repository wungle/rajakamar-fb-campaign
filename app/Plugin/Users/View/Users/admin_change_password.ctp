<div class="container">
	<div class="row">
      	<div class="span12">      		
      		<div class="widget ">
      			<div class="widget-header">
      				<i class="icon-user"></i>
      				<h3>Your Account</h3>
  				</div>
        		<div class="widget-content">
					<?php echo $this->Form->create($model, array('action' => 'change_password', 'class' => 'form-horizontal')); ?>
						<fieldset>
							<?php echo $this->Form->input('id'); ?>

							<div class="control-group">
								<label class="control-label" for="old_password">Old Password</label>
								<div class="controls">
									<?php echo $this->Form->input('old_password', array('type' => 'text', 'placeholder' => 'Enter old_password here', 'class' => 'span3', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="new_password">New Password</label>
								<div class="controls">
									<?php echo $this->Form->input('new_password', array('type' => 'text', 'placeholder' => 'Enter new_password here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="confirm_password">Confirm Password</label>
								<div class="controls">
									<?php echo $this->Form->input('confirm_password', array('type' => 'text', 'placeholder' => 'Enter confirm_password here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="form-actions">
								<?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary', 'div' => false)); ?>
								<?php echo $this->Html->link(__('Cancel'), '/admin/users', array('class' => 'btn')); ?>
							</div>
						</fieldset>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>