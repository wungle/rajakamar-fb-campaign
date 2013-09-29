<div class="account-container">
	<div class="content clearfix">
		<?php echo $this->Form->create($model, array('url' => array('action' => 'reset_password', $token))); ?>
			<h1>Reset your password</h1>		
			<div class="login-fields">
				<?php echo $this->Session->flash(); ?>
					<div class="field">
						<label for="username">New Password</label>
						<?php echo $this->Form->input('new_password', array('label' => __d('users', 'New Password'), 'type' => 'password')); ?>
					</div> <!-- /field -->
					<div class="field">
						<label for="username">Confirm Password</label>
						<?php echo $this->Form->input('confirm_password', array('label' => __d('users', 'Confirm'),	'type' => 'password')); ?>
					</div> <!-- /field -->
			</div> <!-- /login-fields -->
			<div class="login-actions">
				<?php echo $this->Form->submit('Reset', array('class' => 'button btn btn-success btn-large')); ?>
			</div> <!-- .actions -->
		<?php echo $this->Form->End(); ?>
	</div> <!-- /content -->
</div> <!-- /account-container -->