<?php echo $this->Element('headers/creators/view'); ?>

<div class="row">
	<div class="span3 item_detail_img">	
		<?php if ( ($creator['Creator']['creator_photo'] == "/img/covers") || (!$creator['Creator']['creator_photo']) ) { ?><img border="0" alt="<?php echo $creator['Creator']['creator_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $creator['Creator']['publisher_name']; ?>" class="detail_img" src="<?php echo $publisher['Publisher']['creator_photo']; ?>" /><?php } ?>

		<div class="creator_desc">
			<?php echo $creator['Creator']['creator_bio']; ?>		
		</div>
	</div>
	
	<div class="span9 item_detail">
		<?php echo $this->Element('creators/actions'); ?>

		<pre>
		<?php print_r($creator); ?>
		</pre>
				
	</div>
</div>