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
			<th><?php echo $this->Paginator->sort('Publisher.status', __('Status')); ?></th>
			<th><?php echo $this->Paginator->sort('LockUser.email', __('Locked By')); ?></th>
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