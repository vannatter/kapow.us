$(document).ready(function() {
	var $content = $('#content');

	$content.find('input[type="checkbox"]').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr("data-id");
		var storeId = obj.attr("data-store-id");
		var boxes =  $content.find('input[type="checkbox"]');

		boxes.attr("disabled", true);

		$.getJSON('/admin/stores/setPrimaryPhoto', { 'photoId': id, 'storeId': storeId }, function(data) {
			if(data.error) {
				alert(data.message);
			} else {
				boxes.prop("checked", false);

				obj.prop("checked", true);
			}

			boxes.attr("disabled", false);
		});
	});
});