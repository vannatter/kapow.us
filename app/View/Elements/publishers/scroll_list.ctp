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
			animate: false,
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
<?php if(isset($publishers) && is_array($publishers) && count($publishers) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($publishers as $publisher) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 publisher_block">
				<?php
				$id = $publisher['Publisher']['id'];
				$name = $publisher['Publisher']['publisher_name'];

				$img = $publisher['Publisher']['publisher_photo'];
				if(empty($img) && isset($publisher['Item'][0])) {
					$img = $publisher['Item'][0]['img_fullpath'];
				}

				$seoString = $this->Common->seoize($id, $name);
				?>
				<div class="preview_img">
					<a href="/publishers/<?php echo $seoString; ?>">
						<?php if (empty($img) || $img == "/img/covers") { ?>
							<img border="0" alt="<?php echo $name; ?>" src="/img/nocover.png" width="210" height="140" />
						<?php } else { ?>
							<img border="0" alt="<?php echo $name; ?>" src="<?php echo $this->Common->thumb($img); ?>" />
						<?php } ?>
					</a>
				</div>

				<h4><a href="/publishers/<?php echo $seoString; ?>"><?php echo $name; ?></a></h4>

				<div class="item_desc">
					<p><?php echo $publisher['Publisher']['publisher_bio']; ?></p>
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
<?php } ?>