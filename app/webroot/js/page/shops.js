$(document).ready(function() {
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(location) {
			var lat = location.coords.latitude;
			var long = location.coords.longitude;

			$.getJSON('/shops/getStores', { 'lat': lat, 'long': long }, function(data) {
				var markers = '';
				$.each(data.stores, function(index, store) {
					markers += '&markers=color:blue%7C' + store.Store.latitude + ',' + store.Store.longitude;

					$('div#storeList').append(store.Store.name + '<br/>');
				});

				var map = $('#locMap');
				var img = $('<img id="map">');

				img.attr('src', 'http://maps.googleapis.com/maps/api/staticmap?center=' + data.location.replace(' ', '') + markers + '&zoom=11&size=600x300&maptype=roadmap&sensor=false');
				img.appendTo(map);
			});
		});
	}
});