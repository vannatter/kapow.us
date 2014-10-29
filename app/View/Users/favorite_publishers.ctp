<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/users.favorites', array('inline' => false)); ?>
<?php echo $this->Element('headers/users/favorite_publishers'); ?>

<?php if(isset($publishers) && is_array($publishers) && count($publishers) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($publishers as $publisher) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 preview_block">
				<?php
				$id = $publisher['Publisher']['id'];
				$name = $publisher['Publisher']['publisher_name'];

				$img = $publisher['Publisher']['publisher_photo'];
				if(empty($img) && isset($publisher['Publisher']['Item'][0])) {
					$img = $publisher['Publisher']['Item'][0]['img_fullpath'];

					if(empty($img)) {
						$img = "/theme/Kapow/img/nocover.png";
					} else {
						$img = $this->Common->thumb($img);
					}
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
							'/publishers/%s',
							$seoString
						),
						array(
							'escape' => false
						)
					); ?>
				</div>

				<?php echo $this->Common->favRemoveButton($publisher['UserFavorite']['id']); ?>

				<div class="item_blck">			
					<h4><?php echo $this->Html->link($name, sprintf('/publishers/%s', $seoString)); ?></h4>
					<div class="item_desc">
						<p><?php echo $publisher['Publisher']['publisher_bio']; ?></p>
					</div>
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
			<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
		</div>
	<?php } ?>
<?php } ?>


</div>