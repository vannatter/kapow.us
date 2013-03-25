<?php

App::uses('AppController', 'Controller');

/**
 * @property Publisher $Publisher
 */
class PublishersController extends AppController {
	public $name = 'Publishers';
	public $uses = array('Publisher');

	public function index() {
	}

	public function view($id, $name) {
		if($series = $this->Publisher->findById($id)) {
			debug($series);
		} else {
			echo 'not found';
		}
	}
}