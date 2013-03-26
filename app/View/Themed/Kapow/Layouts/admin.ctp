<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Kapow - ADMIN - <?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive.min');
		//echo $this->Html->css('core');
		//echo $this->Html->css('style');

		echo $this->fetch('css');

		echo $this->Html->script('libs/jquery');
		echo $this->Html->script('libs/bootstrap.min');

		echo $this->fetch('script');
		?>
	</head>

	<body>
	<div id="content" class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<!-- SIDEBAR CONTENT -->
				<?php echo $this->element('admin/sidebar'); ?>
			</div>
			<div class="span10">
				<!-- BODY CONTENT -->
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	</body>
</html>