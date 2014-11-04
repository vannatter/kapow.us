<?php

App::uses('AppController', 'Controller');

/**
 * @property Publisher $Publisher
 * @property Item $Item
 * @property UserFavorite $UserFavorite
 */
class PublishersController extends AppController {
	public $name = 'Publishers';
	public $uses = array('Publisher', 'Item', 'UserFavorite');
	public $paginate = array(
		'Publisher' => array(
			'order' => array('Publisher.weight' => 'DESC', 'Publisher.publisher_name' => 'ASC'),
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
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if (isset($data['Publisher']['terms'])) {
				if (empty($data['Publisher']['terms'])) {
					$this->redirect('/publishers');
				}

				$this->set('terms', $data['Publisher']['terms']);
				$this->redirect(sprintf('/publishers?terms=%s', $data['Publisher']['terms']));
			}
		}

		if (isset($this->request->query['terms'])) {
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
		if (!$id) {
			$this->Session->setFlash('Publisher ID not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$this->Publisher->bindModel(array(
			'hasMany' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'finderQuery' => 'SELECT UserFavorite.* FROM user_favorites AS UserFavorite LEFT JOIN users AS User ON User.id = UserFavorite.user_id WHERE UserFavorite.favorite_item_id = {$__cakeID__$} AND UserFavorite.item_type = 4 AND User.private_profile = 0 ORDER BY RAND() LIMIT 25'
				)
			)
		));
		$this->Publisher->UserFavorite->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'fields' => array('id', 'email', 'username')
				)
			)
		));

		$publisher = $this->Publisher->find(
			'first',
			array(
				'conditions' => array(
					'Publisher.id' => $id
				),
				'contain' => array(
					'Item',
					'UserFavorite' => array(
						'User'
					)
				),
			)
		);

		if (!$publisher) {
			$this->Session->setFlash('Publisher not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$this->set('publisher', $publisher);
		$this->set('title_for_layout', ucwords(strtolower($publisher['Publisher']['publisher_name'])));

		$this->set('meta_description_for_layout','Kapow! ' . $publisher['Publisher']['publisher_name'] . (($publisher['Publisher']['publisher_bio']) ? " - " . substr(str_replace('"', '', $publisher['Publisher']['publisher_bio']),0,200) : " - Comics Publisher listed on Kapow!") );
		$this->set('meta_keywords_for_layout','Kapow, Kapow.us, Comics, Comic database, Current comics, New comics, Comic app, ' . $publisher['Publisher']['publisher_name']); 
		$this->set('og_description','Kapow! ' . $publisher['Publisher']['publisher_name'] . (($publisher['Publisher']['publisher_bio']) ? " - " . substr(str_replace('"', '', $publisher['Publisher']['publisher_bio']),0,200) : " - Comics Publisher listed on Kapow!") );

		## see if the current user (if there is one), fav'd this publisher
		if ($userFav = $this->UserFavorite->findByFavoriteItemIdAndUserIdAndItemType($id, $this->Auth->user('id'), 4)) {
			$this->set('userFav', true);
		} else {
			$this->set('userFav', false);
		}
	}

	public function viewById($id) {
		if ($publisher = $this->Publisher->findById($id)) {
			$this->redirect(sprintf('/publishers/%s', parent::seoize($id, $publisher['Publisher']['publisher_name'])), 301);
		}
	}

	public function items($id) {
		if ($this->request->is('ajax')) {
			$this->layout = 'blank';

			$this->paginate = array(
				'Item' => array(
					'limit' => 16,
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
						'ItemUserFavorite'
					)
				)
			);

			$this->Item->bindModel(array(
				'hasOne' => array(
					'Pull' => array(
						'conditions' => array(
							'Pull.user_id' => $this->Auth->user('id')
						)
					),
					'ItemUserFavorite' => array(
						'conditions' => array(
							'ItemUserFavorite.user_id' => $this->Auth->user('id')
						)
					)
				)
			));

			$this->Item->recursive = 0;
			$items = $this->paginate('Item', array('Item.publisher_id' => $id));

			$this->set('items', $items);
		}
	}
}