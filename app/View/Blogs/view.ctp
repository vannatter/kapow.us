<?php echo $this->Element('headers/blog/view'); ?>

<div class="pad">
	<?php echo $blog['Blog']['body']; ?>
	<div class="blog_date"><?php echo date("F jS, Y", strtotime($blog['Blog']['created'])); ?></div>
</div>