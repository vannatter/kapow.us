<?php echo $this->Element('headers/users/profile'); ?>

<div class="row">
	<div class="span3 item_detail_img">	
		<?php echo $this->Gravatar->image($user['User']['email'], array('s' => 300), array('class' => 'detail_img')); ?>
	
		<div class="creator_desc">
			<?php echo $user['User']['user_bio']; ?>		
		</div>
		
		<?php if ($user['User']['user_website']) { ?>
		<div class="element_sideblock">
			<h4><?php echo __('Website'); ?>:</h4>
			<a href="<?php echo $user['User']['user_website']; ?>" target="_blank"><?php echo $user['User']['user_website']; ?></a>
		</div>
		<?php } ?>
		
		<?php if ($user['User']['user_facebook']) { ?>
		<div class="element_sideblock">
			<h4><?php echo __('Facebook'); ?>:</h4>
			<a href="<?php echo $user['User']['user_facebook']; ?>" target="_blank"><?php echo $user['User']['user_facebook']; ?></a>
		</div>
		<?php } ?>
				
		<?php if ($user['User']['user_twitter']) { ?>
		<div class="element_sideblock">
			<h4><?php echo __('Twitter'); ?>:</h4>
			<a href="<?php echo $user['User']['user_twitter']; ?>" target="_blank"><?php echo $user['User']['user_twitter']; ?></a>
		</div>
		<?php } ?>
	</div>
	
	<div class="span9 item_detail">
		<?php if(!isset($public) || !$public) { ?>
		<?php echo $this->Element('users/my/actions'); ?>
		<?php } ?>
		<?php echo $this->Element('users/my/pull_list'); ?>
		<?php echo $this->Element('users/my/library'); ?>
		<?php echo $this->Element('users/my/favorite_items'); ?>
		<?php echo $this->Element('users/my/favorite_series'); ?>
		<?php echo $this->Element('users/my/favorite_creators'); ?>
		<?php echo $this->Element('users/my/favorite_publishers'); ?>
		<?php echo $this->Element('users/my/favorite_shops'); ?>
	</div>
</div>