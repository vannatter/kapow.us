<?php echo $this->Element('headers/items/detail'); ?>

<div class="row">
	<div class="span6 item_detail_img">	
		<?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="/theme/Kapow/img/nocover_large.png" class="detail_img" /><?php } else { ?><img alt="<?php echo $item['Item']['item_name']; ?>" class="detail_img" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath'], "50p"); ?>" /><?php } ?>
	</div>
	
	<div class="span6 item_detail">
		<?php echo $this->Element('items/actions'); ?>
		<?php echo $this->Element('items/favorite_tags'); ?>
		<h2><?php echo $item['Item']['item_name']; ?></h2>
		<?php echo $this->Common->creators($item['ItemCreator']); ?>		
		<?php echo $this->Element('items/description'); ?>

		<div class="row item_grid">
			<?php echo $this->Element('items/series'); ?>
			<?php echo $this->Element('items/printing'); ?>
			<?php echo $this->Element('items/srp'); ?>
			<?php echo $this->Element('items/publisher'); ?>
			<?php echo $this->Element('items/publish_date'); ?>
			<?php echo $this->Element('items/section'); ?>
			<?php echo $this->Element('items/stock'); ?>
		</div>
		<?php echo $this->Element('items/tags'); ?>
		<?php if (isset($item['UserFavorite']) && count($item['UserFavorite']) > 0) { ?>
			<div class="creator_collabs element_sideblock">
				<h4><?php echo __('Users'); ?></h4>
				<ul class="unstyled">
					<?php foreach($item['UserFavorite'] as $user) { ?>
						<li><?php echo $user['User']['username']; ?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</div>