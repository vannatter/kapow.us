<?php
/**
 *@var $this View
 */
?>
<div class="row">
	<div class="pull-right span6">
		<?php echo $this->Form->create('Series', array('class' => 'form-inline')); ?>
		<?php echo $this->Form->input('series_name', array('class' => 'span10', 'value' => @$this->request->query['name'])); ?>
		<?php echo $this->Form->submit(__('Filter')); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Series.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Series.series_name', __('Name')); ?></th>
		<th><?php echo $this->Paginator->sort('Series.total_items', __('Items')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($series as $ser) { ?>
		<tr>
			<td><?php echo $ser['Series']['id']; ?></td>
			<td><?php echo $ser['Series']['series_name']; ?></td>
			<td><?php echo $ser['Series']['total_items']; ?></td>
			<td>
				<?php echo $this->Html->link(__('edit'), sprintf('/admin/series/edit/%s', $ser['Series']['id']), array(
					'class' => 'btn btn-small btn-inverse'
				)); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?= $this->Paginator->pagination(); ?>