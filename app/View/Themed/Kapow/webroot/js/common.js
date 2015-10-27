var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-4667823-15']);
_gaq.push(['_setAllowLinker', true]);
_gaq.push(['_trackPageview']);
(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
		
var msg_timeout;
var load_hot_timeout;

$(document).ready(function() {
	
	$('img').each(function() {
		if ( ($(this).width() > 0) && ($(this).height() > 0) ) {
			$(this).attr('width', $(this).width());
			$(this).attr('height', $(this).height());
		}
	});

	$('.contact_btn').on('click', function(e) {
		var first_name 	= $('#first_name').val();
		var last_name 	= $('#last_name').val();
		var email 		= $('#email').val();
		var subject		= $('#subject').val();
		var message		= $('#message').val();

		if (!first_name) {
			alert('First Name is required');
		} else if (!last_name) {
			alert('Last Name is required');
		} else if (!email) {
			alert('Email is required');
		} else if (!subject) {
			alert('Subject is required');
		} else if (!message) {
			alert('Message is required');
		} else {
			$('#contact_frm').submit();			
		}
	});
	
	$('button.toggle_favorite').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');
		var type = obj.attr('data-type');

		$.getJSON('/favorites/toggle', { 'id': id, 'type': type }, function(data) {
			if (!data.error) {
				if (data.type == 1) {
					obj.find('span').text('Remove Favorite');
				} else {
					obj.find('span').text('Add Favorite');
				}
			}
		});

		return false;
	});


	$(document).on('click', 'button.lib_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/ajax/toggle_library', { 'id': id }, function(data) {
			if (data.error) {
				flash(data.message, 3000);
			} else {
				if (data.type == 1) {
					// added
					obj.find('span').text('Remove Library').parent().removeClass('btn-off').addClass('btn-on').find('i').removeClass('icon-white').addClass('icon-black');
					$("button.pull_list_btn[data-id='" + id + "']").find('span').text('Pull List').parent().removeClass('btn-on').addClass('btn-off').find('i').removeClass('icon-black').addClass('icon-white');
					$("button.pull_list_btn[data-id='" + id + "']").hide();
					flash('Added to your library!', 3000);
				} else {
					// removed
					obj.find('span').text('Add to Library').parent().removeClass('btn-on').addClass('btn-off').find('i').removeClass('icon-black').addClass('icon-white');
					$("button.pull_list_btn[data-id='" + id + "']").show();
					flash('Removed from your library!', 3000);
				}
			}
		});

		return false;
	});	


	$(document).on('click', 'button.pull_list_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/pulls/toggle', { 'id': id }, function(data) {
			if (data.error) {
				flash(data.message, 3000);
			} else {
				if (data.type == 1) {
					// added
					obj.find('span').text('Remove Pull').parent().removeClass('btn-off').addClass('btn-on').find('i').removeClass('icon-white').addClass('icon-black');
					flash('Added to your pull list', 3000);
				} else {
					// removed
					obj.find('span').text('Pull List').parent().removeClass('btn-on').addClass('btn-off').find('i').removeClass('icon-black').addClass('icon-white');
					flash('Removed from your pull list', 3000);
				}
			}
		});

		return false;
	});

	$(document).on('click', 'li a.pull_list_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/pulls/toggle', { 'id': id }, function(data) {
			if (data.error) {
				flash(data.message, 3000);
			} else {
				if (data.type == 1) {
					// added
					obj.text('Remove from Pull List').parent().addClass('fav_on');
					flash('Added to your pull list!', 3000);
				} else {
					// removed
					obj.text('Add to Pull List').parent().removeClass('fav_on');
					flash('Removed from your pull list!', 3000);
				}
			}
		});

		return false;
	});

	$(document).on('click', 'li a.library_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/ajax/toggle_library', { 'id': id }, function(data) {
			if (data.error) {
				flash(data.message, 3000);
			} else {
				if (data.type == 1) {
					// added
					obj.text('Remove from Library').parent().addClass('fav_on');
					$('li a.pull_list_btn').text('Add to Pull List').parent().removeClass('fav_on');
					flash('Added to your library!', 3000);
				} else {
					// removed
					obj.text('Add to Library').parent().removeClass('fav_on');
					flash('Removed from your library!', 3000);
				}
			}
		});
		return false;
	});	
	
	$('.flash_pos, .flash_neg').click(function() {
		$(this).fadeOut();
	});

	if ($('.flash_pos').length > 0) {
		$('.flash_pos').click(function () { $(this).hide(); });
		$('.flash_pos').animate({ delay : 1 }, 5000, function() { $(this).fadeOut(); });
	}

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


var load_hot = setInterval(function() { if ($('.hot_sect').length > 0) { $('.hot_hold').load('/random_item?ts=' + (new Date).getTime(), flash_hot_sect); } }, 20000); 

function flash_hot_sect() {
	$('.hot_sect').fadeOut('slow', function() {
		$('.hot_sect').html($('.hot_hold').html());
		$('.hot_sect').fadeIn('slow');
	});
}