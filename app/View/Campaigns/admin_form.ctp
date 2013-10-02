<div class="container">
	<div class="row">
      	<div class="span12">      		
      		<div class="widget ">
      			<div class="widget-header">
      				<i class="icon-user"></i>
      				<h3>Your Account</h3>
  				</div>
        		<div class="widget-content">
					<?php echo $this->Form->create('Campaign', array('class' => 'form-horizontal')); ?>
						<fieldset>
							<?php
								if($this->params->action) {
									echo $this->Form->input('id');
								}
							?>

							<div class="control-group">
								<label class="control-label" for="max_score">Publish Date</label>
								<div class="controls">
									<?php echo $this->Form->input('publish_date', array('type' => 'text', 'placeholder' => 'Enter publish date here', 'label' => false, 'class' => 'input-medium focused datepicker', 'id' => 'publish_date', 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="name">Name</label>
								<div class="controls">
									<?php echo $this->Form->input('name', array('type' => 'text', 'placeholder' => 'Enter name here', 'class' => 'span3', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="title">Title</label>
								<div class="controls">
									<?php echo $this->Form->input('title', array('type' => 'text', 'placeholder' => 'Enter title here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="terms">Terms</label>
								<div class="controls">
									<?php 
										echo $this->Tinymce->input('terms',
											array(
											   'id' => 'body-text',
											   'div' => 'control-group',
											   'label' => false,
											   'rows' => '8'
											),
											array(
											   'selector' => '#body-text'
											), 'full'
										);
									?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="max_score">Max Score</label>
								<div class="controls">
									<?php echo $this->Form->input('max_score', array('type' => 'text', 'placeholder' => 'Enter max score here', 'class' => 'span2', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="score">Score</label>
								<div class="controls">
									<?php echo $this->Form->input('score', array('type' => 'text', 'placeholder' => 'Enter score here', 'class' => 'span2', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="refferal">Refferal</label>
								<div class="controls">
									<?php echo $this->Form->input('refferal', array('type' => 'text', 'placeholder' => 'Enter refferal here', 'class' => 'span2', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="image">Image</label>
								<div class="controls">
									<?php echo $this->Form->input('image', array('type' => 'text', 'class' => 'span2', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="published">Published</label>
								<div class="controls">
									<?php echo $this->Form->input('published', array('label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="form-actions">
								<?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary', 'div' => false)); ?>
								<?php echo $this->Html->link(__('Cancel'), '/admin/campaigns', array('class' => 'btn')); ?>
							</div>
						</fieldset>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>