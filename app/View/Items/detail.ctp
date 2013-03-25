<?php echo $this->Element('filters/detail'); ?>

<div class="row">
	<div class="span6 item_detail_img">	
		<?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="/img/nocover.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" class="detail_img" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath'], "50p"); ?>" /><?php } ?>
	</div>
	
	<div class="span6 item_detail">
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
		
	</div>

</div>