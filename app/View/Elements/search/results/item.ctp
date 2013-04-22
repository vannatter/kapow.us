<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
	<div id="item-scroll-list" class="row" style="color: #fff;">
		<?php foreach($results as $item) { ?>
			<div class="span10 scroll-list-item">
				<h3><?php echo $this->Html->link($item['Item']['item_name'], '/items/' . $this->Common->seoize($item['Item']['id'], $item['Item']['item_name'])); ?></h3>
				<p><?php echo $item['Item']['description']; ?></p>
			</div>
		<?php } ?>
	</div>
	<?php if($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination">
				<?php echo $this->Paginator->next('next'); ?>
			</div>
		</div>
	<?php } ?>
<?php } else { ?>
	<h3><?php echo __('No Items Found'); ?></h3>
<?php } ?>