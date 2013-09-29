<div class="campaignUsers index">
	<h2><?php echo __('Campaign Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('facebook_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('age'); ?></th>
			<th><?php echo $this->Paginator->sort('score'); ?></th>
			<th><?php echo $this->Paginator->sort('refferal'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('campaign_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($campaignUsers as $campaignUser): ?>
	<tr>
		<td><?php echo h($campaignUser['CampaignUser']['id']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['facebook_id']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['name']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['email']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['phone']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['address']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['age']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['score']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['refferal']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['created']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['updated']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($campaignUser['Campaign']['name'], array('controller' => 'campaigns', 'action' => 'view', $campaignUser['Campaign']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $campaignUser['CampaignUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $campaignUser['CampaignUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $campaignUser['CampaignUser']['id']), null, __('Are you sure you want to delete # %s?', $campaignUser['CampaignUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Campaign User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add')); ?> </li>
	</ul>
</div>
