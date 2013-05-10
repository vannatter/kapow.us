<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Element('headers/users/profile'); ?>

<div class="row">
	<div class="span3 item_detail_img">
		<?php echo $this->Gravatar->image($this->request->data['User']['email'], array('s' => 300), array('class' => 'detail_img')); ?>
	</div>

	<div class="span9 item_detail">
		<h2><?php echo __('Details'); ?></h2>
		<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<?php echo $this->Form->input('email', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('user_fullname', array('label' => __('Full Name'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('user_bio', array('label' => __('Bio'), 'class' => 'span6', 'rows' => 6)); ?>
		<?php echo $this->Form->input('user_website', array('label' => __('Website'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('user_facebook', array('label' => __('Facebook'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('user_twitter', array('label' => __('Twitter'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('private_profile'); ?>
		<?php echo $this->Form->submit(__('Save Profile')); ?>
		<?php echo $this->Form->end(); ?>

		<?php if(empty($this->request->data['User']['facebook'])) { ?>
		<h2><?php echo __('Change Password'); ?></h2>
		<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<?php echo $this->Form->input('clear_password', array('type' => 'password', 'label' => __('Password'), 'class' => 'span4')); ?>
		<?php echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __('Confirm'), 'class' => 'span4')); ?>
		<?php echo $this->Form->submit(__('Change Password')); ?>
		<?php echo $this->Form->end(); ?>
		<?php } ?>
	</div>
</div>