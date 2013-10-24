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
				var $content = $('#content');
				var path = $content.find('#item-scroll-nav a').last().attr("href");
				if(path) {
					var start = path.indexOf('page:');
					var left = path.substring(0, start);

					path = left + 'page:' + nextPage;

					var terms = $content.find('input#CreatorTerms').val();

					if(terms) {
						path += '?terms='+ terms;
					}
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
<?php if(isset($creators) && is_array($creators) && count($creators) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($creators as $creator) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 preview_block">
				<?php
				$id = $creator['Creator']['id'];
				$name = $creator['Creator']['creator_name'];

				$img = $creator['Creator']['creator_photo'];
				if(empty($img) && isset($creator['ItemCreator'][0])) {
					$img = $creator['ItemCreator'][0]['Item']['img_fullpath'];
				}

				$seoString = $this->Common->seoize($id, $name);
				?>
				<div class="preview_img">
					<a href="/creators/<?php echo $seoString; ?>">
						<?php if (empty($img)) { ?>
							<img border="0" alt="<?php echo $name; ?>" src="/img/nocover.png" width="210" height="140" />
						<?php } else { ?>
							<img border="0" alt="<?php echo $name; ?>" src="<?php echo $this->Common->thumb($img); ?>" />
						<?php } ?>
					</a>
				</div>

				<div class="item_blck">			
					<h4><a href="/creators/<?php echo $seoString; ?>"><?php echo $name; ?></a></h4>
					<div class="item_desc">
						<p><?php echo $creator['Creator']['creator_bio']; ?></p>
					</div>
				</div>
			</div>
			<?php if($row == 6) { ?>
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
<?php } ?>