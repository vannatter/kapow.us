<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('email', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save User')); ?>
<?php echo $this->Form->end(); ?>