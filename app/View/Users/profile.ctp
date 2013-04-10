<div class="well">
	<div class="row">
		<div class="span1"><?php echo __('Email'); ?></div>
		<div class="span4"><?php echo $user['email']; ?></div>
	</div>
	<div class="row">
		<div class="span1"><?php echo __('Account Type'); ?></div>
		<div class="span4"><?php echo ($user['access_level']==99) ? "ADMIN" : "NORMAL"; ?></div>
	</div>
</div>