<div class="my_block">
	<h5>
		<?php echo __('My Library'); ?>
		<?php if (count($library) > 0) { ?>
			<a href="/my/library"><span class="btn btn-custom edit_profile btn-small"><?php echo __('View All'); ?> <i class="icon-arrow-right icon-white"></i></span></a>
		<?php } ?>
	</h5>

	<?php if (count($library) > 0) { ?>
		<?php foreach ($library as $lib) { ?>

			<div class="span2 my_block">
				<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($lib['Item']['id'], $lib['Item']['item_name']); ?>"><?php if ($lib['Item']['img_fullpath'] == "/img/covers") { ?><img alt="<?php echo $lib['Item']['item_name']; ?>" src="/theme/Kapow/img/nocover.png" width="210" height="140" /><?php } else { ?><img alt="<?php echo $lib['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($lib['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

				<h4><a href="/items/<?php echo $this->Common->seoize($lib['Item']['id'], $lib['Item']['item_name']); ?>"><?php echo $lib['Item']['item_name']; ?></a></h4>
				<div class="item_desc">
					<?php echo $this->Common->printing($lib['Item']['printing']); ?>
					<p><?php echo $lib['Item']['description']; ?></p>
				</div>
			</div>

		<?php } ?>
	<?php } else { ?>
		<?php echo __('No items found in library'); ?>
	<?php } ?>
</div>