<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
<div id="item-scroll-list">
		<?php foreach($results as $item) { ?>
			<div class="row search_row scroll-list-item" style="color: #fff;">
				<div class="span1">
					<div class="search_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="/img/nocover.png" width="210" height="140" /><?php } else { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>
				</div>
				<div class="span11">
					<h3><?php echo $this->Html->link($item['Item']['item_name'], '/items/' . $this->Common->seoize($item['Item']['id'], $item['Item']['item_name'])); ?></h3>
					<p class="desc"><?php echo $item['Item']['description']; ?></p>
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
	<h3><?php echo __('No Items Found'); ?></h3>
<?php } ?>