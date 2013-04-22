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
		echo $this->Html->css('datepicker');
		echo $this->Html->css('bootstrap-wysihtml5-0.0.2');

		//echo $this->Html->css('core');
		//echo $this->Html->css('style');

		echo $this->fetch('css');

		echo $this->Html->script('libs/jquery');
		echo $this->Html->script('libs/bootstrap.min');
		echo $this->Html->script('libs/bootstrap-datepicker');
		echo $this->Html->script('libs/wysihtml5-0.4.0pre.min');
		echo $this->Html->script('libs/bootstrap-wysihtml5-0.0.2');

		echo $this->Html->script('admin');

		echo $this->fetch('script');
		?>
		<style>
			#content { margin-top: 50px; }
		</style>
	</head>

	<body>
	<div id="content" class="container-fluid">
		<div class="row-fluid">
			<div class="span3">
				<!-- SIDEBAR CONTENT -->
				<?php echo $this->element('admin/sidebar'); ?>
			</div>
			<div class="span9">
				<!-- BODY CONTENT -->
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	</body>
</html>