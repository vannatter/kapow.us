<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kapow - Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<?php echo $this->Html->css('style'); ?>
</head>
<body>
	<?php echo $this->element('admin/nav'); ?>

	<div class="container-fluid">
		<div class="row">
			<?php echo $this->element('admin/sidebar'); ?>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>
	
	<!-- jQuery 3.7.1 -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs" crossorigin="anonymous"></script>
	<!-- Bootstrap 5 JS Bundle (includes Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>