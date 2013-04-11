$(document).ready(function() {
	$('.toggle_favorite').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');
		var type = obj.attr('data-type');

		$.getJSON('/favorites/add', { 'id': id, 'type': type }, function(data) {
			if(!data.error) {
				if(data.type == 1) {
					obj.css('fontWeight', 'bold');
				} else {
					obj.css('fontWeight', 'normal');
				}
			}
		});

		return false;
	});
});