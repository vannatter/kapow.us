<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('CreatorType', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('creator_short_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('creator_type_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('created', array('type' => 'text', 'disabled' => true, 'class' => 'span3')); ?>
<?php echo $this->Form->input('modified', array('type' => 'text', 'disabled' => true, 'class' => 'span3')); ?>
<?php echo $this->Form->submit(__('Save Creator Type')); ?>
<?php echo $this->Form->end(); ?>