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
		debug: false,
		animate: false,
		path: function(nextPage) {
			var $content = $('#content');
			var path = $('#item-scroll-nav a').last().attr("href");
			if(path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;

				var terms = $content.find('input#SeriesTerms').val();

				if(terms) {
					path += '?terms='+ terms;
				}
			}

			return path;
		}
	});

	$('#series-items').on('click', 'button.pull_list_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/pulls/toggle', { 'id': id }, function(data) {
			if(data.error) {
				flash(data.message, 3000);
			} else {
				if(data.type == 1) {
					// added
					obj.find('span').text('Remove Pull');
					flash('Added to your pull list', 3000);
				} else {
					// removed
					obj.find('span').text('Pull List');
					flash('Removed from your pull list', 3000);
				}
			}
		});

		return false;
	});

	var $items = $('div#series-items');
	if($items.length > 0) {
		var seriesId = $items.attr('data-series-id');

		$items.append('<img src="/theme/Kapow/img/ajax-loader2.gif" />');

		$.get('/series/items/' + seriesId, function(data) {
			$items.empty().append(data);
		});
	}
});