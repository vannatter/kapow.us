<?php
/**
 * @var View $this
 */
?>
<div class="well">
	<?php echo $this->Html->link(__('New Message'), '/admin/appMessages/new', array('class' => 'btn')); ?>
</div>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('AppMessage.title', __('Title')); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Created'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($messages as $message) { ?>
		<tr>
			<td><?php echo $message['AppMessage']['title']; ?></td>
			<td><?php echo $message['User']['username']; ?></td>
			<td><?php echo $message['AppMessage']['created']; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>