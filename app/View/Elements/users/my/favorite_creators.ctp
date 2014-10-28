<?php
/**
 * @var $this View
 */
?>
<div class="my_block">
	<h5>
		<?php echo __('My Favorite Creators'); ?>
		<?php if(count($user['favorites']['creators']) > 0) { ?>
			<a href="/my/favorite/creators"><button class="btn btn-custom edit_profile btn-small"><?php echo __('View All'); ?> <i class="icon-arrow-right icon-white"></i></button></a>
		<?php } ?>
	</h5>

	<?php if(count($user['favorites']['creators']) > 0) { ?>
		<?php foreach ($user['favorites']['creators'] as $creator) { ?>

			<div class="span2 my_block">
				<?php
				$id = $creator['Creator']['id'];
				$name = $creator['Creator']['creator_name'];
				$img = $creator['Creator']['creator_photo'];
				if(!$img || empty($img)) {
					## see if there is an album cover to use
					if(isset($creator['Creator']['ItemCreator'][0]['Item']['img_fullpath'])) {
						$img = $this->Common->thumb($creator['Creator']['ItemCreator'][0]['Item']['img_fullpath']);
					} else {
						$img = '/theme/Kapow/img/nocover.png';
					}
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
	<?php } else { ?>
		<?php echo __('No favorite creators found'); ?>
	<?php } ?>
</div>