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
});