<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/series.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/series/view'); ?>

<div class="row">
	<div class="span3 item_detail_img">
		<?php if(isset($series['UserFavorite']) && count($series['UserFavorite']) > 0) { ?>
			<?php echo $this->Element('favorites/list', array('users' => $series['UserFavorite'])); ?>
		<?php } ?>
	</div>

	<div class="span9 item_detail">
		<?php echo $this->Element('series/actions'); ?>
		<?php echo $this->Element('series/items'); ?>
	</div>
</div>