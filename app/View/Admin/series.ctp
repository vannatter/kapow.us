<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Series.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Series.series_name', __('Name')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($series as $ser) { ?>
			<tr>
				<td><?php echo $ser['Series']['id']; ?></td>
				<td><?php echo $ser['Series']['series_name']; ?></td>
				<td>edit</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?= $this->Paginator->pagination(); ?>