<?php
/**
 *@var $this View
 */

if(isset($filter) && $filter) {
	$this->Paginator->options(array('url' => array('filter' => $filter)));
} else {
	$filter = 'all';
}
?>
<div class="pull-right">
	<?php echo $this->Form->create('Publisher', array('class' => 'form-inline')); ?>
	<?php echo $this->Form->input('filter', array('type' => 'select', 'options' => array('all' => 'ALL', 'weighted' => 'WEIGHTED'), 'value' => $filter)); ?>
	<?php echo $this->Form->submit(__('Filter')); ?>
	<?php echo $this->Form->end(); ?>
</div>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Publisher.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Publisher.publisher_name', __('Name')); ?></th>
		<th><?php echo $this->Paginator->sort('Publisher.status', __('Status')); ?></th>
		<th><?php echo $this->Paginator->sort('LockUser.email', __('Locked By')); ?></th>
		<th><?php echo $this->Paginator->sort('Publisher.weight', __('Weighted')); ?></th>
		<th><?php echo $this->Paginator->sort('Publisher.item_count', __('Items')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($publishers as $publisher) { ?>
		<tr>
			<td><?php echo $publisher['Publisher']['id']; ?></td>
			<td><?php echo $publisher['Publisher']['publisher_name']; ?></td>
			<td>
				<?php
				if($publisher['Publisher']['status'] == 1) {
					echo 'CLEAN';
				} else {
					$count = 0;
					$total = 3;
					if(!empty($publisher['Publisher']['publisher_bio'])) {
						$count++;
					}
					if(!empty($publisher['Publisher']['publisher_photo'])) {
						$count++;
					}
					if(!empty($publisher['Publisher']['publisher_website'])) {
						$count++;
					}

					echo sprintf('<span class="badge badge-important">%s of %s</span>', $count, $total);
				}
				?>
			</td>
			<td><?php echo @$publisher['LockUser']['username']; ?></td>
			<td><?php echo $publisher['Publisher']['weight']; ?></td>
			<td><?php echo $publisher['Publisher']['item_count']; ?></td>
			<td>
				<?php echo $this->Html->link(__('edit'), sprintf('/admin/publishers/edit/%s', $publisher['Publisher']['id']), array(
					'class' => 'btn btn-small btn-inverse'
				)); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?= $this->Paginator->pagination(); ?>