<div class="my_block">
	<h5>
		<?php echo __('My Favorite Items'); ?>
		<a href="/my/favorite/items"><span class="btn btn-custom edit_profile btn-small"><?php echo __('View All'); ?> <i class="icon-arrow-right icon-white"></i></span></a>
	</h5>

	<?php foreach ($user['favorites']['items'] as $item) { ?>

		<div class="span2 my_block">
			<?php
			$id = $item['Item']['id'];
			$name = $item['Item']['item_name'];
			$img = $item['Item']['img_fullpath'];
			if(!$img || empty($img) || $img == '/img/covers') {
				$img = '/theme/Kapow/img/nocover.png';
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
						'/items/%s',
						$this->Common->seoize($id, $name)
					),
					array(
						'escape' => false
					)
				); ?>
			</div>

			<h4>
				<?php echo $this->Html->link($name, sprintf('/items/%s', $this->Common->seoize($id, $name))); ?>
			</h4>

			<div class="item_desc">
				<p><?php echo $item['Item']['description']; ?></p>
			</div>
		</div>

	<?php } ?>
</div>
