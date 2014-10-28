<?php
/**
 *@var $this View
 */
?>
<?php $this->Html->script('page/users.favorites', array('inline' => false)); ?>
<?php echo $this->Element('headers/users/favorite_shops'); ?>

<?php if(isset($shops) && is_array($shops) && count($shops) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($shops as $shop) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 preview_block">
				<?php
				$id = $shop['Store']['id'];
				$name = $shop['Store']['name'];

				if(isset($shop['Store']['StorePhoto'][0])) {
					$img = $shop['Store']['StorePhoto'][0]['photo_path'];

					if(empty($img)) {
						$img = "/theme/Kapow/img/nocover.png";
					} else {
						$img = $this->Common->thumb($img);
					}
				} else {
					$img = "/theme/Kapow/img/nocover.png";
				}

				$seoString = $this->Common->seoize($id, $name);
				?>
				<div class="preview_img">
					<?php echo $this->Html->link(
						$this->Html->image(
							$img,
							array(
								'border' => 0,
								'width' => 210,
								'height' => 140,
								'alt' => $name
							)
						),
						sprintf(
							'/shops/%s',
							$seoString
						),
						array(
							'escape' => false
						)
					); ?>
				</div>

				<?php echo $this->Common->favRemoveButton($shop['UserFavorite']['id']); ?>

				<h4><?php echo $this->Html->link($name, sprintf('/shops/%s', $seoString)); ?></h4>

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

</div>