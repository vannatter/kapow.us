<!DOCTYPE html>
<html>
	<?php echo $this->Facebook->head(); ?>
		<?php echo $this->Html->charset(); ?>
		<title>Kapow! <?php echo $title_for_layout; ?></title>
	    <? if(isset($meta_description_for_layout)){ ?>
		<meta name="description" content="<?php echo $meta_description_for_layout;?>" />
		<? } else { ?>
		<meta name="description" content="Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops." />
	    <? } ?>

	    <? if(isset($meta_keywords_for_layout)){ ?>
		<meta name="keywords" content="<?php echo $meta_keywords_for_layout;?>" />
		<? } else { ?>
		<meta name="keywords" content="Kapow, Kapow.us, Comics, Comic database, Current comics, New comics, Comic app" />
	    <? } ?>

		<meta property="og:type" content="company" /> 
		<meta property="og:site_name" content="kapow.us" /> 

	    <? if(isset($og_title)){ ?>
		<meta property="og:title" content="<?php echo $og_title; ?>" /> 
		<? } else { ?>
		<meta property="og:title" content="Kapow! Comics" /> 
	    <? } ?>

	    <? if(isset($og_image)){ ?>
		<meta property="og:image" content="<?php echo $og_image; ?>" /> 
	    <? } ?>

	    <? if(isset($og_description)){ ?>
		<meta property="og:description" content="<?php echo $og_description;?>" />
		<? } else { ?>
		<meta property="og:description" content="Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops." /> 
	    <? } ?>
	    
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->Html->css('style');
			echo $this->fetch('css');
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
 	</head>

	<body>
		<div id="main-container">
			<div id="header" class="container blugrid">
				<?php echo $this->element('menu/top_menu'); ?>
			</div>
			<div id="content" class="container blu">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			
			<div id="footer" class="container blu">
				<?php echo $this->element('menu/footer'); ?>
			</div>
			<div id="flash_msg" class="flash_msg" style="display:none;"></div>
		</div>

		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAf5DtChzuCwa8uGr4gehSrhklvVHjzKhk&amp;sensor=true"></script>
		<?php echo $this->Facebook->init(); ?>
		<?php
			echo $this->AssetCompress->script('js-libs');
			echo $this->AssetCompress->script('js-combined');
			echo $this->fetch('script');
			echo $this->fetch('scriptBottom');
		?>
	</body>
</html>