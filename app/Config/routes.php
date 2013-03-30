<?php

	Router::connect('/', array('controller' => 'home', 'action' => 'index'));

##### SERIES
Router::connect(
	'/series/:id--:name',
	array('controller' => 'series', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);
Router::connect(
	'/series/:id',
	array('controller' => 'series', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### ITEMS
Router::connect(
	'/items/:id--:name',
	array('controller' => 'items', 'action' => 'detail'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);
Router::connect(
	'/items/:id',
	array('controller' => 'items', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### CREATORS
Router::connect(
	'/creators/:id--:name',
	array('controller' => 'creators', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);
Router::connect(
	'/creators/:id',
	array('controller' => 'creators', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### PUBLISHERS
Router::connect(
	'/publishers/:id--:name',
	array('controller' => 'publishers', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);
Router::connect(
	'/publishers/:id',
	array('controller' => 'publishers', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### SHOPS
Router::connect(
	'/shops/:id--:name',
	array('controller' => 'shops', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);
Router::connect(
	'/shops/:id',
	array('controller' => 'shops', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### TAGS
Router::connect(
	'/tags/:id--:name',
	array('controller' => 'tags', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);
Router::connect(
	'/tags/:id',
	array('controller' => 'tags', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### ADMIN
Router::connect(
	'/admin/items/edit/:id',
	array('controller' => 'admin', 'action' => 'itemsEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/categories/edit/:id',
	array('controller' => 'admin', 'action' => 'categoriesEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/creators/edit/:id',
	array('controller' => 'admin', 'action' => 'creatorsEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/creatorTypes/edit/:id',
	array('controller' => 'admin', 'action' => 'creatorTypesEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/publishers/edit/:id',
	array('controller' => 'admin', 'action' => 'publishersEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/series/edit/:id',
	array('controller' => 'admin', 'action' => 'seriesEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/stores/edit/:id',
	array('controller' => 'admin', 'action' => 'storesEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/users/edit/:id',
	array('controller' => 'admin', 'action' => 'usersEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/sections/edit/:id',
	array('controller' => 'admin', 'action' => 'sectionsEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
?>