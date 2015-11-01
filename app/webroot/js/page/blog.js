$(document).ready(function() {
	$('#blog-scroll-list').infinitescroll({
		loading: {
			finishedMsg: '',
			msgText: '',
			img: '/theme/Kapow/img/ajax-loader.gif'
		},
		navSelector: '#blog-scroll-nav',
		nextSelector: $('#blog-scroll-nav a').last(),
		itemSelector: '.blog-item',
		debug: true,
		animate: false,
		path: function(nextPage) {
			var $content = $('#content');
			var path = $('#blog-scroll-nav a').last().attr("href");
			if (path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;
			}

			return path;
		}
	});
});