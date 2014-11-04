<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/search', array('inline' => false)); ?>
<?php echo $this->Element('headers/search/index'); ?>

<?php echo $this->Form->create('Search', array('class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('type', array('class' => 'span3', 'value' => @$type)); ?>
		<?php echo $this->Form->input('terms', array('class' => 'span6', 'value' => @$terms)); ?>
		<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-custom btn-hgh')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php
if (isset($type)) {
	switch($type) {
		case 1:   ## ITEM
			echo $this->element('search/results/item');
			break;
		case 2:   ## PUBLISHER
			echo $this->element('search/results/publisher');
			break;
		case 3:   ## CREATOR
			echo $this->element('search/results/creator');
			break;
		case 4:   ## SERIES
			echo $this->element('search/results/series');
			break;
	}
}
?>