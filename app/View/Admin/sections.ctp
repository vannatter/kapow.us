<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Section.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Category.category_name', __('Category')); ?></th>
			<th><?php echo $this->Paginator->sort('Section.section_name', __('Name')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($sections as $section) { ?>
			<tr>
				<td><?php echo $section['Section']['id']; ?></td>
				<td><?php echo $section['Category']['category_name']; ?></td>
				<td><?php echo $section['Section']['section_name']; ?></td>
				<td>
					<?php echo $this->Html->link(__('edit'), sprintf('/admin/sections/edit/%s', $section['Section']['id']), array(
						'class' => 'btn btn-small btn-inverse'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>