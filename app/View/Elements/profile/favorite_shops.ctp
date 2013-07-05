<?php if ($user['favorites']['series']) { ?>
<div class="my_block">
	<h5>
		<?php echo __('Favorite Shops'); ?>
	</h5>

	<?php foreach ($user['favorites']['shops'] as $shop) { ?>

		<div class="span2 my_block">
			<?php
			$id = $shop['Store']['id'];
			$name = $shop['Store']['name'];

			if(isset($shop['Store']['PrimaryPhoto']['id'])) {
				$img = $this->Common->thumb($shop['Store']['PrimaryPhoto']['photo_path']);
			} elseif(isset($shop['Store']['StorePhoto'][0])) {
				$img = $this->Common->thumb($shop['Store']['StorePhoto'][0]['photo_path']);
			} else {
				$img = '/img/nocover.png';
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
						'/shops/%s',
						$this->Common->seoize($id, $name)
					),
					array(
						'escape' => false
					)
				); ?>
			</div>

			<h4>
				<?php echo $this->Html->link($name, sprintf('/shops/%s', $this->Common->seoize($id, $name))); ?>
			</h4>

		</div>

	<?php } ?>
</div>
<?php } ?>
