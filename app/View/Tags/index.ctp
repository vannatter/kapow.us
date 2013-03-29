<script>
	$(document).ready(function() {
		$('#item-scroll-list').infinitescroll({
			loading: {
				finishedMsg: '<em>That is all!</em>',
				msgText: '<div class="row"><div class="span4 offset4"><em>Loading more items, please wait...</em></div></div>',
				img: undefined
			},
			navSelector: '#item-scroll-nav',
			nextSelector: $('#item-scroll-nav a').last(),
			itemSelector: '.tag-row',
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
<div id="item-scroll-list">
	<?php foreach($tags as $tag) { ?>
		<div class="tag-row">
			<h2><?php echo $tag['Tag']['tag_name']; ?></h2>
			<div class="row thisweek scroll-list-item">
			<?php foreach($tag['ItemTag'] as $item) { ?>
				<div class="span2 preview_block">
					<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="/img/nocover.png" width="210" height="140" /><?php } else { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

					<button class="btn btn-mini btn-primary disabled" type="button"><i class="icon-shopping-cart icon-white"></i> Pull</button>

					<h4><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $item['Item']['item_name']; ?></a></h4>

					<div class="item_desc">
						<?php echo $this->Common->printing($item['Item']['printing']); ?>
						<p><?php echo $item['Item']['description']; ?></p>
					</div>
				</div>
			<?php } ?>
			</div>
			<div class="span2 pull-right text-right">
				<?php echo $this->Html->link(__('MORE %s', strtoupper($tag['Tag']['tag_name'])), $this->Common->seoize($tag['Tag']['id'], $tag['Tag']['tag_name'])); ?>
			</div>
		</div>
	<?php } ?>
</div>
<div id="item-scroll-nav">
	<div class="pagination">
		<?php echo $this->Paginator->next('next'); ?>
	</div>
</div>