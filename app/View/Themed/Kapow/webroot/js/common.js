var msg_timeout;

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


	