<?php

App::uses('AppController', 'Controller');

/**
 * @property Series $Series
 */
class SeriesController extends AppController {
	public $name = 'Series';
	public $uses = array('Series');

	public function index() {
	}

	public function view($id, $name) {
		if($series = $this->Series->findById($id)) {
			debug($series);
		} else {
			echo 'not found';
		}
	}

	public function viewById($id) {
		if($series = $this->Series->findById($id)) {
			$this->redirect(sprintf('/series/%s', parent::seoize($id, $series['Series']['series_name'])), 301);
		}
	}
}