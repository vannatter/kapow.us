<script>
	$(document).ready(function() {
		$('#item-list').infinitescroll({
			navSelector: '#item-nav',
			nextSelector: $('#item-nav a').last(),
			itemSelector: '.grid-item',
			debug: true
		});
	});
</script>
<?php
/**
 *@var $this View
 */
?>
<div id="item-list" style="background-color: #000; clear: both; overflow: hidden;">
	<?php foreach($items as $item) { ?>
		<div class="grid-item" style="float: left; margin-right: 10px; margin-bottom: 10px; overflow: hidden; background-color: #ffffff;">
			<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="/img/nocover.png" width="210" height="140" /><?php } else { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>
		</div>
	<?php } ?>
</div>
<div id="item-nav">
	<div class="pagination">
		<?php echo $this->Paginator->next('next'); ?>
	</div>
</div>