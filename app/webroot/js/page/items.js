$(document).ready(function() {
	$('.toggle_favorite').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');
		var type = obj.attr('data-type');

		$.getJSON('/favorites/toggle', { 'id': id, 'type': type }, function(data) {
			if(!data.error) {
				if(data.type == 1) {
					if(type == 'all') {
						$('.toggle_favorite').not('[data-type="all"]') .css('fontWeight', 'bold');
					} else {
						obj.css('fontWeight', 'bold');
					}
				} else {
					obj.css('fontWeight', 'normal');
				}
			}
		});

		// return false so we don't close the menu
		// possibly change this later
		return false;
	});
});