<?php

App::uses('AppController', 'Controller');

/**
 * @property Creator $Creator
 * @property Item $Item
 */
class CreatorsController extends AppController {

	public $name = 'Creators';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category','UserFavorite');
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
		if (!$creator_id) {
			$this->Session->setFlash('Creator ID not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$this->Creator->bindModel(array(
			'hasMany' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'finderQuery' => 'SELECT UserFavorite.* FROM user_favorites AS UserFavorite LEFT JOIN users AS User ON User.id = UserFavorite.user_id WHERE UserFavorite.favorite_item_id = {$__cakeID__$} AND UserFavorite.item_type = 3 AND User.private_profile = 0 ORDER BY RAND() LIMIT 25'
				)
			)
		));
		$this->Creator->UserFavorite->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'fields' => array('id', 'email', 'username')
				)
			)
		));

		$creator = $this->Creator->find(
			'first',
			array(
				'conditions' => array(
					'Creator.id' => $creator_id
				),
				'contain' => array(
					'ItemCreator' => array(
						'Item',
					),
					'UserFavorite' => array(
						'User'
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

		$this->set('meta_description_for_layout','Kapow! ' . $creator['Creator']['creator_name'] . (($creator['Creator']['creator_bio']) ? " - " . substr(str_replace('"', '', $creator['Creator']['creator_bio']),0,200) : "") );
		$this->set('meta_keywords_for_layout','Kapow, Kapow.us, Comics, Comic database, Current comics, New comics, Comic app, ' . $creator['Creator']['creator_name']); 
		$this->set('og_description','Kapow! ' . $creator['Creator']['creator_name'] . (($creator['Creator']['creator_bio']) ? " - " . substr(str_replace('"', '', $creator['Creator']['creator_bio']),0,200) : "") );


		## see if the current user (if there is one), fav'd this publisher
		if($userFav = $this->UserFavorite->findByFavoriteItemIdAndUserIdAndItemType($creator_id, $this->Auth->user('id'), 3)) {
			$this->set('userFav', true);
		} else {
			$this->set('userFav', false);
		}

		## TODO: make this prettier
		$collabs = $this->Creator->query("
		SELECT COUNT(*) as collab_count, creator_id, creators.creator_name
			FROM (
				SELECT item_creators.item_id, item_creators.creator_id
					FROM item_creators
					WHERE item_creators.item_id IN (
						SELECT DISTINCT item_creators.item_id
							FROM item_creators
							WHERE item_creators.creator_id = $creator_id
						)
					AND item_creators.creator_id != $creator_id
					GROUP BY creator_id, item_id
				) AS collabs
			LEFT JOIN creators ON (creators.id = collabs.creator_id)
			GROUP BY creator_id
			ORDER BY collab_count DESC
			LIMIT 10
		");

		$this->set('collabs', $collabs);
	}

	public function viewById($id) {
		if ($creator = $this->Creator->findById($id)) {
			$this->redirect(sprintf('/creators/%s', parent::seoize($id, $creator['Creator']['creator_name'])), 301);
		}
	}

	public function items($id) {
		if($this->request->is('ajax')) {
			$this->layout = 'blank';

			## get a list of items for the creator
			$itemList = $this->ItemCreator->find('list', array(
				'conditions' => array(
					'ItemCreator.creator_id' => $id
				),
				'fields' => array(
					'ItemCreator.item_id'
				),
				'group' => array(
					'ItemCreator.item_id'
				)
			));

			## bind the pulls table so we can place user pull items first
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
					'conditions' => array(
						'Item.id' => $itemList
					),
					'order' => array(
						'Pull.created' => 'DESC',
						'Item.created' => 'DESC'
					),
					'contain' => array(
						'Pull'
					),
					'limit' => 24
				)
			);

			$items = $this->paginate('Item');

			$this->set('items', $items);
		}
	}
}