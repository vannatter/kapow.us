<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('CreatorType.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('CreatorType.creator_short_name', __('Short Name')); ?></th>
			<th><?php echo $this->Paginator->sort('CreatorType.creator_type_name', __('Type Name')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($creatorTypes as $type) { ?>
			<tr>
				<td><?php echo $type['CreatorType']['id']; ?></td>
				<td><?php echo $type['CreatorType']['creator_short_name']; ?></td>
				<td><?php echo $type['CreatorType']['creator_type_name']; ?></td>
				<td>
					<?php echo $this->Html->link(__('edit'), sprintf('/admin/creatorTypes/edit/%s', $type['CreatorType']['id']), array(
						'class' => 'btn btn-small btn-inverse'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>