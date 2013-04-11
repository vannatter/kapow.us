<?php echo $this->Element('headers/creators/view'); ?>

<div class="row">
	<div class="span3 item_detail_img">	
		<?php if ( ($creator['Creator']['creator_photo'] == "/img/covers") || (!$creator['Creator']['creator_photo']) ) { ?><img border="0" alt="<?php echo $creator['Creator']['creator_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $creator['Creator']['creator_name']; ?>" class="detail_img" src="<?php echo $creator['Creator']['creator_photo']; ?>" /><?php } ?>

		<div class="creator_desc">
			<?php echo $creator['Creator']['creator_bio']; ?>		
		</div>
		
		<?php if ($creator['Creator']['creator_website']) { ?>
		<div class="element_sideblock">
			<h4>Website:</h4>
			<a href="<?php echo $creator['Creator']['creator_website']; ?>" target="_blank"><?php echo $creator['Creator']['creator_website']; ?></a>
		</div>
		<?php } ?>
		
		<?php if ($creator['Creator']['creator_facebook']) { ?>
		<div class="element_sideblock">
			<h4>Facebook:</h4>
			<a href="<?php echo $creator['Creator']['creator_facebook']; ?>" target="_blank"><?php echo $creator['Creator']['creator_facebook']; ?></a>
		</div>
		<?php } ?>
				
		<?php if ($creator['Creator']['creator_twitter']) { ?>
		<div class="element_sideblock">
			<h4>Twitter:</h4>
			<a href="<?php echo $creator['Creator']['creator_twitter']; ?>" target="_blank"><?php echo $creator['Creator']['creator_twitter']; ?></a>
		</div>
		<?php } ?>
				
	</div>
	
	<div class="span9 item_detail">
		<?php echo $this->Element('creators/actions'); ?>

		<pre>
		<?php print_r($creator); ?>
		</pre>
				
	</div>
</div>