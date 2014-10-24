<?php if ($pulls) { ?>
<div class="my_block">
	<h5>
		<?php echo __('Pull List'); ?>
	</h5>
	
	<?php foreach ($pulls as $pull) { ?>

		<div class="span2 my_block">
			<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($pull['Item']['id'], $pull['Item']['item_name']); ?>"><?php if ($pull['Item']['img_fullpath'] == "/img/covers") { ?><img alt="<?php echo $pull['Item']['item_name']; ?>" src="/img/nocover.png" width="210" height="140" /><?php } else { ?><img alt="<?php echo $pull['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($pull['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

			<h4><a href="/items/<?php echo $this->Common->seoize($pull['Item']['id'], $pull['Item']['item_name']); ?>"><?php echo $pull['Item']['item_name']; ?></a></h4>

			<div class="item_desc">
				<?php echo $this->Common->printing($pull['Item']['printing']); ?>
				<p><?php echo $pull['Item']['description']; ?></p>
			</div>
		</div>
	
	<?php } ?>
</div>
<?php } ?>
