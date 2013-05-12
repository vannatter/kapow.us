<?php
/**
 * @var $this View
 */
?>
<?php if($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
<<<<<<< HEAD
			<a href="/my/edit_profile"><button class="btn btn-custom edit_profile"><i class="icon-edit icon-white"></i> <?php echo __('Edit Profile'); ?></button></a>
			<button class="btn btn-custom public_profile"><i class="icon-user icon-white"></i> <?php echo __('Public Profile'); ?></button>
=======
		<?php echo $this->Html->link(sprintf('<i class="icon-edit icon-white"></i> %s', __('Edit Profile')), '/my/profile/edit', array('class' => 'btn btn-custom edit_profile', 'escape' => false)); ?>
		<?php echo $this->Html->link(sprintf('<i class="icon-user icon-white"></i> %s', __('Public Profile')), '/my/profile/public', array('class' => 'btn btn-custom public_profile', 'escape' => false, 'target' => '_blank')); ?>
>>>>>>> 429d1a7915e84b9c6ff0223fb2dabef9bb37be9e
	</div>
<?php } ?>