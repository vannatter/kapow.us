<?php
/**
 * @var $this View
 */
?>
<?php if ($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
		<a href="/my/profile/edit"><span class="btn btn-custom edit_profile"><i class="icon-edit icon-white"></i> <?php echo __('Edit Profile'); ?></span></a>
		<a href="/profile/<?php echo $username; ?>"><span class="btn btn-custom public_profile"><i class="icon-user icon-white"></i> <?php echo __('Public Profile'); ?></span></a>
	</div>
<?php } ?>