<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Creator.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Creator.creator_name', __('Name')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($creators as $creator) { ?>
			<tr>
				<td><?php echo $creator['Creator']['id']; ?></td>
				<td><?php echo $creator['Creator']['creator_name']; ?></td>
				<td>edit</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?= $this->Paginator->pagination(); ?>