<div class="account-container">
	<div class="content clearfix">
		<?php echo $this->Form->create($model, array('url' => array('admin' => false, 'action' => 'reset_password'))); ?>
			<h1>Forgot your password?</h1>		
			<div class="login-fields">
				<p>Please enter the email you used for registration and you'll get an email with further instructions.</p>
				<?php echo $this->Session->flash(); ?>
					<div class="field">
						<label for="email">Username</label>
						<?php echo $this->Form->input('email', array('label' => __d('users', 'Your Email'))); ?>
					</div> <!-- /field -->
			</div> <!-- /login-fields -->
			<div class="login-actions">
				<?php echo $this->Form->submit(__d('users', 'Submit'), array('class' => 'button btn btn-success btn-large', 'style' => 'float: left')); ?>
				<?php echo $this->Html->link(__('Login'), '/admin/login', array('class' => 'button btn btn-success btn-large')); ?>
			</div> <!-- .actions -->
		<?php echo $this->Form->End(); ?>
	</div> <!-- /content -->
</div> <!-- /account-container -->