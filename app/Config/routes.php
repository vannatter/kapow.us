<?php

	Router::connect('/', array('controller' => 'home', 'action' => 'index'));
	Router::connect('/creators/*', array('controller' => 'creators', 'action' => 'index'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
?>