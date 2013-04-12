$(document).ready(function() {
	$('.toggle_favorite').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');
		var type = obj.attr('data-type');

		$.getJSON('/favorites/toggle', { 'id': id, 'type': type }, function(data) {
			if(!data.error) {
				if(data.type == 1) {
					if(type == 'all') {
						$('.toggle_favorite').not('[data-type="all"]').parent().addClass('fav_on');
					} else {
						obj.parent().addClass('fav_on');
					}
				} else {
					obj.parent().removeClass('fav_on');
				}
			}
		});

		// return false so we don't close the menu
		// possibly change this later
		return false;
	});

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
			var $content = $('#content');
			var path = $content.find('#item-scroll-nav a').last().attr("href");
			if(path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;

				var pubid = $content.find('#ItemPublisherId').val();

				if(pubid) {
					path += '?pubid=' + pubid;
				}
			}

			return path;
		}
	});

	$(document).on('click', 'button.pull_list_btn', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');

		$.getJSON('/pulls/toggle', { 'id': id }, function(data) {
			if(!data.error) {
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