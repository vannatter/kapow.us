$(document).ready(function() {
	$('#item-scroll-list').infinitescroll({
		loading: {
			finishedMsg: '',
			msgText: '',
			img: '/theme/Kapow/img/ajax-loader.gif'
		},
		navSelector: '#item-scroll-nav',
		nextSelector: $('#item-scroll-nav a').last(),
		itemSelector: '.scroll-list-item',
		debug: true,
		animate: false,
		path: function(nextPage) {
			var $content = $('#content');
			var path = $('#item-scroll-nav a').last().attr("href");
			if (path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;

				var type = $content.find('#SearchType').val();
				var terms = $content.find('#SearchTerms').val();

				if (type && terms) {
					path += '?type=' + type + '&terms=' + terms;
				}
			}

			return path;
		}
	});
});