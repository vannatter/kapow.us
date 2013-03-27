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
		if($publisher = $this->Publisher->findById($id)) {
			debug($publisher);
		} else {
			echo 'not found';
		}
	}

	public function viewById($id) {
		if($publisher = $this->Publisher->findById($id)) {
			$this->redirect(sprintf('/publishers/%s', parent::seoize($id, $publisher['Publisher']['publisher_name'])), 301);
		}
	}
}