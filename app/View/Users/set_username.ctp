<?php
/**
 *@var $this View
 */
?>
<div class="span12">
	<h3><?php echo __('Please enter a username'); ?></h3>
</div>
<div class="span12">
	<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
	<?php echo $this->Form->input('username'); ?>
	<?php echo $this->Form->submit(__('Save Username')); ?>
	<?php echo $this->Form->end(); ?>
</div>