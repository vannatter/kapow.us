$(document).ready(function() {
	var $content = $('#content');

	$content.find('button#btnSearch').on('click', function(e) {
		e.preventDefault();

		var location = $content.find('input#location').val();
		if(location != '') {
			$.getJSON('/shops/getStores', { 'location': location }, function(data) {
				if(data.error == false) {
					doMap(data);
				}
			});
		}
	});

	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(location) {
			var lat = location.coords.latitude;
			var long = location.coords.longitude;

			$.getJSON('/shops/getStores', { 'lat': lat, 'long': long }, function(data) {
				if(data.error == false) {
					doMap(data);
				}
			});
		});
	}

	function doMap(data) {
		var storeList = $content.find('div#storeList');
		var markers = '';

		// clear previous stores
		storeList.empty();

		$.each(data.stores, function(index, store) {
			markers += '&markers=color:blue%7C' + store.latitude + ',' + store.longitude;

			$('div#storeList').append(store.name + ' - ' + parseFloat(store.distance).toFixed(3) + ' miles<br/>');
		});

		// remove previous map
		$content.find('#map').remove();

		var map = $content.find('#locMap');
		var img = $('<img id="map">');

		var zoom = 10;
		var size = '700x300';

		img.attr('src', 'http://maps.googleapis.com/maps/api/staticmap?center=' + data.location.replace(' ', '') + markers + '&zoom=' + zoom + '&size=' + size + '&maptype=roadmap&sensor=false');
		img.appendTo(map);

		$content.find('input#location').val(data.location);
	}
});