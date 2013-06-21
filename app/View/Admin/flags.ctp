<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Flag.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Flag.status', __('Status')); ?></th>
			<th><?php echo $this->Paginator->sort('Flag.item_type', __('Type')); ?></th>
			<th><?php echo $this->Paginator->sort('Flag.created', __('Created')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($flags as $flag) { ?>
			<tr>
				<td><?php echo $flag['Flag']['id']; ?></td>
				<td><?php echo $flag['Flag']['status']; ?></td>
				<td><?php echo $flag['Flag']['item_type']; ?></td>
				<td><?php echo $flag['Flag']['created']; ?></td>
				<td>
					<?php echo $this->Html->link(__('edit'), sprintf('/admin/flags/view/%s', $flag['Flag']['id']), array(
						'class' => 'btn btn-small btn-inverse'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?= $this->Paginator->pagination(); ?>