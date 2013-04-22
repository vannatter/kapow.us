<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
	<div id="item-scroll-list" class="row" style="color: #fff;">
		<?php foreach($results as $series) { ?>
			<div class="span10 scroll-list-item">
				<h3><?php echo $this->Html->link($series['Series']['series_name'], '/series/' . $this->Common->seoize($series['Series']['id'], $series['Series']['series_name'])); ?></h3>
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