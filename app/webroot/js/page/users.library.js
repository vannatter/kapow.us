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
			} else {
				block.remove();
				flash('Removed from your library!', 3000);
			}
		});
	});
	
	$('ul.library-series > li > span').on('click', function(e) {
		$(this).parent().children('ul').toggle();
	});
	
	$('a.issue-link').on('click', function(e) {
		e.preventDefault();
		
		var href = $(this).attr('href');
		var $frame = $('div.item_detail');
		
		$.ajax({
			url: href
		})
		.done( function(data) {
			$frame.empty().html(data);
		});
	})
	
	$('input#filter').keyup(function(e) {
		var $frame = $('div.item_detail');
		var href = $(this).attr('data-href');
		var filter = $(this).val();
		
		if (filter.length > 3 || filter.length == 0) {
			$.ajax({
				url: href + filter
			})
			.done( function(data) {
				$frame.empty().html(data);
			});
		}
	});
});