<?php

App::uses('AppController', 'Controller');

class CreatorsController extends AppController {

	public $name = 'Creators';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category');
	public $paginate = array(
		'Creator' => array(
			'order' => array('Creator.creator_name' => 'ASC'),
			'limit' => 24,
			'contain' => array(
				'ItemCreator' => array(
					'Item',
					'limit' => 1,
					'order' => array('ItemCreator.created' => 'DESC')
				)
			)
		)
	);

	public function index() {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Creator']['terms'])) {
				if(empty($data['Creator']['terms'])) {
					$this->redirect('/creators');
				}

				$this->set('terms', $data['Creator']['terms']);
				$this->redirect(sprintf('/creators?terms=%s', $data['Creator']['terms']));
			}
		}

		if(isset($this->request->query['terms'])) {
			$terms = $this->request->query['terms'];

			$con = array(
				'OR' => array(
					'Creator.creator_name LIKE' => '%' . $terms . '%',
					'Creator.creator_bio LIKE' => '%' . $terms . '%'
				)
			);

			$creators = $this->paginate('Creator', $con);
		} else {
			$creators = $this->paginate('Creator');
		}

		$this->set('creators', $creators);
	}

	public function view($creator_id, $creator_name) {
		##$creator_parts = @explode("--", $creator_string);
		##$creator_id = $creator_parts[0];

		if (!$creator_id) {
			$this->Session->setFlash('Creator ID not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$creator = $this->Creator->find(
			'first',
			array(
				'conditions' => array(
					'Creator.id' => $creator_id
				),
				'contain' => array(
					'ItemCreator' => array(
						'Item'
					)
				),
			)
		);

		if (!$creator) {
			$this->Session->setFlash('Creator not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}
		
		$this->set('creator', $creator);
		$this->set('title_for_layout', $creator['Creator']['creator_name']);

	}

	public function viewById($id) {
		if($creator = $this->Creator->findById($id)) {
			$this->redirect(sprintf('/creators/%s', parent::seoize($id, $creator['Creator']['creator_name'])), 301);
		}
	}
}
?>