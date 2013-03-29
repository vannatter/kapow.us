<script>
	$(document).ready(function() {
		$('#item-scroll-list').infinitescroll({
			loading: {
				finishedMsg: '<div class="row"><div class="span4 offset4 infin_txt">Nothing else!</div></div>',
				msgText: '',
				img: '/img/ajax-loader.gif'
			},
			navSelector: '#item-scroll-nav',
			nextSelector: $('#item-scroll-nav a').last(),
			itemSelector: '.scroll-list-item',
			debug: true,
			path: function(nextPage) {
				var path = $('#item-scroll-nav a').last().attr("href");
				if(path) {
					var start = path.indexOf('page:');
					var left = path.substring(0, start);

					path = left + 'page:' + nextPage;
				}

				return path;
			}
		});
	});
</script>
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

			<button class="btn btn-mini btn-primary disabled" type="button"><i class="icon-shopping-cart icon-white"></i> Pull</button>

			<h4><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $item['Item']['item_name']; ?></a></h4>

			<div class="item_desc">
				<?php echo $this->Common->printing($item['Item']['printing']); ?>
				<p><?php echo $item['Item']['description']; ?></p>
			</div>
		</div>
		<?php if($row == 6) { ?>
			</div>
			<?php $row = 0; ?>
		<?php } ?>
	<?php } ?>
</div>
<div id="item-scroll-nav">
	<div class="pagination">
		<?php echo $this->Paginator->next('next'); ?>
	</div>
</div>