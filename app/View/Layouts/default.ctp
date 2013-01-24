<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Kapow! 
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
</body>
</html>
