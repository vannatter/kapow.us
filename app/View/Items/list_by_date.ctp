<?php
/**
 * @var $this View
 */
?>
<div class="item-by-date-header filter_box">
	<div class="span4 text-center item-by-date">
		<?php echo $this->Html->link($datePrevious, array(
			'controller' => 'items',
			'action' => 'listByDate',
			$datePrevious
		)); ?>
	</div>
	<div class="span3 text-center item-by-date"><?php echo $dateCurrent; ?></div>
	<div class="span4 text-center item-by-date">
		<?php echo $this->Html->link($dateNext, array(
			'controller' => 'items',
			'action' => 'listByDate',
			$dateNext
		)); ?>
	</div>
</div>

<?php echo $this->element('items/scroll_list'); ?>