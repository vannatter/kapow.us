<?php
/**
 *@var $this View
 */

if (isset($filter)) {
	$this->Paginator->options(array('url' => array('filter' => $filter)));
} else {
	$filter = 'all';
}
?>

<?php echo $this->element('admin/page_header', array('title' => __('Items'))); ?>

<div class="row">
	<div class="pull-right">
		<?php echo $this->Form->create('Item', array('class' => 'form-inline', 'inputDefaults' => array(
			'div' => 'form-group',
			'label' => false,
			'wrapInput' => false,
			'class' => 'form-control'
		))); ?>
		<?php echo $this->Form->input('filter', array('type' => 'select', 'options' => array('all' => 'ALL', 'hot' => 'HOT'), 'value' => $filter)); ?> 
		&nbsp;
		<?php echo $this->Form->submit(__('Filter'), array(
			'div' => 'form-group',
			'class' => 'btn btn-default'
		)); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Item.item_name', __('Name')); ?></th>
			<th><?php echo $this->Paginator->sort('Section.section_name', __('Section')); ?></th>
			<th><?php echo $this->Paginator->sort('Publisher.publisher_name', __('Publisher')); ?></th>
			<th><?php echo $this->Paginator->sort('Series.series_name', __('Series')); ?></th>
			<th><?php echo $this->Paginator->sort('Item.hot', __('Hotness')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($items as $item) { ?>
			<tr>
				<td><?php echo $this->Html->link($item['Item']['item_name'], sprintf('/admin/items/edit/%s', $item['Item']['id'])); ?></td>
				<td><?php echo $this->Html->link($item['Section']['section_name'], sprintf('/admin/sections/edit/%s', $item['Section']['id'])); ?></td>
				<td><?php echo $this->Html->link($item['Publisher']['publisher_name'], sprintf('/admin/publishers/edit/%s', $item['Publisher']['id'])); ?></td>
				<td><?php echo $this->Html->link($item['Series']['series_name'], sprintf('/admin/series/edit/%s', $item['Series']['id'])); ?></td>
				<td><?php echo $item['Item']['hot']; ?></td>
				<td>
					<?php echo $this->Html->link(__('edit'), sprintf('/admin/items/edit/%s', $item['Item']['id']), array(
						'class' => 'btn btn-sm btn-primary'
					)); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php echo $this->Paginator->pagination(array(
		'ul' => 'pagination'
	)); ?>
</div>