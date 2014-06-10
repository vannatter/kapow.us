<div class="favorite_tags">

	<?php foreach ($unique_creators as $k=>$v) { ?>
		<?php if ($v['is_fav']) { ?>
			<span class="tag_creator_<?php echo $k; ?> label fav_label"><i class="icon-heart icon-white icon_tiny"></i> <a href="/creators/<?php echo $this->Common->seoize($k, $v['name']); ?>"><?php echo $v['name']; ?></a></span>
		<?php } ?>
	<?php } ?>

	<?php if (isset($item['Series']['UserFavorite']['id'])) { ?>
		<span class="tag_series_<?php echo $item['Series']['id']; ?> label fav_label"><i class="icon-heart icon-white icon_tiny"></i> <a href="/series/<?php echo $this->Common->seoize($item['Series']['id'], $item['Series']['series_name']); ?>"><?php echo $item['Series']['series_name']; ?></a></span>
	<?php } ?>

	<?php if (isset($item['Publisher']['UserFavorite']['id'])) { ?>
		<span class="tag_publisher_<?php echo $item['Publisher']['id']; ?> label fav_label"><i class="icon-heart icon-white icon_tiny"></i> <a href="/publishers/<?php echo $this->Common->seoize($item['Item']['publisher_id'], $item['Publisher']['publisher_name']); ?>"><?php echo $item['Publisher']['publisher_name']; ?></a></span>
	<?php } ?>
						
</div>