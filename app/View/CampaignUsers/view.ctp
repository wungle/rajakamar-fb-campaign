<div class="campaignUsers view">
<h2><?php  echo __('Campaign User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Id'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['facebook_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Age'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refferal'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['refferal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($campaignUser['CampaignUser']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Campaign'); ?></dt>
		<dd>
			<?php echo $this->Html->link($campaignUser['Campaign']['name'], array('controller' => 'campaigns', 'action' => 'view', $campaignUser['Campaign']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Campaign User'), array('action' => 'edit', $campaignUser['CampaignUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Campaign User'), array('action' => 'delete', $campaignUser['CampaignUser']['id']), null, __('Are you sure you want to delete # %s?', $campaignUser['CampaignUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Campaign Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add')); ?> </li>
	</ul>
</div>
