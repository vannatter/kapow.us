<?php
/**
 * @var $this View
 */
?>
<?php if (isset($results) && count($results) > 0) { ?>
<div id="item-scroll-list">
		<?php foreach($results as $series) { ?>
			<div class="row search_row scroll-list-item" style="color: #fff;">
				<div class="span1">
					<div class="search_img"><a href="/series/<?php echo $this->Common->seoize($series['Series']['id'], $series['Series']['series_name']); ?>"><?php if (($series['Item'][0]['img_fullpath'] == "/img/covers") || (!$series['Item'][0]['img_fullpath'])) { ?><img alt="<?php echo $series['Series']['series_name']; ?>" src="/theme/Kapow/img/nocover.png" width="210" height="140" /><?php } else { ?><img alt="<?php echo $series['Series']['series_name']; ?>" src="<?php echo $this->Common->thumb($series['Item'][0]['img_fullpath']); ?>" /><?php } ?></a></div>
				</div>
				<div class="span11">
					<h3><?php echo $this->Html->link($series['Series']['series_name'], '/series/' . $this->Common->seoize($series['Series']['id'], $series['Series']['series_name'])); ?></h3>
					<p class="desc">Total items in this series: <?php echo $series['Series']['total_items']; ?><br/>
					<?php echo ($series['Series']['description']) ? $series['Series']['description'] : $series['Item'][0]['description']; ?></p>
				</div>
			</div>
		<?php } ?>
	<?php if ($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
		</div>
	<?php } ?>
</div>
<?php } else { ?>
	<h3><?php echo __('No Series Found'); ?></h3>
<?php } ?>