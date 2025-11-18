$(document).ready(function() {
	var $content = $('#content');

	$content.find('#shop-map').gmap().on('init', function(ev, map) {
		var icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=S|2c539e|ffffff';
		var latitude = $(this).attr("data-lat");
		var longitude = $(this).attr("data-long");
		var $map = $(this);

		$map.gmap('addMarker', {
			'position': new google.maps.LatLng(latitude, longitude),
			'bounds': 'true',
			'icon': icon
		});
	});
});