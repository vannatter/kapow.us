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

				var terms = $content.find('input#CreatorTerms').val();

				if (terms) {
					path += '?terms='+ terms;
				}
			}

			return path;
		}
	});

	var $items = $('div#creator-items');
	if ($items.length > 0) {
		var creatorId = $items.attr('data-creator-id');

		$items.append('<img src="/img/ajax-loader2.gif" alt="Loading" />');

		$.get('/creators/items/' + creatorId, function(data) {
			$items.empty().append(data);
		});
	}
});