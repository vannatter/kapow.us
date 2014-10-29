<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
<div id="item-scroll-list">
		<?php foreach($results as $publisher) { ?>
			<div class="row search_row scroll-list-item" style="color: #fff;">
				<div class="span1">
					<div class="search_img"><a href="/publishers/<?php echo $this->Common->seoize($publisher['Publisher']['id'], $publisher['Publisher']['publisher_name']); ?>"><?php if ( ($publisher['Publisher']['publisher_photo'] == "/img/covers") || (!$publisher['Publisher']['publisher_photo']) ) { ?><img alt="<?php echo $publisher['Publisher']['publisher_name']; ?>" src="/theme/Kapow/img/noprofile.png" /><?php } else { ?><img alt="<?php echo $publisher['Publisher']['publisher_name']; ?>" src="<?php echo $publisher['Publisher']['publisher_photo']; ?>" /><?php } ?></a></div>
				</div>
				<div class="span11 scroll-list-item">
					<h3><?php echo $this->Html->link($publisher['Publisher']['publisher_name'], '/publishers/' . $this->Common->seoize($publisher['Publisher']['id'], $publisher['Publisher']['publisher_name'])); ?></h3>
					<p><?php echo $publisher['Publisher']['publisher_bio']; ?></p>
				</div>
			</div>
		<?php } ?>
	<?php if($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
		</div>
	<?php } ?>
</div>
<?php } else { ?>
	<h3><?php echo __('No Publishers Found'); ?></h3>
<?php } ?>