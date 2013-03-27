<?php
/**
 *@var $this View
 */
?>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Item.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Item.item_name', __('Name')); ?></th>
		<th><?php echo $this->Paginator->sort('Section.section_name', __('Section')); ?></th>
		<th><?php echo $this->Paginator->sort('Publisher.publisher_name', __('Publisher')); ?></th>
		<th><?php echo $this->Paginator->sort('Series.series_name', __('Series')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($items as $item) { ?>
		<tr>
			<td><?php echo $item['Item']['id']; ?></td>
			<td><?php echo $item['Item']['item_name']; ?></td>
			<td><?php echo $item['Section']['section_name']; ?></td>
			<td><?php echo $item['Publisher']['publisher_name']; ?></td>
			<td><?php echo $item['Series']['series_name']; ?></td>
			<td>
				<?php echo $this->Html->link(__('edit'), sprintf('/admin/items/edit/%s', $item['Item']['id']), array(
					'class' => 'btn btn-small btn-inverse'
				)); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?= $this->Paginator->pagination(); ?>