<?php
/**
*@var $this View
*/
?>
<?php $this->Html->script('page/shops.js', array('inline' => false)); ?>
<div class="row">
	<h2><?php echo __('Search'); ?></h2>
	<?php echo $this->Form->create('Shop', array('class' => 'form-inline')); ?>
	<?php echo $this->Form->input('location', array('class' => 'span6', 'placeholder' => __('City, State, Zip'))); ?>
	<?php echo $this->Form->input('radius', array('class' => 'span2', 'options' => array(
		'10' => __('10 miles'),
		'25' => __('25 miles'),
		'50' => __('50 miles'),
		'100' => __('100 miles')
	), 'value' => '25')); ?>
	<?php echo $this->Form->button(__('Search'), array('class' => 'btn')); ?>
	<?php echo $this->Form->end(); ?>
</div>
<div class="row" style="background-color: #fff;">
	<div class="span5" id="map-canvas" style="height: 400px;"></div>
	<div class="span6" id="storeList"></div>
</div>