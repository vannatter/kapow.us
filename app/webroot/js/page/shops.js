$(document).ready(function() {
	var $content = $('#content');
	var $map = $('#map-canvas');

	$content.find('form#ShopIndexForm').on('submit', function(e) {
		e.preventDefault();

		var location = $content.find('input#ShopLocation').val();
		var radius = $content.find('select#ShopRadius').val();

		if(location != '') {
			var btn = $(this).find('button');
			var controls = $(this).find('input, select');

			var caption = btn.html();
			console.log(caption);

			controls.attr("disabled", true);

			btn.html('Searching');

			$.getJSON('/shops/getStores', { 'location': location, 'radius': radius }, function(data) {
				if(data.error == false) {
					doMap(data);
				} else {
					alert(data.message);

					clearShops();
				}

				btn.html(caption);
				controls.attr("disabled", false);
			});
		}

		return false;
	});

	$content.find('#map-canvas').gmap().bind('init', function(ev, map) {
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(location) {
				$.getJSON('/shops/getStores', { 'lat': location.coords.latitude, 'long': location.coords.longitude }, function(data) {
					if(data.error == false) {
						$content.find('input#ShopLocation').val(data.location);
						doMap(data);
					}
				});
			});
		}
	});

	function clearShops() {
		var storeList = $content.find('div#storeList');

		// clear previous stores
		storeList.empty();

		$map.gmap('clear', 'markers');      // clear all markers
		$map.gmap('set', 'bounds', null);   // reset bounds for zooming to markers
		$map.gmap('closeInfoWindow');       // close open info windows
	}

	function doMap(data) {
		var storeList = $content.find('div#storeList');

		clearShops();

		var cnt = 1;
		var ele = 1;
		$.each(data.stores, function(index, store) {
		
			var icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + cnt + '|2c539e|ffffff';
		
			$map.gmap('addMarker', {
				'position': new google.maps.LatLng(store.latitude, store.longitude),
				'bounds': 'true',
				'icon': icon
			}).click(function() {
				$map.gmap('openInfoWindow', { 'content': store.name }, this);
			});

			if (ele == 1) {
				storeList.append('<div class="row store_map_row">');
				ele++;
			}

			storeList.append('<div class="span1 map_marker"><img src="' + icon + '" /></div><div class="store_map_listing span4"><h5><a href="/shops/' + store.link + '">' + store.name + '</a></h5><div class="store_map_address">' + store.address + "<br/>" + store.city + ", " + store.state + " " + store.zip + "</div>" + parseFloat(store.distance).toFixed(2) + ' miles</div>');
			cnt++;
			
			if (ele == 3) {
				storeList.append('</div>');
				ele = 1;				
			} else {
				ele++;
			}
			
		});

	}
});
