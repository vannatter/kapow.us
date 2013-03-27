<?php
/**
*@var $this View
*/
?>
<?php $this->Html->script('page/shops.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/shops/map'); ?>

<?php echo $this->Form->create('Shop', array('class' => 'form-inline')); ?>
<div class="store_search_bar">
<div class="pagination-centered">
	<?php echo $this->Form->input('location', array('class' => 'span6', 'placeholder' => __('City, State, Zip'))); ?>
	<?php echo $this->Form->input('radius', array('class' => 'span3', 'options' => array(
		'10' => __('10 miles'),
		'25' => __('25 miles'),
		'50' => __('50 miles'),
		'100' => __('100 miles')
	), 'value' => '25')); ?>
	<?php echo $this->Form->button(__('Search'), array('class' => 'btn store_search_btn')); ?>
</div>
</div>
<?php echo $this->Form->end(); ?>

<div class="row-fluid">
	<div class="span7" id="map-canvas" style="height: 400px;"></div>
	<div class="span5" id="storeList"></div>
</div>