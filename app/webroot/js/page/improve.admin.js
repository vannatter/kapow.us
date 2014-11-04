$(document).ready(function() {
	var $content = $('#content');

	$content.find('a.improve-accept').on('click', function(e) {
		e.preventDefault();

		var button = $(this);
		var id = button.attr('data-id');
		var fieldId = button.attr('data-field-id');

		$.getJSON('/admin/improvements/accept', { id: id, fieldId: fieldId }, function(result) {
			if (result.error) {
				alert(result.message);
			} else {
				button.parent().fadeOut('normal', function() {
					$(this).remove();

					if (result.redirect != '') {
						window.location = result.redirect;
					}
				})
			}
		})
	});

	$content.find('a.improve-decline').on('click', function(e) {
		e.preventDefault();

		var button = $(this);
		var id = button.attr('data-id');
		var fieldId = button.attr('data-field-id');

		$.getJSON('/admin/improvements/decline', { id: id, fieldId: fieldId }, function(result) {
			if (result.error) {
				alert(result.message);
			} else {
				button.parent().fadeOut('normal', function() {
					$(this).remove();

					if (result.redirect != '') {
						window.location = result.redirect;
					}
				})
			}
		})
	});
});