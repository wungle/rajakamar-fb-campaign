<div class="account-container">
	<div class="content clearfix">
		<?php echo $this->Form->create($model, array('action' => 'login', 'id' => 'LoginForm')); ?>
			<h1>Admin Login</h1>		
			<div class="login-fields">
				<p>Please provide your details</p>
				<?php echo $this->Session->flash(); ?>
					<div class="field">
						<label for="username">Username</label>
						<?php echo $this->Form->input('email', array('placeholder' => 'Username', 'label' => false, 'class' => 'login username-field')); ?>
					</div> <!-- /field -->
					<div class="field">
						<label for="password">Password:</label>
						<?php echo $this->Form->input('password',  array('placeholder' => 'Password', 'label' => false, 'class' => 'login password-field')); ?>
					</div> <!-- /password -->
			</div> <!-- /login-fields -->
			<div class="login-actions">
				<span class="login-checkbox">
					<?php echo $this->Form->input('remember_me', array('type' => 'checkbox', 'class' => 'field login-checkbox', 'tabindex' => 4, 'label' => false, 'div' => false)); ?>
					<label class="choice" for="Field">Keep me signed in</label>
					<?php echo $this->Form->hidden('User.return_to', array('value' => $return_to)); ?>
				</span>
				<?php echo $this->Form->submit('Sign In', array('class' => 'button btn btn-success btn-large')); ?>
			</div> <!-- .actions -->
			<div class="login-actions">
				<span class="">
					<label class="choice" for="Field">
						<?php echo $this->Html->link(__('Reset Password'), '/users/reset_password'); ?>
					</label>
				</span>
			</div> <!-- .actions -->
		<?php echo $this->Form->End(); ?>
	</div> <!-- /content -->
</div> <!-- /account-container -->