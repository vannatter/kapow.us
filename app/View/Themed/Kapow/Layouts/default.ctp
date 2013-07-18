<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<?php echo $this->Facebook->html(); ?>

	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Kapow! <?php echo $title_for_layout; ?></title>
	    <? if(isset($meta_description_for_layout)){ ?>
		<meta name="description" content="<?=$meta_description_for_layout;?>" />
		<? } else { ?>
		<meta name="description" content="Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops." />
	    <? } ?>

	    <? if(isset($meta_keywords_for_layout)){ ?>
		<meta name="keywords" content="<?=$meta_keywords_for_layout;?>" />
		<? } else { ?>
		<meta name="keywords" content="Kapow, Kapow.us, Comics, Comic database, Current comics, New comics, Comic app" />
	    <? } ?>

		<meta property="og:type" content="company" /> 
		<meta property="og:site_name" content="kapow.us"/> 

	    <? if(isset($og_title)){ ?>
		<meta property="og:title" content="<?= $og_title; ?>" /> 
		<? } else { ?>
		<meta property="og:title" content="Kapow! Comics" /> 
	    <? } ?>

	    <? if(isset($og_image)){ ?>
		<meta property="og:image" content="<?= $og_image; ?>" /> 
	    <? } ?>

	    <? if(isset($og_description)){ ?>
		<meta property="og:description" content="<?=$og_description;?>" />
		<? } else { ?>
		<meta property="og:description" content="Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops." /> 
	    <? } ?>
	    
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			
			echo $this->Html->css('bootstrap.min');
			echo $this->Html->css('bootstrap-responsive.min');
			echo $this->Html->css('core');
			echo $this->Html->css('color');
			echo $this->Html->css('style');
			echo $this->Html->css('bootstrap-image-gallery.min');
			echo $this->Html->css('jquery-ui.custom.min');

			echo $this->fetch('css');

			echo $this->AssetCompress->script('js-libs');
			echo $this->AssetCompress->script('js-combined');

			echo $this->fetch('script');
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
 	</head>

	<body>
		<div id="main-container">
			<div id="header" class="container">
				<?php echo $this->element('menu/top_menu'); ?>
			</div>
			<div id="content" class="container">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer" class="container">
				<?php echo $this->element('menu/footer'); ?>
			</div>
			<div id="flash_msg" class="flash_msg" style="display:none;"></div>
		</div>

	</body>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAf5DtChzuCwa8uGr4gehSrhklvVHjzKhk&sensor=true"></script>
	<?php echo $this->Facebook->init(); ?>
	
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-4667823-15']);
	  _gaq.push(['_setAllowLinker', true]);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>	
</html>