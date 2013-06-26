<?php
/**
 * @var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('UserActivity.controller', __('Controller')); ?></th>
			<th><?php echo __('Path'); ?></th>
			<th><?php echo $this->Paginator->sort('UserActivity.created', __('Created')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($details as $row) { ?>
			<tr>
				<td><?php echo $row['UserActivity']['controller']; ?></td>
				<td><?php echo sprintf('%s/%s', $row['UserActivity']['controller'], $row['UserActivity']['action']); ?></td>
				<td><?php echo $row['UserActivity']['created']; ?></td>
				<td>
					<?php echo $this->Html->link(__('details'), sprintf('/admin/userActivity/details/%s/%s', $row['User']['id'],
						$row['UserActivity']['id']), array('class' => 'btn btn-small btn-success')); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>