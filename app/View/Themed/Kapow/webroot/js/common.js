var msg_timeout;
var load_hot_timeout;

$(document).ready(function() {
	$('button.toggle_favorite').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');
		var type = obj.attr('data-type');

		$.getJSON('/favorites/toggle', { 'id': id, 'type': type }, function(data) {
			if(!data.error) {
				if(data.type == 1) {
					obj.find('span').text('Remove Favorite');
				} else {
					obj.find('span').text('Add Favorite');
				}
			}
		});

		// return false so we don't close the menu
		// possibly change this later
		return false;
	});

	$(document).on('click', 'button.pull_list_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/pulls/toggle', { 'id': id }, function(data) {
			if(data.error) {
				flash(data.message, 3000);
			} else {
				if(data.type == 1) {
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


var load_hot = setInterval(function() { if ($('.hot_sect').length > 0) { $('.hot_hold').load('/random_item?ts=' + (new Date).getTime(), flash_hot_sect); } }, 10000); 

function flash_hot_sect() {
	$('.hot_sect').fadeOut('slow', function() {
		$('.hot_sect').html($('.hot_hold').html());
		$('.hot_sect').fadeIn('slow');
	});
}