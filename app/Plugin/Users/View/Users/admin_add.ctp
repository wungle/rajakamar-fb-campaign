<div class="container">
	<div class="row">
      	<div class="span12">      		
      		<div class="widget ">
      			<div class="widget-header">
      				<i class="icon-user"></i>
      				<h3>Your Account</h3>
  				</div>
        		<div class="widget-content">
					<?php echo $this->Form->create($model, array('class' => 'form-horizontal')); ?>
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="username">Username</label>
								<div class="controls">
									<?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Enter username here', 'class' => 'span3', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="email">Email</label>
								<div class="controls">
									<?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Enter email here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Enter password here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="temppassword">Password (confirm)</label>
								<div class="controls">
									<?php echo $this->Form->input('temppassword', array('type' => 'password', 'placeholder' => 'Enter temppassword here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="is_admin">Is Admin</label>
								<div class="controls">
									<?php echo $this->Form->input('is_admin', array('label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="active">Active</label>
								<div class="controls">
									<?php echo $this->Form->input('active', array('label' => false, 'escape' => false)); ?>
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