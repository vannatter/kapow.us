<?php
/**
 *@var $this View
 */
?>
<div id="item-scroll-list">
	<?php $row = 0; ?>
	<?php foreach($items as $item) { ?>
		<?php if ($row == 0) { ?>
			<div class="row thisweek scroll-list-item">
		<?php } ?>
		<?php $row++; ?>

		<div class="span2 preview_block">
			<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="/theme/Kapow/img/nocover.png" width="210" height="140" /><?php } else { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

			<button <?php echo ( (isset($item['UserItem']['id'])) ? " style='display:none;' " : ""); ?> class="btn btn-mini pull_list_btn <?php echo (isset($item['Pull']['id'])) ? "btn-on" : "btn-off"; ?>" type="button" data-id="<?php echo $item['Item']['id']; ?>"><i class="icon-shopping-cart <?php echo (isset($item['Pull']['id'])) ? "icon-black" : "icon-white"; ?>"></i> <span><?php echo (isset($item['Pull']['id'])) ? __('Remove Pull') : __('Pull List'); ?></span></button>
			<button class="btn btn-mini lib_btn <?php echo (isset($item['UserItem']['id'])) ? "btn-on" : "btn-off"; ?>" type="button" data-id="<?php echo $item['Item']['id']; ?>"><i class="icon-book <?php echo (isset($item['UserItem']['id'])) ? "icon-black" : "icon-white"; ?>"></i> <span><?php echo (isset($item['UserItem']['id'])) ? __('Remove Library') : __('Add to Library'); ?></span></button>

			<div class="item_blck">			
				<h4><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $item['Item']['item_name']; ?></a></h4>
				<div class="item_desc">
					<?php echo $this->Common->printing($item['Item']['printing']); ?>
					<p><?php echo $item['Item']['description']; ?></p>
				</div>
			</div>
		</div>
		<?php if ($row == 4) { ?>
			</div>
			<?php $row = 0; ?>
		<?php } ?>
	<?php } ?>
</div>
<?php if ($this->Paginator->hasNext()) { ?>
	<div id="item-scroll-nav">
		<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
	</div>
<?php } ?>