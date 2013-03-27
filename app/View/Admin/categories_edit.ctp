<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Category', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('category_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('created', array('type' => 'text', 'disabled' => true, 'class' => 'span3')); ?>
<?php echo $this->Form->input('modified', array('type' => 'text', 'disabled' => true, 'class' => 'span3')); ?>
<?php echo $this->Form->submit(__('Save Categroy')); ?>
<?php echo $this->Form->end(); ?>