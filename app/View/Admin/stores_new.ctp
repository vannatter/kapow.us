<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Store.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Store.name', __('Name')); ?></th>
			<th><?php echo $this->Paginator->sort('Store.city', __('City')); ?></th>
			<th><?php echo $this->Paginator->sort('Store.state', __('State')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($stores as $store) { ?>
			<tr>
				<td><?php echo $store['Store']['id']; ?></td>
				<td><?php echo $store['Store']['name']; ?></td>
				<td><?php echo $store['Store']['city']; ?></td>
				<td><?php echo $store['Store']['state']; ?></td>
				<td>
					<?php echo $this->Html->link(__('View'), sprintf('/admin/stores/new/view/%s', $store['Store']['id']), array(
						'class' => 'btn btn-small btn-inverse'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>