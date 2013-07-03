$(document).ready(function() {
	var $content = $('#content');

	$content.find('a.improve-accept').on('click', function(e) {
		e.preventDefault();

		var button = $(this);
		var itemId = button.attr('data-id');
		var type = button.attr('data-type');
		var field = button.attr('data-field');

		$.getJSON('/admin/improvements/accept', { itemId: itemId, type: type, field: field }, function(result) {
			if(result.error) {
				alert(result.message);
			} else {
				button.parent().fadeOut('normal', function() {
					$(this).remove();
				})
			}
		})
	});

	$content.find('a.improve-decline').on('click', function(e) {
		e.preventDefault();
	});
});