<?php
/**
 *@var $this View
 */
?>
<?php $this->Html->script('page/items.js', array('inline' => false)); ?>
<?php if (isset($items) && is_array($items) && count($items) > 0) { ?>

<div id="item-scroll-list">
	<?php $row = 0; ?>
	<?php foreach($items as $item) { ?>

		<?php if ($row == 0) { ?>
			<div class="row thisweek scroll-list-item">
		<?php } ?>
		
		<?php $row++; ?>
		<?php
			$description = $item['Item']['description'];
			$name = $item['Item']['item_name'];
			
			if (isset($this->request->query['terms']) && !empty($this->request->query['terms'])) {
				$searchFor = "/" . $this->request->query['terms'] . "/i";
				$replaceWith = "<i><b>$0</b></i>";
	
				$description = preg_replace($searchFor, $replaceWith, $description);
				$name = preg_replace($searchFor, $replaceWith, $name);
			}
	
			if (isset($item['Pull']['id'])) {
				$hasPull = true;
			} else {
				$hasPull = false;
			}
		?>
		<div class="span2 preview_block <?php if ($hasPull) { echo "preview_block_on"; } ?>">
			<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="/theme/Kapow/img/nocover.png" width="210" height="140" /><?php } else { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>?<?php echo $this->Common->randstr(10); ?>" /><?php } ?></a></div>

			<?php echo $this->Common->pullButton($item['Item']['id'], $hasPull); ?>

			<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
			<a href="/tools/repull_img/<?php echo $item['Item']['id']; ?>"><button type="button" class="btn btn-mini repull_img btn-off"><i class="icon-picture icon-white"></i> <span>Repull Image</span></button></a>
			<?php } ?>

			<div class="item_blck">
				<h4><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $name; ?></a></h4>
				<div class="item_desc">
					<?php echo $this->Common->printing($item['Item']['printing']); ?>
					<p><?php echo $description; ?></p>
				</div>
			</div>
		</div>
		
		<?php if ($row == 6) { ?>
			</div>
			<?php $row = 0; ?>
		<?php } ?>
		
	<?php } ?>
	<?php if ($row != 0) { ?>
		</div>
	<?php } ?>
</div>

	<?php if ($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
		</div>
	<?php } ?>
	
<?php } else { ?>

	<div class="no_items">
		Sorry, nothing is currently available. Please try again later.
	</div>

<?php } ?>