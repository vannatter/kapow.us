<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Kapow - ADMIN - <?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('sb-admin');
		echo $this->Html->css('plugins/morris');
		echo $this->Html->css('/theme/Admin/font-awesome-4.1.0/css/font-awesome.min');

		echo $this->fetch('css');
		?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
	<div id="wrapper">
		<?php echo $this->element('admin/nav'); ?>

		<div id="page-wrapper">
			<div class="container-fluid">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="/theme/Admin/js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="/theme/Admin/js/bootstrap.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="/theme/Admin/js/plugins/morris/raphael.min.js"></script>
	<script src="/theme/Admin/js/plugins/morris/morris.min.js"></script>
	<script src="/theme/Admin/js/plugins/morris/morris-data.js"></script>
	<?php
	//echo $this->Html->script('admin');

	//echo $this->fetch('script');
	?>
	</body>
</html>