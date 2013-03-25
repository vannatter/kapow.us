$(document).ready(function() {
	var $content = $('#content');
	var $map = $('#map-canvas');
	var map = null;

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

	$content.find('#map-canvas').gmap().bind('init', function(ev, map) {
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(location) {
				$.getJSON('/shops/getStores', { 'lat': location.coords.latitude, 'long': location.coords.longitude }, function(data) {
					if(data.error == false) {
						doMap(data);
					}
				});
			});
		}
	});

	function doMap(data) {
		var storeList = $content.find('div#storeList');
		$map.gmap('clear', 'markers');      // clear all markers
		$map.gmap('set', 'bounds', null);   // reset bounds for zooming to markers
		$map.gmap('closeInfoWindow');       // close open info windows

		// clear previous stores
		storeList.empty();

		$.each(data.stores, function(index, store) {
			$map.gmap('addMarker', {
				'position': new google.maps.LatLng(store.latitude, store.longitude),
				'bounds': 'true'
			}).click(function() {
				$map.gmap('openInfoWindow', { 'content': store.name }, this);
			});

			storeList.append(store.name + ' - ' + parseFloat(store.distance).toFixed(3) + ' miles<br/>');
		});

		/*var bounds = new google.maps.LatLngBounds();
		var markers = $map.gmap('get', 'markers');
		$.each(markers, function(key, value) {
			bounds.extend(value.position);
		});
		$map.gmap('get', 'map').setCenter(new google.maps.LatLng(data.latitude, data.longitude));*/
	}
});