<?php if($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
			<button class="btn btn-custom edit_profile"><i class="icon-edit icon-white"></i> <?php echo __('Edit Profile'); ?></button>
			<button class="btn btn-custom public_profile"><i class="icon-user icon-white"></i> <?php echo __('Public Profile'); ?></button>
	</div>
<?php } ?>