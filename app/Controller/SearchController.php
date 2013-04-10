<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 */
class SearchController extends AppController {
	public $name = 'Search';
	public $uses = array('Item');

	public function index() {
	}
}