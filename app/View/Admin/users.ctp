<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('User.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('User.email', __('Email')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($users as $user) { ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
				<td><?php echo $user['User']['email']; ?></td>
				<td>
					<?php echo $this->Html->link(__('edit'), sprintf('/admin/users/edit/%s', $user['User']['id']), array(
						'class' => 'btn btn-small btn-inverse'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>