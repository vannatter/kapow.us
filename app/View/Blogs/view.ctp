<div class="well">
	<h2><?php echo $blog['Blog']['title']; ?></h2>
	<p><?php echo $blog['Blog']['body']; ?></p>
	<p><?php echo __('<b>by</b> %s', $blog['User']['email']); ?> <?php echo __('<b>on</b> %s', $blog['Blog']['created']); ?></p>
</div>