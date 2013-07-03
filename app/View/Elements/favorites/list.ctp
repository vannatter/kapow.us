<div class="creator_collabs element_sideblock">
	<h4><?php echo __('Favorited:'); ?></h4>
	<?php foreach($users as $user) { ?>
		<a href="/profile/<?php echo $user['User']['username']; ?>"><?php echo $this->Gravatar->image($user['User']['email'], array('s' => 30), array('alt' => $user['User']['username'], 'title' => $user['User']['username'], 'class' => 'usr_img')); ?></a>
	<?php } ?>
</div>