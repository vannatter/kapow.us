<?php

	Router::connect('/', array('controller' => 'home', 'action' => 'index'));

Router::connect(
	'/series/:id--:name',
	array('controller' => 'series', 'action' => 'view'),
	array(
		'pass' => array('id', 'name'),
		'id' => '[0-9]+'
	)
);

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
?>