<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
<div id="item-scroll-list">
		<?php foreach($results as $creator) { ?>
			<div class="row search_row scroll-list-item" style="color: #fff;">
				<div class="span1">
					<div class="search_img"><a href="/creators/<?php echo $this->Common->seoize($creator['Creator']['id'], $creator['Creator']['creator_name']); ?>"><?php if ( ($creator['Creator']['creator_photo'] == "/img/covers") || (!$creator['Creator']['creator_photo']) ) { ?><img border="0" alt="<?php echo $creator['Creator']['creator_name']; ?>" src="/img/noprofile.png" /><?php } else { ?><img border="0" alt="<?php echo $creator['Creator']['creator_name']; ?>" src="<?php echo $creator['Creator']['creator_photo']; ?>" /><?php } ?></a></div>
				</div>
				<div class="span11">
					<h3><?php echo $this->Html->link($creator['Creator']['creator_name'], '/creators/' . $this->Common->seoize($creator['Creator']['id'], $creator['Creator']['creator_name'])); ?></h3>
					<p><?php echo $creator['Creator']['creator_bio']; ?></p>
				</div>
			</div>
		<?php } ?>
	<?php if($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination">
				<?php echo $this->Paginator->next('next'); ?>
			</div>
		</div>
	<?php } ?>
</div>
<?php } else { ?>
	<h3><?php echo __('No Creators Found'); ?></h3>
<?php } ?>