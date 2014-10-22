<?php if (@$ticker['Creator']['id']) { ?>

	<div class="row hot_block">
		<div class="span2 hot_img">
			<a href="/creators/<?php echo $this->Common->seoize($ticker['Creator']['id'], $ticker['Creator']['creator_name']); ?>"><?php if ( ($ticker['Creator']['creator_photo'] == "/img/covers") || (!$ticker['Creator']['creator_photo']) ) { ?><img border="0" alt="<?php echo $ticker['Creator']['creator_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $ticker['Creator']['creator_name']; ?>" class="detail_img" src="<?php echo $this->Common->creator_thumb($ticker['Creator']['creator_photo'], "50p"); ?>" /><?php } ?></a>
		</div>
	</div>

	<div class="row hot_block">
		<div class="span3 hot_link">
			<h4><?php echo $this->Html->link($ticker['Creator']['creator_name'], '/creators/' . $this->Common->seoize($ticker['Creator']['id'], $ticker['Creator']['creator_name'])); ?></h4>
		</div>
	</div>
	
	<div class="row hot_block">
		<div class="span3 hot_desc">
			<?php echo $ticker['Creator']['creator_bio']; ?>
		</div>
	</div>

<?php } else { ?>

	<div class="row hot_block">
		<div class="span2 hot_img">
			<a href="/items/<?php echo $this->Common->seoize($ticker['Item']['id'], $ticker['Item']['item_name']); ?>"><?php if ($ticker['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $ticker['Item']['item_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $ticker['Item']['item_name']; ?>" class="detail_img" src="<?php echo $this->Common->thumb($ticker['Item']['img_fullpath'], "50p"); ?>" /><?php } ?></a>
		</div>
	</div>

	<div class="row hot_block">
		<div class="span3 hot_link">
			<h4><?php echo $this->Html->link($ticker['Item']['item_name'], '/items/' . $this->Common->seoize($ticker['Item']['id'], $ticker['Item']['item_name'])); ?></h4>
		</div>
	</div>

	<div class="row hot_block">
		<div class="span3 hot_desc">
			<?php echo $ticker['Item']['description']; ?>
		</div>
	</div>

<?php } ?>