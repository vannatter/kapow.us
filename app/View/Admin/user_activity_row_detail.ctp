<div>
	<h4><?php echo __('IP Address'); ?></h4>
	<p><?php echo $details['UserActivity']['ip_address']; ?></p>
</div>

<div>
	<h4><?php echo __('Browser'); ?></h4>
	<p><?php echo $details['UserActivity']['browser']; ?></p>
</div>

<div>
	<h4><?php echo __('Controller'); ?></h4>
	<p><?php echo $details['UserActivity']['controller']; ?></p>
</div>

<div>
	<h4><?php echo __('Action'); ?></h4>
	<p><?php echo $details['UserActivity']['action']; ?></p>
</div>

<div>
	<h4><?php echo __('Request'); ?></h4>
	<p><pre><?php print_r(unserialize($details['UserActivity']['request'])); ?></pre></p>
</div>