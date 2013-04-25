<?php

App::uses('AppController', 'Controller');

/**
 * @property Series $Series
 * @property Item $Item
 * @property UserFavorite $UserFavorite
 */
class SeriesController extends AppController {
	public $name = 'Series';
	public $uses = array('Series', 'Item', 'UserFavorite');
	public $paginate = array(
		'Series' => array(
			'limit' => 24,
			'order' => array(
				'Series.created' => 'DESC'
			)
		)
	);

	public function index() {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Series']['terms'])) {
				if(empty($data['Series']['terms'])) {
					$this->redirect('/series');
				}

				$this->set('terms', $data['Series']['terms']);
				$this->redirect(sprintf('/series?terms=%s', $data['Series']['terms']));
			}
		}

		$this->Series->bindModel(array('hasMany' => array('Item' => array('foreignKey' => 'series_id', 'order' => 'RAND()', 'limit' => 1))));

		$this->paginate['Series']['contain'] = array(
			'Item' => array(
				'fields' => array(
					'Item.img_fullpath'
				)
			)
		);

		if(isset($this->request->query['terms'])) {
			$terms = $this->request->query['terms'];

			$con = array(
				'OR' => array(
					'Series.series_name LIKE' => '%' . $terms . '%',
				)
			);

			$series = $this->paginate('Series', $con);
		} else {
			$series = $this->paginate('Series');
		}

		$this->set('series', $series);
	}

	public function view($id, $name) {
		if($series = $this->Series->findById($id)) {
			$this->set('series', $series);
			$this->set('title_for_layout', ucwords(strtolower($series['Series']['series_name'])));

			## see if the current user (if there is one), fav'd this publisher
			if($userFav = $this->UserFavorite->findByFavoriteItemIdAndUserIdAndItemType($id, $this->Auth->user('id'), 2)) {
				$this->set('userFav', true);
			} else {
				$this->set('userFav', false);
			}
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