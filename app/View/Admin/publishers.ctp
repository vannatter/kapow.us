<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Publisher.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Publisher.publisher_name', __('Name')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($publishers as $publisher) { ?>
			<tr>
				<td><?php echo $publisher['Publisher']['id']; ?></td>
				<td><?php echo $publisher['Publisher']['publisher_name']; ?></td>
				<td>edit</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?= $this->Paginator->pagination(); ?>