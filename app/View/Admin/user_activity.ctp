<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Last'); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($users as $user) { ?>
		<tr>
			<td><?php echo $user['User']['username']; ?></td>
			<td><?php echo $user['UserActivity']['created']; ?></td>
			<td>
				<?php echo $this->Html->link(__('details'), sprintf('/admin/userActivity/details/%s', $user['User']['id']),
					array('class' => 'btn btn-small btn-success')); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>