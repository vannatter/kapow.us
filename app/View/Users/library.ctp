<?php echo $this->Element('headers/users/library'); ?>

<div class="row">
	<div class="span3">	
		<ul class="unstyled">
			<?php foreach ($series_list as $seriesId=>$seriesName) { ?>
			<li><?php echo $seriesName; ?></li>
			<?php } ?>
		</ul>
	</div>
	
	<div class="span9 item_detail">
		<?php echo $this->Element('users/my/library_scroll'); ?>
	</div>
</div>