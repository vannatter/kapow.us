<?php

App::uses('AppController', 'Controller');

/**
 * @property Publisher $Publisher
 */
class PublishersController extends AppController {
	public $name = 'Publishers';
	public $uses = array('Publisher');
	public $paginate = array(
		'Publisher' => array(
			'order' => array('Publisher.publisher_name' => 'ASC'),
			'limit' => 24,
			'contain' => array(
				'Item' => array(
					'limit' => 1,
					'order' => array('Item.created' => 'DESC'),
					'fields' => array('img_fullpath'),
				)
			)
		)
	);

	public function index() {
		$publishers = $this->paginate('Publisher');
		$this->set('publishers', $publishers);
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