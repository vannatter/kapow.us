<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

	public $name = 'Items';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category','Tag','ItemTag');
	public $paginate = array(
		'Item' => array(
			'limit' => 24,
			'order' => array('Item.id' => 'desc')
		)
	);

	public function index() {
		#$this->redirect("/items/this_week");
		#exit;

		$this->Item->recursive = 0;
		$this->set('items', $this->paginate('Item'));
	}
	
	public function detail($item_id, $item_name) {
		if (!$item_id) {
			$this->Session->setFlash('Item ID not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		#$this->Publisher->unbindModel(array('hasMany' => array('Item')), false);
		#$this->Tag->unbindModel(array('hasMany' => array('ItemTag')), false);
		#$this->ItemTag->unbindModel(array('belongsTo' => array('Item')), false);

		$this->Item->ItemCreator->Creator->bindModel(array(
			'hasOne' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'conditions' => array(
						'UserFavorite.user_id' => $this->Auth->user('id'),
						'UserFavorite.item_type' => 3
					)
				)
			)
		));

		$this->Item->Publisher->bindModel(array(
			'hasOne' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'conditions' => array(
						'UserFavorite.user_id' => $this->Auth->user('id'),
						'UserFavorite.item_type' => 4
					)
				)
			)
		));

		$this->Item->Series->bindModel(array(
			'hasOne' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'conditions' => array(
						'UserFavorite.user_id' => $this->Auth->user('id'),
						'UserFavorite.item_type' => 2
					)
				)
			)
		));

		$item = $this->Item->find('first', array(
			'conditions' => array(
				'Item.id' => $item_id
			),
			'limit' => 1,
			'contain' => array(
				'Section' => array(
					'Category'
				),
				'Publisher' => array(
					'UserFavorite'
				),
				'Series' => array(
					'UserFavorite'
				),
				'ItemCreator' => array(
					'Creator' => array(
						'UserFavorite'
					),
					'CreatorType'
				),
				'ItemTag' => array(
					'Tag'
				)
			)
		));

		if (!$item) {
			$this->Session->setFlash('Item not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}
		
		## get a distinct set of creators for the 'favorites' logic..
		$unique_creators = array();
	    foreach ($item['ItemCreator'] as $c) {
				$fav = false;

				if(isset($c['Creator']['UserFavorite']['id'])) {
					$fav = true;
				}

		    $unique_creators[$c['Creator']['id']] = array('name' => $c['Creator']['creator_name'], 'is_fav' => $fav);
	    }

		$this->set('unique_creators', $unique_creators);
		$this->set('item', $item);
		$this->set('title_for_layout', $item['Item']['item_name']);
	}

	public function next_week($content_type="1") {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Item']['publisher_id'])) {
				if(empty($data['Item']['publisher_id'])) {
					$this->redirect('/items/next_week');
				}

				$this->set('publisher_id', $data['Item']['publisher_id']);
				$this->redirect(sprintf('/items/next_week?pubid=%s', $data['Item']['publisher_id']));
			}
		}

		$first_day = date("N", strtotime("today"));
		if ($first_day < 3) {
			$release_date = date("Y-m-d", strtotime("+2 wednesdays"));
		}
		if ($first_day == 3) {
			$release_date = date("Y-m-d", strtotime("+1 week"));
		}
		if ($first_day == 4) {
			$release_date = date("Y-m-d", strtotime("+6 days"));
		}
		if ($first_day > 4) {
			$release_date = date("Y-m-d", strtotime("this wednesday"));
		}

		#$this->Publisher->unbindModel(array('hasMany' => array('Item')), false);
		#$this->Tag->unbindModel(array('hasMany' => array('ItemTag')), false);
		#$this->ItemTag->unbindModel(array('belongsTo' => array('Item')), false);

		$this->paginate = array(
			'conditions' => array(
				'Item.item_date' => $release_date,
				'Section.category_id' => $content_type
			),
			'limit' => 24,
			'contain' => array(
				'Section',
				'Publisher',
				'Series',
				'ItemCreator' => array(
					'Creator',
					'CreatorType'
				),
				'ItemTag'
			)
		);

		if(isset($this->request->query['pubid']) && $this->request->query['pubid'] != 0) {
			$this->paginate['conditions']['Item.publisher_id'] = $this->request->query['pubid'];
		}

		$items = $this->paginate('Item');

		if(!$this->request->is('ajax')) {
			$list = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'fields' => array('Publisher.publisher_name'), 'group' => array('Publisher.publisher_name'), 'contain' => array('Publisher', 'Section'), 'order' => array('Publisher.publisher_name' => 'ASC')));

			$publishers = array('0' => __('All'));
			foreach($list as $pub) {
				$publishers[$pub['Publisher']['id']] = $pub['Publisher']['publisher_name'];
			}
			$this->set('publishers', $publishers);
		}

		#$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
		$this->set('release_date_formatted', date("m/d/Y", strtotime($release_date)));
		$this->set('title_for_layout','New Next Week (' . date("m/d/Y", strtotime($release_date)) . ')');
	}

	public function this_week($content_type="1") {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Item']['publisher_id'])) {
				if(empty($data['Item']['publisher_id'])) {
					$this->redirect('/items/next_week');
				}

				$this->set('publisher_id', $data['Item']['publisher_id']);
				$this->redirect(sprintf('/items/this_week?pubid=%s', $data['Item']['publisher_id']));
			}
		}

		$first_day = date("N", strtotime("today"));
		
		if ($first_day < 3) {
			$release_date = date("Y-m-d", strtotime("this wednesday"));
		}
		if ($first_day == 3) {
			$release_date = date("Y-m-d", strtotime("today"));
		}
		if ($first_day == 4) {
			$release_date = date("Y-m-d", strtotime("yesterday"));
		}
		if ($first_day > 4) {
			$release_date = date("Y-m-d", strtotime("last wednesday") );
		}

		#$this->Publisher->unbindModel(array('hasMany' => array('Item')), false);
		#$this->Tag->unbindModel(array('hasMany' => array('ItemTag')), false);
		#$this->ItemTag->unbindModel(array('belongsTo' => array('Item')), false);

		$this->paginate = array(
			'conditions' => array(
				'Item.item_date' => $release_date,
				'Section.category_id' => $content_type
			),
			'limit' => 24,
			'contain' => array(
				'Section',
				'Publisher',
				'Series',
				'ItemCreator' => array(
					'Creator',
					'CreatorType'
				),
				'ItemTag'
			)
		);

		if(isset($this->request->query['pubid']) && $this->request->query['pubid'] != 0) {
			$this->paginate['conditions']['Item.publisher_id'] = $this->request->query['pubid'];
		}

		$items = $this->paginate('Item');

		if(!$this->request->is('ajax')) {
			$list = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'fields' => array('Publisher.publisher_name'), 'group' => array('Publisher.publisher_name'), 'contain' => array('Publisher', 'Section'), 'order' => array('Publisher.publisher_name' => 'ASC')));

			$publishers = array('0' => __('All'));
			foreach($list as $pub) {
				$publishers[$pub['Publisher']['id']] = $pub['Publisher']['publisher_name'];
			}
			$this->set('publishers', $publishers);
		}

		#$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
		$this->set('release_date_formatted', date("m/d/Y", strtotime($release_date)));
		$this->set('title_for_layout','New This Week (' . date("m/d/Y", strtotime($release_date)) . ')');
	}

	public function viewById($id) {
		if ($item = $this->Item->findById($id)) {
			$this->redirect(sprintf('/items/%s', parent::seoize($id, $item['Item']['item_name'])), 301);
		}
	}
}
?>