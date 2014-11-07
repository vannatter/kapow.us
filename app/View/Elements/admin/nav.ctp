<?php
/**
 *@var $this View
 */
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html">Kapow Admin</a>
	</div>
	<!-- Top Menu Items -->
	<ul class="nav navbar-left top-nav">
		<li>
			<a href="/"><i class="fa fa-home"></i> <?php echo __('Index'); ?></a>
		</li>
		<li>
			<a href="/admin"><i class="fa fa-fw fa-dashboard"></i> <?php echo __('Dashboard'); ?></a>
		</li>
	</ul>
	<ul class="nav navbar-right top-nav">
		<li>
			<a href="javascript:;"><i class="fa fa-user"></i> <?php echo $this->Session->read('Auth.User.email'); ?></a>
		</li>
	</ul>
	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	<?php echo $this->element('admin/sidebar'); ?>
	<!-- /.navbar-collapse -->
</nav>