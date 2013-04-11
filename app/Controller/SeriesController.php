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
			$this->set('series', $series);
			$this->set('title_for_layout', ucwords(strtolower($series['Series']['series_name'])));
			
			// jon to override
			$this->set('userFav', false);
		} else {
			$this->Session->setFlash('Series not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}
	}

	public function viewById($id) {
		if($series = $this->Series->findById($id)) {
			$this->redirect(sprintf('/series/%s', parent::seoize($id, $series['Series']['series_name'])), 301);
		}
	}
}