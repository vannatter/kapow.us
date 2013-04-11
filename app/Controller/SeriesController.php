<?php

App::uses('AppController', 'Controller');

/**
 * @property Series $Series
 * @property Item $Item
 */
class SeriesController extends AppController {
	public $name = 'Series';
	public $uses = array('Series', 'Item');

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

	public function items($id) {
		if($this->request->is('ajax')) {
			$this->layout = 'blank';

			$this->Item->bindModel(array(
				'hasOne' => array(
					'Pull' => array(
						'conditions' => array(
							'Pull.user_id' => $this->Auth->user('id')
						)
					)
				)
			));

			$this->paginate = array(
				'Item' => array(
					'limit' => 24,
					'order' => array(
						'Item.created' => 'DESC'
					)
				)
			);

			$this->Item->recursive = 0;
			$items = $this->paginate('Item', array('Item.series_id' => $id));

			$this->set('items', $items);
		}
	}
}