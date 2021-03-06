<?php
/**
 *@var $this View
 */
?>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Category.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Category.category_name', __('Name')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($categories as $category) { ?>
		<tr>
			<td><?php echo $category['Category']['id']; ?></td>
			<td><?php echo $category['Category']['category_name']; ?></td>
			<td>
				<?php echo $this->Html->link(__('edit'), sprintf('/admin/categories/edit/%s', $category['Category']['id']), array(
					'class' => 'btn btn-small btn-inverse'
				)); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php echo $this->Paginator->pagination(); ?>