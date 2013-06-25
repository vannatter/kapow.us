<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->submit(__('Save Username')); ?>
<?php echo $this->Form->end(); ?>
