<?php
/**
 * @var $this View
 */
?>
<div class="my_block">
	<h5>
		<?php echo __('My Favorite Publishers'); ?>
		<?php if(count($user['favorites']['publishers']) > 0) { ?>
			<a href="/my/favorite/publishers"><button class="btn btn-custom edit_profile btn-small"><?php echo __('View All'); ?> <i class="icon-arrow-right icon-white"></i></button></a>
		<?php } ?>
	</h5>

	<?php if(count($user['favorites']['publishers']) > 0) { ?>
		<?php foreach ($user['favorites']['publishers'] as $publisher) { ?>

			<div class="span2 my_block">
				<?php
				$id = $publisher['Publisher']['id'];
				$name = $publisher['Publisher']['publisher_name'];
				$img = $publisher['Publisher']['publisher_photo'];
				if(!$img || empty($img)) {
					## see if there is an album cover to use
					if(isset($publisher['Publisher']['Item'][0]['img_fullpath'])) {
						$img = $this->Common->thumb($publisher['Publisher']['Item'][0]['img_fullpath']);
					} else {
						$img = '/img/nocover.png';
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
							'/publishers/%s',
							$this->Common->seoize($id, $name)
						),
						array(
							'escape' => false
						)
					); ?>
				</div>

				<h4>
					<?php echo $this->Html->link($name, sprintf('/publishers/%s', $this->Common->seoize($id, $name))); ?>
				</h4>

				<div class="item_desc">
					<p><?php echo $publisher['Publisher']['publisher_bio']; ?></p>
				</div>
			</div>

		<?php } ?>
	<?php } else { ?>
		<?php echo __('No favorite publishers found'); ?>
	<?php } ?>
</div>
