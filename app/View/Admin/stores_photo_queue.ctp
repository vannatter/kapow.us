<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('StorePhoto.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('StorePhoto.photo_path', __('Path')); ?></th>
			<th><?php echo $this->Paginator->sort('StorePhoto.photo_description', __('Description')); ?></th>
			<th><?php echo $this->Paginator->sort('User.email', __('User Email')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($photos as $photo) { ?>
			<tr>
				<td><?php echo $photo['StorePhoto']['id']; ?></td>
				<td>
					<?php echo $this->Html->link(__('view'), $photo['StorePhoto']['photo_path'], array(
						'class' => 'btn btn-small btn-inverse', 'target' => '_blank'
					)); ?>
				</td>
				<td><?php echo $photo['StorePhoto']['photo_description']; ?></td>
				<td><?php echo $photo['User']['email']; ?></td>
				<td>
					<?php echo $this->Html->link(__('allow'), sprintf('/admin/stores/photo/allow/%s', $photo['StorePhoto']['id']), array('class' => 'btn btn-small btn-success'), __('Are you sure you want to allow?')); ?>
					<?php echo $this->Html->link(__('delete'), sprintf('/admin/stores/photo/delete/%s', $photo['StorePhoto']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure?')); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?= $this->Paginator->pagination(); ?>