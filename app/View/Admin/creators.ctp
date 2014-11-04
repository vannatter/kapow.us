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
			<th><?php echo $this->Paginator->sort('Creator.status', __('Status')); ?></th>
			<th><?php echo $this->Paginator->sort('LockUser.email', __('Locked By')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($creators as $creator) { ?>
			<tr>
				<td><?php echo $creator['Creator']['id']; ?></td>
				<td><?php echo $creator['Creator']['creator_name']; ?></td>
				<td>
					<?php
					if ($creator['Creator']['status'] == 1) {
						echo 'CLEAN';
					} else {
						$count = 0;
						$total = 5;
						if (!empty($creator['Creator']['creator_bio'])) {
							$count++;
						}
						if (!empty($creator['Creator']['creator_photo'])) {
							$count++;
						}
						if (!empty($creator['Creator']['creator_website'])) {
							$count++;
						}
						if (!empty($creator['Creator']['creator_twitter'])) {
							$count++;
						}
						if (!empty($creator['Creator']['creator_facebook'])) {
							$count++;
						}

						echo sprintf('<span class="badge badge-important">%s of %s</span>', $count, $total);
					}
					?>
				</td>
				<td><?php echo @$creator['LockUser']['email']; ?></td>
				<td>
					<?php echo $this->Html->link(__('edit'), sprintf('/admin/creators/edit/%s', $creator['Creator']['id']), array(
						'class' => 'btn btn-small btn-inverse'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>