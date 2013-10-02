<div class="campaignUsers index">
	<h2><?php echo __('Campaign Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('score'); ?></th>
			<th><?php echo $this->Paginator->sort('refferal'); ?></th>
	</tr>
	<?php foreach ($campaignUsers as $campaignUser): ?>
	<tr>
		<td><?php echo h($campaignUser['CampaignUser']['id']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['name']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['email']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['score']); ?>&nbsp;</td>
		<td><?php echo h($campaignUser['CampaignUser']['refferal']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>

	<br>

	<?php echo $this->Html->link('Lihat Skor', '/campaignUsers/view/' . $campaignSlug); ?>

	<br>
	<br>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

	<br>

	<?php if($campaignClosed == true) { ?>
		<a href="javascript:login('/campaigns/user_process/<?php echo $campaignSlug; ?>');">Daftar</a>
	<?php } ?>
</div>