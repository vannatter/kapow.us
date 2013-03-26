<div class="item_tags">
	<?php foreach ($item['ItemTag'] as $it) { ?>
		<span class="label"><a href="/tags/<?php echo $this->Common->seoize($it['Tag']['id'], $it['Tag']['tag_name']); ?>"><?php echo $it['Tag']['tag_name']; ?></a></span>
	<?php } ?>
</div>