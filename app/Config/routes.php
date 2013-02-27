<?php

	Router::connect('/', array('controller' => 'home', 'action' => 'index'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
?>