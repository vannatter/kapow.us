$(document).ready(function() {
	var $items = $('div#series-items');
	if ($items.length > 0) {
		var seriesId = $items.attr('data-series-id');

		$items.append('<img src="/theme/Kapow/img/ajax-loader2.gif" alt="Loading" />');

		$.get('/series/items/' + seriesId, function(data) {
			$items.empty().append(data);
			
			$('#item-scroll-list').infinitescroll({
				loading: {
					finishedMsg: '',
					msgText: '',
					img: '/theme/Kapow/img/ajax-loader.gif'
				},
				navSelector: '#item-scroll-nav',
				nextSelector: $('#item-scroll-nav a').last(),
				itemSelector: '.scroll-list-item',
				debug: false,
				animate: false,
				path: function(nextPage) {
					var $content = $('#content');
					var path = $('#item-scroll-nav a').last().attr("href");
					if (path) {
						var start = path.indexOf('page:');
						var left = path.substring(0, start);
		
						path = left + 'page:' + nextPage;
		
						var terms = $content.find('input#SeriesTerms').val();
		
						if (terms) {
							path += '?terms='+ terms;
						}
					}
		
					return path;
				}
			});
		});
	}
});