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

##### USERS/MY
Router::connect(
	'/my',
	array('controller' => 'users', 'action' => 'profile')
);

Router::connect(
	'/my/pull_list',
	array('controller' => 'users', 'action' => 'pull_list')
);

Router::connect(
	'/my/pull_list_process/:answer/:id',
	array('controller' => 'users', 'action' => 'pull_list_process'),
	array(
		'pass' => array('answer', 'id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/my/library',
	array('controller' => 'users', 'action' => 'library')
);


##### REPORT/REPORTS
Router::connect(
	'/report/item/:id',
	array('controller' => 'reports', 'action' => 'item'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/report/creator/:id',
	array('controller' => 'reports', 'action' => 'creator'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/report/series/:id',
	array('controller' => 'reports', 'action' => 'series'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/report/publisher/:id',
	array('controller' => 'reports', 'action' => 'publisher'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/report/store/:id',
	array('controller' => 'reports', 'action' => 'shop'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

##### BLOGS
Router::connect(
	'/blogs/:id--:name',
	array('controller' => 'blogs', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/blogs/:id',
	array('controller' => 'blogs', 'action' => 'viewById'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/blog',
	array('controller' => 'blogs')
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
	'/admin/creators/unlock/:id',
	array('controller' => 'admin', 'action' => 'creatorsUnlock'),
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

Router::connect(
	'/admin/stores/deletePhoto/:id',
	array('controller' => 'admin', 'action' => 'storesDeletePhoto'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/stores/setPrimaryPhoto',
	array('controller' => 'admin', 'action' => 'storesSetPrimaryPhoto'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/stores/photoQueue',
	array('controller' => 'admin', 'action' => 'storesPhotoQueue')
);

Router::connect(
	'/admin/stores/photo/allow/:id',
	array('controller' => 'admin', 'action' => 'storesPhotoAllow'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/stores/photo/delete/:id',
	array('controller' => 'admin', 'action' => 'storesPhotoDelete'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/reports/view/:id',
	array('controller' => 'admin', 'action' => 'reportsView'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/blogs/add',
	array('controller' => 'admin', 'action' => 'blogsAdd')
);

Router::connect(
	'/admin/blogs/edit/:id',
	array('controller' => 'admin', 'action' => 'blogsEdit'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/blogs/delete/:id',
	array('controller' => 'admin', 'action' => 'blogsDelete'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
?>