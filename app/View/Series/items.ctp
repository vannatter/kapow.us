<?php
/**
 *@var $this View
 */
?>
<div id="item-scroll-list">
	<?php $row = 0; ?>
	<?php foreach($items as $item) { ?>
		<?php if($row == 0) { ?>
			<div class="row thisweek scroll-list-item">
		<?php } ?>
		<?php $row++; ?>
		<div class="span2 preview_block">
			<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="/img/nocover.png" width="210" height="140" /><?php } else { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

			<button class="btn btn-mini btn-primary disabled pull_list_btn" type="button" data-id="<?php echo $item['Item']['id']; ?>"><i class="icon-shopping-cart icon-white"></i> <span><?php echo (isset($item['Pull']['id'])) ? __('Remove Pull') : __('Pull List'); ?></span></button>

			<div class="item_blck">			
				<h4><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $item['Item']['item_name']; ?></a></h4>
				<div class="item_desc">
					<?php echo $this->Common->printing($item['Item']['printing']); ?>
					<p><?php echo $item['Item']['description']; ?></p>
				</div>
			</div>
		</div>
		<?php if($row == 4) { ?>
			</div>
			<?php $row = 0; ?>
		<?php } ?>
	<?php } ?>
</div>
<?php if($this->Paginator->hasNext()) { ?>
	<div id="item-scroll-nav">
		<div class="pagination">
			<?php echo $this->Paginator->next('next'); ?>
		</div>
	</div>
<?php } ?>