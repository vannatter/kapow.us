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
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Publisher']['terms'])) {
				if(empty($data['Publisher']['terms'])) {
					$this->redirect('/publishers');
				}

				$this->set('terms', $data['Publisher']['terms']);
				$this->redirect(sprintf('/publishers?terms=%s', $data['Publisher']['terms']));
			}
		}

		if(isset($this->request->query['terms'])) {
			$terms = $this->request->query['terms'];

			$con = array(
				'OR' => array(
					'Publisher.publisher_name LIKE' => '%' . $terms . '%',
					'Publisher.publisher_bio LIKE' => '%' . $terms . '%'
				)
			);

			$publishers = $this->paginate('Publisher', $con);
		} else {
			$publishers = $this->paginate('Publisher');
		}

		$this->set('publishers', $publishers);
	}

	public function view($id, $name) {
		if ($publisher = $this->Publisher->findById($id)) {
			$this->set('publisher', $publisher);
			$this->set('title_for_layout', ucwords(strtolower($publisher['Publisher']['publisher_name'])));
		} else {
			$this->Session->setFlash('Publisher not found!', 'flash_neg');
			$this->redirect("/");
			exit;
		}
	}

	public function viewById($id) {
		if ($publisher = $this->Publisher->findById($id)) {
			$this->redirect(sprintf('/publishers/%s', parent::seoize($id, $publisher['Publisher']['publisher_name'])), 301);
		}
	}
}