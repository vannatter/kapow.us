<?php
/**
 *@var $this View
 */
?>
<?php $this->Html->script('page/shops.view.js', array('inline' => false)); ?>
<?php echo $this->Element('headers/shops/view'); ?>

<div class="row">
	<div class="span4">
	
		<?php if (@$shop['StorePhoto'][0]['photo_path']) { ?>
		<div class="row">
			<?php
			if(isset($shop['PrimaryPhoto']['photo_path'])) {
				$photoPath = $shop['PrimaryPhoto']['photo_path'];
			} else {
				$photoPath = $shop['StorePhoto'][0]['photo_path'];
			}
			?>
			<div class="span4"><img class="store_main_photo" src="<?php echo $photoPath; ?>" /></div>
		</div>
		<?php } ?>

		<?php if (@$shop['StorePhoto'][1]['photo_path']) { ?>

			<div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery">
				<?php $cnt = 0; ?>
				<?php foreach($shop['StorePhoto'] as $photo) { ?>
				    <a href="<?php echo $photo['photo_path']; ?>" title="<?php echo $shop['Store']['name']; ?> Photo" class="shop_photo" data-gallery="gallery" <?php if ($cnt==0) { echo " style='display:none;' "; } ?>><img src="<?php echo $photo['photo_path']; ?>" border="0" /></a>
				    <?php $cnt++; ?>
				<?php } ?>
			</div>

		<?php } ?>

		<?php if($shop['Store']['latitude'] && $shop['Store']['longitude']) { ?>
			<div class="row">
				<div id="shop-map" class="span4" data-lat="<?php echo $shop['Store']['latitude']; ?>" data-long="<?php echo $shop['Store']['longitude']; ?>"></div>
			</div>
		<?php } ?>
	</div>

	<div class="span8 shop_detail">
		<?php echo $this->Element('shops/actions'); ?>
		<h2><?php echo $shop['Store']['name']; ?></h2>

		<div class="store_address">
			<?php echo $shop['Store']['address']; ?><br/>
			<?php echo $shop['Store']['city']; ?>, <?php echo $shop['Store']['state']; ?> <?php echo $shop['Store']['zip']; ?> <?php echo $shop['Store']['country_code']; ?><br/>
		</div>
		
		<?php echo $this->Element('shops/hours'); ?>

		<div class="row item_grid">
			<?php if ($shop['Store']['phone_no']) { ?>
				<div class="span2 item_grid_lbl">Phone:</div>
				<div class="span6 item_grid_row"><?php echo $shop['Store']['phone_no']; ?></div>		
			<?php } ?>
			<?php if ($shop['Store']['website']) { ?>
				<div class="span2 item_grid_lbl">Website:</div>
				<div class="span6 item_grid_row"><a href="<?php echo $shop['Store']['website']; ?>"><?php echo $shop['Store']['website']; ?></a></div>		
			<?php } ?>
			<?php if ($shop['Store']['facebook_url']) { ?>
				<div class="span2 item_grid_lbl">Facebook:</div>
				<div class="span6 item_grid_row"><a href="<?php echo $shop['Store']['facebook_url']; ?>"><?php echo $shop['Store']['facebook_url']; ?></a></div>		
			<?php } ?>
			<?php if ($shop['Store']['twitter_url']) { ?>
				<div class="span2 item_grid_lbl">Twitter:</div>
				<div class="span6 item_grid_row"><a href="<?php echo $shop['Store']['twitter_url']; ?>"><?php echo $shop['Store']['twitter_url']; ?></a></div>		
			<?php } ?>
		</div>

		<?php if(isset($shop['UserFavorite']) && count($shop['UserFavorite']) > 0) { ?>
			<?php echo $this->Element('favorites/list', array('users' => $shop['UserFavorite'])); ?>
		<?php } ?>
	</div>

</div>


<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
    </div>
</div>