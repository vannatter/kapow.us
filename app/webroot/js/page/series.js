$(document).ready(function() {
	$('#item-scroll-list').infinitescroll({
		loading: {
			finishedMsg: '<div class="row"><div class="span4 offset4 infin_txt">Nothing else!</div></div>',
			msgText: '',
			img: '/img/ajax-loader.gif'
		},
		navSelector: '#item-scroll-nav',
		nextSelector: $('#item-scroll-nav a').last(),
		itemSelector: '.scroll-list-item',
		debug: true,
		animate: false,
		path: function(nextPage) {
			var path = $('#item-scroll-nav a').last().attr("href");
			if(path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;
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
});