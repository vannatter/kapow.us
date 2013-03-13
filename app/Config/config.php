<?
	$config['Settings'] = array(
  	
  		'site_mode' => 2,	// 1 = online (live), 0 = offline (maintenance), 2 = development (debug on), 9 = beta (redirect to beta login / checker)
    	'site_url' => '',
    	'Email' => array(
      		'noreply' => 'noreply@kapow.biz'
    	),
    	'root_domain' => 'http://www.previewsworld.com',
    	'root_domain_path' => '/Home/1/1/71/',
    	'icon_path' => '/Users/dustin/documents/workspace/kapow.biz/app/webroot/img/covers',
    	'icon_web_path' => '/img/covers',
			'API' => array(
				'google' => array(
					'key' => 'AIzaSyClOyMOup8oRCO_g9sl82pIHePtosMA7w8',
					'places_url' => 'https://maps.googleapis.com/maps/api/place/textsearch/json?query=%s&key=%s&sensor=false&types=book_store',
					'details_url' => 'https://maps.googleapis.com/maps/api/place/details/json?reference=%s&sensor=false&key=%s',
				)
			)
  	);
?>