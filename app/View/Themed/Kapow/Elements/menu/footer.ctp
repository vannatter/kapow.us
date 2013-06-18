<div class="footnote">
	<div class="footcopy">
		Kapow! &copy; <?php echo date("Y"); ?> &nbsp;&nbsp; Vannatter Ventures LLC
	</div>
	<div class="footlinks">
		<?php if ($this->Session->read('Auth.User.access_level') == "99") { ?>
		<a href="/admin">administration</a>
		<?php } ?>
		<a href="/blog">blog</a>
		<a href="/about-us">about us</a>
		<a href="/contact-us">contact us</a>
		<a href="/privacy-policy">privacy policy</a>
		<a href="/tos">terms of service</a>
	</div>
</div>