<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/blog', array('inline' => false)); ?>
<div id="blog-scroll-list">
	<?php foreach($blogs as $blog) { ?>
		<div class="blog-item">
			<h2><?php echo $blog['Blog']['title']; ?></h2>
			<div class="well">
				<p><?php echo $blog['Blog']['body']; ?></p>
				<p><?php echo __('<b>by</b> %s', $blog['User']['email']); ?> <?php echo __('<b>on</b> %s', $blog['Blog']['created']); ?></p>
				<p><?php echo $this->Html->link(__('perma-link'), sprintf('/blogs/%s', $this->Common->seoize($blog['Blog']['id'], $blog['Blog']['title']))); ?></p>
			</div>
		</div>
	<?php } ?>
</div>
<?php if($this->Paginator->hasNext()) { ?>
	<div id="blog-scroll-nav">
		<div class="pagination">
			<?php echo $this->Paginator->next('next'); ?>
		</div>
	</div>
<?php } ?>