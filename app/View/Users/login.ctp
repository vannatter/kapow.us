<?php
/**
 *@var $this View
 */
?>
<div class="row" style="background-color: #ffffff;">
	<div class="span6">
		<div class="row">
			<h2><?php echo __('Login'); ?></h2>
			<?php echo $this->Form->create('User', array('class' => 'form-vertical')); ?>
			<?php echo $this->Form->input('email'); ?>
			<?php echo $this->Form->input('password'); ?>
			<?php echo $this->Form->submit(__('Login')); ?>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="row">
			<?php echo $this->Html->link(__('Click here to Register'), array('controller' => 'users', 'action' => 'register')); ?>
		</div>
	</div>
	<div class="span6">
		<h2><?php echo __('Social Login'); ?></h2>
		<?php echo $this->Facebook->login(array('custom' => true, 'img' => 'connectwithfacebook.gif', 'show-faces' => false, 'perms' => 'email')); ?>
	</div>
</div>