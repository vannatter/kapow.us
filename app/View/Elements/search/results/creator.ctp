<?php
/**
 * @var $this View
 */
?>
<?php if(isset($results) && count($results) > 0) { ?>
	<div id="item-scroll-list" class="row" style="color: #fff;">
		<?php foreach($results as $creator) { ?>
			<div class="span10 scroll-list-item">
				<h3><?php echo $this->Html->link($creator['Creator']['creator_name'], '/creators/' . $this->Common->seoize($creator['Creator']['id'], $creator['Creator']['creator_name'])); ?></h3>
				<p><?php echo $creator['Creator']['creator_bio']; ?></p>
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