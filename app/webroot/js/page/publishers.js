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
			if(path) {
				var start = path.indexOf('page:');
				var left = path.substring(0, start);

				path = left + 'page:' + nextPage;

				var terms = $content.find('input#PublisherTerms').val();

				if(terms) {
					path += '?terms='+ terms;
				}
			}
			return path;
		}
	});

	var $items = $('div#publisher-items');
	if($items.length > 0) {
		var publisherId = $items.attr('data-publisher-id');

		$items.append('<img src="/theme/Kapow/img/ajax-loader2.gif" />');

		$.get('/publishers/items/' + publisherId, function(data) {
			$items.empty().append(data);
		});
	}

	var $weight = $('#weight');
	if($weight.length > 0) {
		var weight = $weight.attr('data-weight');
		var publisherId = $weight.attr('data-publisher-id');

		$("#weight").slider({
			range: "max",
			min: 0,
			max: 100,
			value: weight,
			slide: function( event, ui ) {
				$(this).find('.ui-slider-handle').text(ui.value);
			},
			change: function( event, ui ) {
				$.getJSON('/ajax/publisherWeight', { publisherId: publisherId, value: ui.value }, function(data) {
					if(data.error) {
						flash('Error updating weight', 3000);
					} else {
						flash('Updated Weight', 3000);
					}
				});
			}
		});

		var value = $weight.slider("option","value");
		$('#weight').find('.ui-slider-handle').text(value);
	}
});