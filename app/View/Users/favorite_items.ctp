<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/users.favorites', array('inline' => false)); ?>
<?php echo $this->Element('headers/users/favorite_items'); ?>

<?php if(isset($items) && is_array($items) && count($items) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($items as $item) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 preview_block">
				<?php
				$id = $item['Item']['id'];
				$name = $item['Item']['item_name'];

				$img = $item['Item']['img_fullpath'];
				if(empty($img)) {
					$img = "/theme/Kapow/img/nocover.png";
				} else {
					$img = $this->Common->thumb($img);
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
							'/items/%s',
							$seoString
						),
						array(
							'escape' => false
						)
					); ?>
				</div>

				<?php echo $this->Common->favRemoveButton($item['UserFavorite']['id']); ?>

				<h4><?php echo $this->Html->link($name, sprintf('/items/%s', $seoString)); ?></h4>

				<div class="item_desc">
					<p><?php echo $item['Item']['description']; ?></p>
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

</div>