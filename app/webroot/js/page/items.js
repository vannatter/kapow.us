$(document).ready(function() {
	$('.toggle_favorite').on('click', function(e) {
		e.preventDefault();

		var obj = $(this);
		var id = obj.attr('data-id');
		var type = obj.attr('data-type');
		var lbl = obj.text();
		var val = obj.attr('data-val');

		$.getJSON('/favorites/toggle', { 'id': id, 'type': type }, function(data) {
			if (!data.error) {
				if (data.type == 1) {
					if (type == 'all') {
						$('.toggle_favorite').not('[data-type="all"]').parent().addClass('fav_on');
						flash('Added everything to your favorites!', 3000);
					} else {
						obj.parent().addClass('fav_on');
						flash('Added ' + val + ' to your favorites!', 3000);
						$('.favorite_tags').append(' <span class="tag_' + type + '_' + id + ' label fav_label"><i class="icon-heart icon-white icon_tiny"></i> ' + val + '</a></span> ');			
					}
				} else {
					obj.parent().removeClass('fav_on');
					flash('Removed ' + val + ' from your favorites!', 3000);
					$('.tag_' + type + '_' + id).remove();
				}
			}
		});

		// return false so we don't close the menu
		// possibly change this later
		return true;
	});

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

				var pubid = $content.find('#ItemPublisherId').val();

				if (pubid) {
					path += '?pubid=' + pubid;
				}

				var terms = $content.find('#ItemTerms').val();

				if (terms) {
					path += '?terms=' + terms;
				}
			}

			return path;
		}
	});

	var $hotness = $('#hotness');
	if ($hotness.length > 0) {
		var itemId = $hotness.attr('data-item-id');
		var hotness = $hotness.attr('data-hotness');

		$hotness.slider({
			range: "max",
			min: 0,
			max: 100,
			value: hotness,
			slide: function( event, ui ) {
				$(this).find('.ui-slider-handle').text(ui.value);
			},
			change: function( event, ui ) {
				$.getJSON('/ajax/itemHotness', { itemId: itemId, value: ui.value }, function(data) {
					if (data.error) {
						flash('Error updating hotness', 3000);
					} else {
						flash('Updated Hotness', 3000);
					}
				});
			}
		});

		var value = $("#hotness").slider("option","value");
		$('#hotness').find('.ui-slider-handle').text(value);
	}

});