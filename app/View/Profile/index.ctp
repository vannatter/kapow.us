<?php echo $this->Element('headers/profile/index'); ?>

<?php if ($user['User']['private_profile'] == 1) { ?>

	<div class="row">

		<div class="span12">
			<div class="well private_profile">
				This profile is flagged as private.
			</div>
		</div>

	</div>
	
<?php } else { ?>
	
	<div class="row">
		<div class="span3 item_detail_img">	
			<?php echo $this->Gravatar->image($user['User']['email'], array('s' => 300), array('class' => 'detail_img')); ?>
	
			<?php if ($user['User']['user_fullname']) { ?>
			<div class="creator_name">
				<?php echo $user['User']['user_fullname']; ?>		
			</div>
			<?php } ?>
		
			<?php if ($user['User']['user_bio']) { ?>
			<div class="creator_desc">
				<?php echo $user['User']['user_bio']; ?>		
			</div>
			<?php } ?>
			
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
			<?php echo $this->Element('profile/actions'); ?>
			<?php echo $this->Element('profile/pull_list'); ?>
			<?php echo $this->Element('profile/library'); ?>
			<?php echo $this->Element('profile/favorite_series'); ?>
			<?php echo $this->Element('profile/favorite_creators'); ?>
			<?php echo $this->Element('profile/favorite_publishers'); ?>
			<?php echo $this->Element('profile/favorite_shops'); ?>
		</div>
	</div>

<?php } ?>