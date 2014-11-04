<?php
/**
 *@var $this View
 */
?>

<?php $this->Html->script('page/shops.view.js', array('inline' => false)); ?>

<div class="row">
	<div class="span4">

		<?php if (@$shop['StorePhoto'][0]['photo_path']) { ?>
			<div class="row">
				<?php
				if (isset($shop['PrimaryPhoto']['photo_path'])) {
					$photoPath = $shop['PrimaryPhoto']['photo_path'];
				} else {
					$photoPath = $shop['StorePhoto'][0]['photo_path'];
				}
				?>
				<div class="span4"><img class="store_main_photo" src="<?php echo $photoPath; ?>" /></div>
			</div>
		<?php } ?>

		<?php if ($shop['Store']['latitude'] && $shop['Store']['longitude']) { ?>
			<div class="row">
				<div id="shop-map" class="span4" data-lat="<?php echo $shop['Store']['latitude']; ?>" data-long="<?php echo $shop['Store']['longitude']; ?>"></div>
			</div>
		<?php } ?>
	</div>

	<div class="span8">
		<h3><?php echo __('Click below to claim this store!'); ?></h3>
	</div>
</div>

<?php debug($shop); ?>