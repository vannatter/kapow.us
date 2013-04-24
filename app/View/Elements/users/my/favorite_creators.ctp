<?php
/**
 * @var $this View
 */
?>
<div class="my_block">
	<h5>
		<?php echo __('My Favorite Creators'); ?>
		<a href="/my/favorite/creators"><button class="btn btn-custom edit_profile btn-small"><?php echo __('View All'); ?> <i class="icon-arrow-right icon-white"></i></button></a>
	</h5>

	<?php foreach ($user['favorites']['creators'] as $creator) { ?>

		<div class="span2 my_block">
			<?php
			$id = $creator['Creator']['id'];
			$name = $creator['Creator']['creator_name'];
			$img = $creator['Creator']['creator_photo'];
			if(!$img || empty($img)) {
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
						'/creators/%s',
						$this->Common->seoize($id, $name)
					),
					array(
						'escape' => false
					)
				); ?>
			</div>

			<h4>
				<?php echo $this->Html->link($name, sprintf('/creators/%s', $this->Common->seoize($id, $name))); ?>
			</h4>

			<div class="item_desc">
				<p><?php echo $creator['Creator']['creator_bio']; ?></p>
			</div>
		</div>

	<?php } ?>
</div>
