<?php
/**
 * @var $this View
 */
?>
<?php
$query = '';
if(isset($this->request->query['pubid'])) {
	$query = sprintf('?pubid=%s', $this->request->query['pubid']);
}
if(isset($this->request->query['terms'])) {
	if(empty($query)) {
		$query = sprintf('?terms=%s', $this->request->query['terms']);
	} else {
		$query .= sprintf('&terms=%s', $this->request->query['terms']);
	}
}
?>
<div class="item-by-date-header filter_box">
	<div class="span4 text-center item-by-date">
		<?php echo $this->Html->link($datePrevious, sprintf('/items/date/%s%s', $datePrevious, $query)); ?>
	</div>
	<div class="span3 text-center item-by-date"><?php echo $dateCurrent; ?></div>
	<div class="span4 text-center item-by-date">
		<?php echo $this->Html->link($dateNext, sprintf('/items/date/%s%s', $dateNext, $query)); ?>
	</div>
</div>

<?php echo $this->Form->create('Item', array('class' => 'form-inline')); ?>
	<div class="store_search_bar">
		<div class="pagination-centered">
			<?php echo $this->Form->input('terms', array('class' => 'span3', 'placeholder' => __('Search...'), 'value' => @$this->request->query['terms'])); ?>
			<?php echo $this->Form->input('publisher_id', array('class' => 'span6', 'value' => @$this->request->query['pubid'])); ?>
			<?php echo $this->Form->button(__('Search'), array('class' => 'btn btn-hgh btn-custom', 'style' => 'width: 125px;')); ?>
		</div>
	</div>
<?php echo $this->Form->end(); ?>

<?php echo $this->element('items/scroll_list'); ?>