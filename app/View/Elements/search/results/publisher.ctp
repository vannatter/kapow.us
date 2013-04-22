<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
	<div id="item-scroll-list" class="row" style="color: #fff;">
		<?php foreach($results as $publisher) { ?>
			<div class="span10 scroll-list-item">
				<h3><?php echo $this->Html->link($publisher['Publisher']['publisher_name'], '/publishers/' . $this->Common->seoize($publisher['Publisher']['id'], $publisher['Publisher']['publisher_name'])); ?></h3>
				<p><?php echo $publisher['Publisher']['publisher_bio']; ?></p>
			</div>
		<?php } ?>
	</div>
	<?php if($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination">
				<?php echo $this->Paginator->next('next'); ?>
			</div>
		</div>
	<?php } ?>
<?php } else { ?>
	<h3><?php echo __('No Creators Found'); ?></h3>
<?php } ?>