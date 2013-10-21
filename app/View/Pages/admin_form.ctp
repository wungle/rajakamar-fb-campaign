<div class="container">
	<div class="row">
      	<div class="span12">      		
      		<div class="widget ">
      			<div class="widget-header">
      				<i class="icon-user"></i>
      				<h3>Your Account</h3>
  				</div>
        		<div class="widget-content">
					<?php echo $this->Form->create('Page', array('class' => 'form-horizontal')); ?>
						<fieldset>
							<?php
								if($this->params->action) {
									echo $this->Form->input('id');
								}
							?>

							<div class="control-group">
								<label class="control-label" for="title">Title</label>
								<div class="controls">
									<?php echo $this->Form->input('title', array('type' => 'text', 'placeholder' => 'Enter title here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="title">Resume</label>
								<div class="controls">
									<?php echo $this->Form->input('resume', array('type' => 'textarea', 'placeholder' => 'Enter resume here', 'class' => 'span4', 'label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="content">Content</label>
								<div class="controls">
									<?php 
										echo $this->Tinymce->input('content',
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
								<label class="control-label" for="published">Published</label>
								<div class="controls">
									<?php echo $this->Form->input('published', array('label' => false, 'escape' => false)); ?>
								</div>
							</div>

							<div class="form-actions">
								<?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary', 'div' => false)); ?>
								<?php echo $this->Html->link(__('Cancel'), '/admin/pages', array('class' => 'btn')); ?>
							</div>
						</fieldset>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>