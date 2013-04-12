<?php
/**
 *@var $this View
 */
?>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Report.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Report.status', __('Status')); ?></th>
		<th><?php echo $this->Paginator->sort('Report.item_type', __('Type')); ?></th>
		<th><?php echo $this->Paginator->sort('Report.created', __('Created')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($reports as $report) { ?>
		<tr>
			<td><?php echo $report['Report']['id']; ?></td>
			<td><?php echo $report['Report']['status']; ?></td>
			<td><?php echo $report['Report']['item_type']; ?></td>
			<td><?php echo $report['Report']['created']; ?></td>
			<td>
				<?php echo $this->Html->link(__('edit'), sprintf('/admin/reports/view/%s', $report['Report']['id']), array(
					'class' => 'btn btn-small btn-inverse'
				)); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?= $this->Paginator->pagination(); ?>