$(document).ready(function() {
	var hash = document.location.hash;
	if(hash) {
		$('.nav-tabs a[href='+hash+']').tab('show');
		$('html, body').animate({ scrollTop: 0 }, 'fast');
	}

	// page reload
	$('.nav-tabs a').on('shown', function (e) {
		window.location.hash = e.target.hash;
		//$('html, body').animate({ scrollTop: 0 }, 'fast');
		window.scrollTo(0, 0);
	});

	$('textarea.wysihtml').wysihtml5({
		"font-styles": true,
		"emphasis": true,
		"lists": true,
		"html": true,
		"link": true,
		"image": true,
		"useLineBreaks": false,
		events: {},
		parserRules: {
			classes: {
				"help_wrap": 1,
				"help_block": 1,
				"help_head": 1,
				"help_content": 1
			},
			tags: {
				"div": {},
				"b":  {},
				"i":  {},
				"br": {},
				"ol": {},
				"ul": {},
				"li": {},
				"h1": {},
				"h2": {},
				"u": 1,
				"p": {},
				"img": {
					"check_attributes": {
						"width": "numbers",
						"alt": "alt",
						"src": "url",
						"height": "numbers"
					}
				},
				"a":  {
					set_attributes: {
						target: "_blank",
						rel:    "nofollow"
					},
					check_attributes: {
						href:   "url" // important to avoid XSS
					}
				}
			}
		}
	});
});