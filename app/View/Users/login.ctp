<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('email'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->submit(__('Login')); ?>
<?php echo $this->Form->end(); ?>
<br />
<br />
asdf
<div style="clear: both; background-color: #ffffff;">
	<?php echo $this->Facebook->login(array('custom' => true, 'img' => 'connectwithfacebook.gif', 'show-faces' => false, 'perms' => 'email')); ?>
	<br />
	<br />
	<?php debug($this->Session->read('Auth')); ?>
	<br />
	<br />
	<?php echo $this->Facebook->logout(); ?>
</div>