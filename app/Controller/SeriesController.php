<?php

App::uses('AppController', 'Controller');

/**
 * SeriesController class.
 * 
 * @extends AppController
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
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if (isset($data['Series']['terms'])) {
				if (empty($data['Series']['terms'])) {
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

		if (isset($this->request->query['terms'])) {
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
		if (!$id) {
			$this->Session->setFlash('Series not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$this->Series->bindModel(array(
			'hasMany' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'finderQuery' => 'SELECT UserFavorite.* FROM user_favorites AS UserFavorite LEFT JOIN users AS User ON User.id = UserFavorite.user_id WHERE UserFavorite.favorite_item_id = {$__cakeID__$} AND UserFavorite.item_type = 2 AND User.private_profile = 0 ORDER BY RAND() LIMIT 25'
				),
			)
		));
		
		$this->Series->UserFavorite->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'conditions' => array('User.private_profile' => false),
					'fields' => array('id', 'email', 'username', 'private_profile')
				)
			)
		));

		$this->Series->bindModel(array(
			'hasMany' => array(
				'Item' => array(
					'foreignKey' => 'series_id',
					'order' => 'RAND()',
					'limit' => 1
				)
			)
		));

		$series = $this->Series->find(
			'first',
			array(
				'conditions' => array(
					'Series.id' => $id
				),
				'contain' => array(
					'UserFavorite' => array(
						'User'
					),
					'Item'
				)
			)
		);

		if (!$series) {
			$this->Session->setFlash('Series not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$this->set('series', $series);
		$this->set('title_for_layout', ucwords(strtolower($series['Series']['series_name'])));

		## see if the current user (if there is one), fav'd this publisher
		if ($userFav = $this->UserFavorite->findByFavoriteItemIdAndUserIdAndItemType($id, $this->Auth->user('id'), 2)) {
			$this->set('userFav', true);
		} else {
			$this->set('userFav', false);
		}
	}

	public function viewById($id) {
		if ($series = $this->Series->findById($id)) {
			$this->redirect(sprintf('/series/%s', parent::seoize($id, $series['Series']['series_name'])), 301);
		}
	}

	public function items($id) {
		if ($this->request->is('ajax')) {
			$this->layout = 'blank';

			$this->Item->bindModel(array(
				'hasOne' => array(
					'Pull' => array(
						'conditions' => array(
							'Pull.user_id' => $this->Auth->user('id')
						)
					),
					'UserItem' => array(
						'conditions' => array(
							'UserItem.user_id' => $this->Auth->user('id')
						)
					),
					'ItemUserFavorite' => array(
						'conditions' => array(
							'ItemUserFavorite.user_id' => $this->Auth->user('id')
						)
					)
				)
			));

			$this->paginate = array(
				'Item' => array(
					'limit' => 24,
					'order' => array(
						'Pull.created' => 'DESC',
						'ItemUserFavorite.created' => 'DESC',
						'Item.created' => 'DESC'
					),
					'group' => array(
						'Item.id'
					),
					'contain' => array(
						'Pull',
						'UserItem',
						'ItemUserFavorite'
					)
				)
			);

			$this->Item->recursive = 0;
			$items = $this->paginate('Item', array('Item.series_id' => $id));

			$this->set('items', $items);
		}
	}
}