<div class="favorite_tags">

	<?php foreach ($unique_creators as $k=>$v) { ?>
		<?php if ($v['is_fav']) { ?>
		<span class="label fav_label"><i class="icon-heart icon-white icon_tiny"></i> <?php echo $v['name']; ?></a></span>
		<?php } ?>
	<?php } ?>

	<?php if (isset($item['Series']['UserFavorite']['id'])) { ?>
		<span class="label fav_label"><i class="icon-heart icon-white icon_tiny"></i> <?php echo $item['Series']['series_name']; ?></a></span>
	<?php } ?>

	<?php if (isset($item['Publisher']['UserFavorite']['id'])) { ?>
		<span class="label fav_label"><i class="icon-heart icon-white icon_tiny"></i> <?php echo $item['Publisher']['publisher_name']; ?></a></span>
	<?php } ?>
						
</div>