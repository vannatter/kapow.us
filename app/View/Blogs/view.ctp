<?php echo $this->Element('headers/blog/view'); ?>

<div class="pad">
	<p><?php echo $blog['Blog']['body']; ?></p>
	<p><?php echo date("F jS, Y", strtotime($blog['Blog']['created'])); ?></p>
</div>