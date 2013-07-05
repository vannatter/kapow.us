<?php
/**
 *@var $this View
 */
?>
<h3><?php echo __('User Info'); ?></h3>
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('email', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Save User')); ?>
<?php echo $this->Form->end(); ?>

<h3><?php echo __('Change Password'); ?></h3>
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('clear_password', array('class' => 'span6')); ?>
<?php echo $this->Form->input('confirm_password', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Change Password')); ?>
<?php echo $this->Form->end(); ?>