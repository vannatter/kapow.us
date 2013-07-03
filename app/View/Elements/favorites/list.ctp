<div class="creator_collabs element_sideblock">
	<h4><?php echo __('Users'); ?></h4>
	<ul class="unstyled">
		<?php foreach($users as $user) { ?>
			<li><?php echo $user['User']['username']; ?></li>
		<?php } ?>
	</ul>
</div>