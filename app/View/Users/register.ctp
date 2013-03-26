<div class="row" style="background-color: #ffffff;">
	<h2><?php echo __('Register'); ?></h2>
	<?php echo $this->Form->create('User', array('class' => 'form-vertical')); ?>
	<?php echo $this->Form->input('email'); ?>
	<?php echo $this->Form->input('clear_password'); ?>
	<?php echo $this->Form->input('confirm_password'); ?>
	<?php echo $this->Form->submit(__('Register')); ?>
	<?php echo $this->Form->end(); ?>
</div>