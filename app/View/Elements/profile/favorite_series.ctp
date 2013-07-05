<?php
/**
 * @var $this View
 */
?>
<?php if ($user['favorites']['series']) { ?>
<div class="my_block">
	<h5>
		<?php echo __('Favorite Series'); ?>
	</h5>

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
</div>
<?php } ?>
