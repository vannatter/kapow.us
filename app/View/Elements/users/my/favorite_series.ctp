<?php
/**
 * @var $this View
 */
?>
<div class="my_block">
	<h5>
		<?php echo __('My Favorite Series'); ?>
		<?php if(count($user['favorites']['series']) > 0) { ?>
			<a href="/my/favorite/series"><button class="btn btn-custom edit_profile btn-small"><?php echo __('View All'); ?> <i class="icon-arrow-right icon-white"></i></button></a>
		<?php } ?>
	</h5>

	<?php if(count($user['favorites']['series']) > 0) { ?>
		<?php foreach ($user['favorites']['series'] as $series) { ?>

			<div class="span2 my_block">
				<?php
				$id = $series['Series']['id'];
				$name = $series['Series']['series_name'];
				$img = $series['Series']['Item']['img_fullpath'];
				if(!$img || empty($img) || $img == '/img/covers') {
					$img = '/img/nocover.png';
				} else {
					$img = $this->Common->thumb($img);
				}
				?>
				<div class="preview_img">
					<?php echo $this->Html->link(
						$this->Html->image(
							$img,
							array(
								'border' => 0,
								'alt' => $name,
								'width' => 210,
								'height' => 140
							)
						),
						sprintf(
							'/series/%s',
							$this->Common->seoize($id, $name)
						),
						array(
							'escape' => false
						)
					); ?>
				</div>

				<h4>
					<?php echo $this->Html->link($name, sprintf('/series/%s', $this->Common->seoize($id, $name))); ?>
				</h4>

			</div>

		<?php } ?>
	<?php } else { ?>
		<?php echo __('No favorite series found'); ?>
	<?php } ?>
</div>
