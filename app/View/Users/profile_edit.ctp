<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Element('headers/users/profile_edit'); ?>

<div class="row">
	<div class="span3 item_detail_img">
		<?php echo $this->Gravatar->image($this->request->data['User']['email'], array('s' => 300), array('class' => 'detail_img')); ?>

		<?php if ($this->request->data['User']['user_fullname']) { ?>
		<div class="creator_name">
			<?php echo $this->request->data['User']['user_fullname']; ?>		
		</div>
		<?php } ?>
	
		<?php if ($this->request->data['User']['user_bio']) { ?>
		<div class="creator_desc">
			<?php echo $this->request->data['User']['user_bio']; ?>		
		</div>
		<?php } ?>
		
		<?php if ($this->request->data['User']['user_website']) { ?>
		<div class="element_sideblock">
			<h4><?php echo __('Website'); ?>:</h4>
			<a href="<?php echo $this->request->data['User']['user_website']; ?>" target="_blank"><?php echo $this->request->data['User']['user_website']; ?></a>
		</div>
		<?php } ?>
		
		<?php if ($this->request->data['User']['user_facebook']) { ?>
		<div class="element_sideblock">
			<h4><?php echo __('Facebook'); ?>:</h4>
			<a href="<?php echo $this->request->data['User']['user_facebook']; ?>" target="_blank"><?php echo $this->request->data['User']['user_facebook']; ?></a>
		</div>
		<?php } ?>
				
		<?php if ($this->request->data['User']['user_twitter']) { ?>
		<div class="element_sideblock">
			<h4><?php echo __('Twitter'); ?>:</h4>
			<a href="<?php echo $this->request->data['User']['user_twitter']; ?>" target="_blank"><?php echo $this->request->data['User']['user_twitter']; ?></a>
		</div>
		<?php } ?>
	</div>

	<div class="span9 item_detail profile_edit_block">
		<h3><?php echo __('My Profile Details'); ?></h3>
		<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<?php echo $this->Form->input('email', array('class' => 'span6')); ?>
		<?php echo $this->Form->input('user_fullname', array('label' => __('Full Name'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('user_bio', array('label' => __('Bio'), 'class' => 'span6', 'rows' => 6)); ?>
		<?php echo $this->Form->input('user_website', array('label' => __('Website'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('user_facebook', array('label' => __('Facebook'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('user_twitter', array('label' => __('Twitter'), 'class' => 'span6')); ?>
		<?php echo $this->Form->input('private_profile'); ?>
		<?php echo $this->Form->submit(__('Save Profile'), array('class'=>'btn btn-custom')); ?>
		<?php echo $this->Form->end(); ?>

		<?php if (empty($this->request->data['User']['facebook'])) { ?>
		<h3><?php echo __('Change Password'); ?></h3>
		<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<?php echo $this->Form->input('clear_password', array('type' => 'password', 'label' => __('Password'), 'class' => 'span4')); ?>
		<?php echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __('Confirm'), 'class' => 'span4')); ?>
		<?php echo $this->Form->submit(__('Change Password'), array('class'=>'btn btn-custom')); ?>
		<?php echo $this->Form->end(); ?>
		<?php } ?>
	</div>
</div>