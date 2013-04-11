<?php echo $this->Element('headers/publishers/view'); ?>

<div class="row">
	<div class="span3 item_detail_img">	
		<?php if ( ($publisher['Publisher']['publisher_photo'] == "/img/covers") || (!$publisher['Publisher']['publisher_photo']) ) { ?><img border="0" alt="<?php echo $publisher['Publisher']['publisher_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $publisher['Publisher']['publisher_name']; ?>" class="detail_img" src="<?php echo $publisher['Publisher']['publisher_photo']; ?>" /><?php } ?>

		<div class="publisher_desc">
			<?php echo $publisher['Publisher']['publisher_bio']; ?>		
		</div>
		
		<?php if ($publisher['Publisher']['publisher_website']) { ?>
		<div class="element_sideblock">
			<h4>Website:</h4>
			<a href="<?php echo $publisher['Publisher']['publisher_website']; ?>" target="_blank"><?php echo $publisher['Publisher']['publisher_website']; ?></a>
		</div>
		<?php } ?>
	</div>
	
	<div class="span9 item_detail">
		<?php echo $this->Element('publishers/actions'); ?>
		<?php echo $this->Element('publishers/items'); ?>
	</div>
</div>