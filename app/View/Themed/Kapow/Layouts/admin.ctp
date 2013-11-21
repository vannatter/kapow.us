<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Kapow - ADMIN - <?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');

		echo $this->Html->css('jquery-ui.custom.min');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive.min');
		echo $this->Html->css('datepicker');

		//echo $this->Html->css('core');
		//echo $this->Html->css('style');

		echo $this->fetch('css');

		echo $this->Html->script('libs/jquery');
		echo $this->Html->script('libs/jquery-ui');
		echo $this->Html->script('libs/bootstrap.min');
		echo $this->Html->script('libs/bootstrap-datepicker');

		echo $this->Html->script('admin');

		echo $this->fetch('script');
		?>
		<style>
			#content { margin-top: 50px; }
			
			.flash_msg {
				position: fixed;
				left: 0;
				bottom: 0;
				z-index: 50000;
				width: 100%;
				height: 25px;
				border: none;
				text-align:center;
				padding: 5px 0 0 0;
				margin: 0;
				font-weight: normal;
				font-size: 17px;
				text-transform:capitalize;
				cursor: pointer;
			}
			   	
			.flash_msg {
				background:rgba(31,61,122,0.9);
				color: #fff;
			}
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
		<div id="flash_msg" class="flash_msg" style="display:none;"></div>
	</div>
	</body>
</html>