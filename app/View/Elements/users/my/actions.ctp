<?php
/**
 * @var $this View
 */
?>
<?php if($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
		<?php echo $this->Html->link(sprintf('<i class="icon-edit icon-white"></i> %s', __('Edit Profile')), '/my/profile/edit', array('class' => 'btn btn-custom edit_profile', 'escape' => false)); ?>
		<?php echo $this->Html->link(sprintf('<i class="icon-user icon-white"></i> %s', __('Public Profile')), '/my/profile/public', array('class' => 'btn btn-custom public_profile', 'escape' => false, 'target' => '_blank')); ?>
	</div>
<?php } ?>