<?php
/**
 * @var $this View
 */
?>
<?php if ($user['favorites']['publishers']) { ?>
<div class="my_block">
	<h5>
		<?php echo __('Favorite Publishers'); ?>
	</h5>

	<?php foreach ($user['favorites']['publishers'] as $publisher) { ?>

		<div class="span2 my_block">
			<?php
			$id = $publisher['Publisher']['id'];
			$name = $publisher['Publisher']['publisher_name'];
			$img = $publisher['Publisher']['publisher_photo'];
			if (!$img || empty($img)) {
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
</div>
<?php } ?>