$(document).ready(function() {
	$('a.my-favorite-remove').on('click', function(e) {
		e.preventDefault();

		var id = $(this).attr('data-id');
		var block = $(this).parent();

		$.getJSON('/favorites/myRemove', { id: id }, function(result) {
			if (result.error) {
				alert(result.message);
			} else {
				block.remove();
			}
		});
	});
});