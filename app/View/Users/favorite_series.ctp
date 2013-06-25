<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/users.favorites', array('inline' => false)); ?>
<?php echo $this->Element('headers/users/favorite_series'); ?>

<?php if(isset($series) && is_array($series) && count($series) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($series as $ser) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 preview_block">
				<?php
				$id = $ser['Series']['id'];
				$name = $ser['Series']['series_name'];

				if(isset($ser['Series']['Item'][0])) {
					$img = $ser['Series']['Item'][0]['img_fullpath'];

					if(empty($img)) {
						$img = "/img/nocover.png";
					} else {
						$img = $this->Common->thumb($img);
					}
				} else {
					$img = "/img/nocover.png";
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
							'/series/%s',
							$seoString
						),
						array(
							'escape' => false
						)
					); ?>
				</div>

				<?php echo $this->Common->favRemoveButton($ser['UserFavorite']['id']); ?>

				<h4><?php echo $this->Html->link($name, sprintf('/series/%s', $seoString)); ?></h4>

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