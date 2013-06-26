<?php
/**
 * @var $this View
 */
?>
<h2><?php echo __('Make Changes!'); ?></h2>
<?php echo $this->Form->create('Item', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('section_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('series_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('stock_id', array('type' => 'text', 'class' => 'span6')); ?>
<?php echo $this->Form->input('printing', array('class' => 'span6')); ?>
<?php echo $this->Form->input('item_date', array('class' => 'span6')); ?>
<?php echo $this->Form->input('item_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('series_num', array('class' => 'span6')); ?>
<?php echo $this->Form->input('srp', array('class' => 'span6')); ?>
<?php echo $this->Form->input('description', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Submit Changes')); ?>
<h4><?php echo __('Changes will be submitted for admin approval'); ?></h4>
<?php echo $this->Form->end(); ?>