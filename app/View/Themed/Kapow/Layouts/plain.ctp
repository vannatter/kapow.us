<!DOCTYPE html>
<html>
	<?php echo $this->Facebook->head(); ?>
		<?php echo $this->Html->charset(); ?>
		<title>Kapow! <?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->Html->css('style');
			echo $this->fetch('css');
		?>
	</head>

	<body>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
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
		<?php
			echo $this->AssetCompress->script('js-libs');
			echo $this->AssetCompress->script('js-combined');
			echo $this->fetch('script');
			echo $this->fetch('scriptBottom');
		?>
	</body>
</html>