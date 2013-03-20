<?php echo $this->Element('filters/next_week'); ?>

<?php $row = 0; ?>
<?php foreach ($items as $item) { ?>
	<?php if ($row == 0) { ?> 
		<div class="row thisweek">
	<?php } ?>
	<?php $row++; ?>
		<div class="span2 preview_block">	
			<div class="preview_img"><a href="/items/detail/<?php echo $item['Item']['id']; ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="/img/nocover.png" width="210" height="140" /><?php } else { ?><img border="0" alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

			<button class="btn btn-mini btn-primary disabled" type="button"><i class="icon-shopping-cart icon-white"></i> Pull</button>

			<h4><a href="/items/detail/<?php echo $item['Item']['id']; ?>"><?php echo $item['Item']['item_name']; ?></a></h4>
			
			<div class="item_desc">
				<?php echo $this->Common->printing($item['Item']['printing']); ?>			
				<p><?php echo $item['Item']['description']; ?></p>
			</div>
		</div>
	<?php if ($row == 6) { ?> 
		</div>
		<?php $row = 0; ?>
	<?php } ?>           
<?php } ?>