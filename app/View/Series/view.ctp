<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/series.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/series/view'); ?>

<div class="row">
	<div class="span3 item_detail_img">
		<?php
		if ($series['Item'][0]['img_fullpath'] == "/img/covers") {
			$img = "/theme/Kapow/img/nocover_large.png";
		} else {
			$img = $this->Common->thumb($series['Item'][0]['img_fullpath']);
		}
		?>
		<img alt="<?php echo $series['Series']['series_name']; ?>" src="<?php echo $img; ?>" class="detail_img" />

		<div class="publisher_desc">
			<?php echo nl2br($series['Series']['description']); ?>		
		</div>
	
		<?php if (isset($series['UserFavorite']) && count($series['UserFavorite']) > 0) { ?>
			<?php echo $this->Element('favorites/list', array('users' => $series['UserFavorite'])); ?>
		<?php } ?>
	</div>

	<div class="span9 item_detail">
		<?php echo $this->Element('series/actions'); ?>
		<?php echo $this->Element('series/items'); ?>
	</div>
</div>