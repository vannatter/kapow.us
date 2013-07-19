<?php

Router::mapResources(array('User'));
Router::parseExtensions();

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

Router::connect(
	'/items/date/*',
	array('controller' => 'items', 'action' => 'listByDate')
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

Router::connect(
	'/my/favorite/publishers',
	array('controller' => 'users', 'action' => 'favoritePublishers')
);

Router::connect(
	'/my/favorite/items',
	array('controller' => 'users', 'action' => 'favoriteItems')
);

Router::connect(
	'/my/favorite/creators',
	array('controller' => 'users', 'action' => 'favoriteCreators')
);

Router::connect(
	'/my/favorite/series',
	array('controller' => 'users', 'action' => 'favoriteSeries')
);

Router::connect(
	'/my/favorite/shops',
	array('controller' => 'users', 'action' => 'favoriteShops')
);

Router::connect(
	'/my/profile/edit',
	array('controller' => 'users', 'action' => 'profileEdit')
);

Router::connect(
	'/my/profile/public',
	array('controller' => 'users', 'action' => 'profilePublic')
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

##### FLAGS
Router::connect(
	'/flag/item/:id',
	array('controller' => 'flags', 'action' => 'item'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/flag/creator/:id',
	array('controller' => 'flags', 'action' => 'creator'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/flag/series/:id',
	array('controller' => 'flags', 'action' => 'series'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/flag/publisher/:id',
	array('controller' => 'flags', 'action' => 'publisher'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/flag/store/:id',
	array('controller' => 'flags', 'action' => 'shop'),
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

Router::connect('/profile/*', array('controller' => 'profile', 'action' => 'index'));

## static maps
Router::connect('/random_item', array('controller' => 'home', 'action' => 'random_item'));
Router::connect('/tos', array('controller' => 'home', 'action' => 'tos'));
Router::connect('/privacy-policy', array('controller' => 'home', 'action' => 'privacy'));
Router::connect('/contact-us', array('controller' => 'home', 'action' => 'contact'));
Router::connect('/about-us', array('controller' => 'home', 'action' => 'about'));
Router::connect('/submit-contact', array('controller' => 'home', 'action' => 'contact_submit'));

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
	'/admin/stores/new',
	array('controller' => 'admin', 'action' => 'storesNew')
);

Router::connect(
	'/admin/stores/new/view/:id',
	array('controller' => 'admin', 'action' => 'storesNewView'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/stores/new/set/:id',
	array('controller' => 'admin', 'action' => 'storesNewSet'),
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
	'/admin/reports/cancel/:id',
	array('controller' => 'admin', 'action' => 'reportsCancel'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/reports/close/:id',
	array('controller' => 'admin', 'action' => 'reportsClose'),
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

Router::connect(
	'/admin/flags/view/:id',
	array('controller' => 'admin', 'action' => 'flagsView'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/flags/cancel/:id',
	array('controller' => 'admin', 'action' => 'flagsCancel'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/flags/close/:id',
	array('controller' => 'admin', 'action' => 'flagsClose'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/blog/imageUpload',
	array('controller' => 'admin', 'action' => 'blogsImageUpload')
);

Router::connect(
	'/admin/userActivity/details/:id',
	array('controller' => 'admin', 'action' => 'userActivityDetails'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/userActivity/details/:uid/:id',
	array(
		'controller' => 'admin',
		'action' => 'userActivityRowDetail'
	),
	array(
		'pass' => array('uid', 'id'),
		'uid' => '[0-9]+',
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/improvements/view/:id',
	array('controller' => 'admin', 'action' => 'improvementsView'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/improvements/cancel/:id',
	array('controller' => 'admin', 'action' => 'improvementsCancel'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/improvements/accept',
	array('controller' => 'admin', 'action' => 'improvementsAccept')
);

Router::connect(
	'/admin/improvements/decline',
	array('controller' => 'admin', 'action' => 'improvementsDecline')
);

Router::connect(
	'/admin/publishers/unlock/:id',
	array('controller' => 'admin', 'action' => 'publishersUnlock'),
	array(
		'pass' => array('id'),
		'id' => '[0-9]+'
	)
);

Router::connect(
	'/admin/appMessages/new',
	array('controller' => 'admin', 'action' => 'appMessagesNew')
);

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
?>