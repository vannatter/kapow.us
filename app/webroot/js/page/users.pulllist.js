$(document).ready(function() {
	$('#item-scroll-list').infinitescroll({
		loading: {
			finishedMsg: '<div class="row"><div class="span4 offset4 infin_txt">Nothing else!</div></div>',
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
			var path = $content.find('#item-scroll-nav a').last().attr("href");
			if (path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;
			}

			return path;
		}
	});

	$('a.library-remove').on('click', function(e) {
		e.preventDefault();

		var id = $(this).attr('data-id');
		var block = $(this).parent();

		$.getJSON('/users/libraryRemove', { id: id }, function(result) {
			if (result.error) {
				alert(result.message);
			} else {
				block.remove();
			}
		});
	});
});