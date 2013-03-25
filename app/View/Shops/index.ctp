<?php $this->Html->script('page/shops.js', array('inline' => false)); ?>
<div class="row">
	<h2><?php echo __('Search'); ?></h2>
	<?php echo $this->Form->input('location', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'span6')); ?>
	<?php echo $this->Form->button(__('Search'), array('id' => 'btnSearch')); ?>
</div>
<div class="row" style="background-color: #fff;">
	<div class="span5" id="map-canvas" style="height: 400px;"></div>
	<div class="span6" id="storeList"></div>
</div>