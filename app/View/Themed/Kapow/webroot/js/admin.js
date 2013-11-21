var msg_timeout;

$(document).ready(function() {
	var hash = document.location.hash;
	if(hash) {
		$('.nav-tabs a[href='+hash+']').tab('show');
		$('html, body').animate({ scrollTop: 0 }, 'fast');
	}

	// page reload
	$('.nav-tabs a').on('shown', function (e) {
		window.location.hash = e.target.hash;
		//$('html, body').animate({ scrollTop: 0 }, 'fast');
		window.scrollTo(0, 0);
	});
});

function flash(msg, delay) {
	if (!delay) {
		delay = 3000;
	}
	clearTimeout(msg_timeout);
	$('#flash_msg').html(msg);
	$('#flash_msg').fadeIn();
	msg_timeout = setTimeout( function() { $("#flash_msg").fadeOut(); }, delay );
}