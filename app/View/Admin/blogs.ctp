<?php
/**
 *@var $this View
 */
?>
<div class="well">
	<?php echo $this->Html->link(__('Add Blog Entry'), '/admin/blogs/add', array('class' => 'btn')); ?>
</div>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Blog.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Blog.title', __('Title')); ?></th>
		<th><?php echo $this->Paginator->sort('User.email', __('Author')); ?></th>
		<th><?php echo $this->Paginator->sort('Blog.created', __('Created')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($blogs as $blog) { ?>
		<tr>
			<td><?php echo $blog['Blog']['id']; ?></td>
			<td><?php echo $blog['Blog']['title']; ?></td>
			<td><?php echo $blog['User']['email']; ?></td>
			<td><?php echo $blog['Blog']['created']; ?></td>
			<td>
				<?php echo $this->Html->link(__('edit'), sprintf('/admin/blogs/edit/%s', $blog['Blog']['id']), array(
					'class' => 'btn btn-small btn-inverse'
				)); ?>
				<?php echo $this->Html->link(__('view'), sprintf('/blogs/%s', $blog['Blog']['id']), array(
					'class' => 'btn btn-small',
					'target' => '_blank'
				)); ?>
				<?php echo $this->Html->link(__('delete'), sprintf('/admin/blogs/delete/%s', $blog['Blog']['id']), array(
					'class' => 'btn btn-small btn-danger',
				), __('Are You Sure?')); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php echo $this->Paginator->pagination(); ?>