<?php $this->Html->script('page/shops.js', array('inline' => false)); ?>
<div>
	<h2><?php echo __('Search'); ?></h2>
	<?php echo $this->Form->input('location', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'span6')); ?>
	<?php echo $this->Form->button(__('Search'), array('id' => 'btnSearch')); ?>
</div>
<div id="map-canvas" style="clear: both; width: 100%; height: 500px;"></div>
<div id="storeList" style="background-color: #fff;"></div>