<?php
/**
 * @var $this View
 */
?>
<?php $this->Html->script('page/blog', array('inline' => false)); ?>
<?php echo $this->Element('headers/blog/index'); ?>

<div id="blog-scroll-list">
	<?php foreach($blogs as $blog) { ?>
		<div class="blog-item">
			<div class="well blog_list_well">
				<h4><?php echo $this->Html->link($blog['Blog']['title'], sprintf('/blogs/%s', $this->Common->seoize($blog['Blog']['id'], $blog['Blog']['title']))); ?></h4>
				<p><?php echo $blog['Blog']['body']; ?></p>
				<p><?php echo date("F jS, Y", strtotime($blog['Blog']['created'])); ?></p>
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