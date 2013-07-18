<?php
App::uses('AppController', 'Controller');

/**
 * Class ItemsController
 *
 * @property Item $Item
 * @property UserFavorite $UserFavorite
 */
class ItemsController extends AppController {

	public $name = 'Items';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category','Tag','ItemTag', 'UserFavorite');
	public $paginate = array(
		'Item' => array(
			'limit' => 24,
			'order' => array('Item.id' => 'desc')
		)
	);

	public function index() {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Item']['terms'])) {
				if(empty($data['Item']['terms'])) {
					$this->redirect('/items');
				}

				$this->set('terms', $data['Item']['terms']);
				$this->redirect(sprintf('/items?terms=%s', $data['Item']['terms']));
			}
		}

		$this->Item->recursive = 0;

		$this->paginate = array(
			'Item' => array(
				'limit' => 24,
				'order' => array(
					'Pull.created' => 'DESC',
					'Item.id' => 'DESC',
				)
			)
		);

		if(isset($this->request->query['terms'])) {
			$terms = $this->request->query['terms'];

			$con = array(
				'OR' => array(
					'Item.item_name LIKE' => '%' . $terms . '%',
					'Item.description LIKE' => '%' . $terms . '%'
				)
			);

			$this->Item->bindModel(array(
				'hasOne' => array(
					'Pull' => array(
						'conditions' => array(
							'Pull.user_id' => $this->Auth->user('id')
						)
					)
				)
			));

			$items = $this->paginate('Item', $con);
		} else {
			$this->Item->bindModel(array(
				'hasOne' => array(
					'Pull' => array(
						'conditions' => array(
							'Pull.user_id' => $this->Auth->user('id')
						)
					)
				)
			));

			$items = $this->paginate('Item');
		}

		$this->set('items', $items);
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

		$this->Item->bindModel(array(
			'hasMany' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'conditions' => array(
						'item_type' => 1
					),
					'limit' => 25,
					'order' => 'RAND()'
				)
			)
		));
		$this->Item->UserFavorite->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'fields' => array('id', 'email', 'username')
				)
			)
		));

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
				),
				'Pull',
				'UserItem',
				'UserFavorite' => array(
					'User'
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

		$this->set('meta_description_for_layout','Kapow! ' . $item['Item']['item_name'] . ' - ' . substr(str_replace('"', '', $item['Item']['description']),0,200));
		$this->set('meta_keywords_for_layout','Kapow, Kapow.us, Comics, Comic database, Current comics, New comics, Comic app, ' . $item['Item']['item_name'] . ',' . $item['Series']['series_name']); 
		$this->set('og_description','Kapow! ' . $item['Item']['item_name'] . ' - ' . substr(str_replace('"', '', $item['Item']['description']),0,200));
		
	}

	public function next_week($content_type="1") {
		if($this->request->ext == 'json') {
			$result = array('error' => false);

			$release_date = $this->_getReleaseDate('next_week');

			## get a list of publishers for the given date
			$publishers = $this->Item->find('all', array(
				'conditions' => array(
					'Item.item_date' => $release_date,
					'Section.category_id' => $content_type,
				),
				'fields' => array(
					'Item.publisher_id'
				),
				'group' => array(
					'publisher_id'
				),
				'contain' => array(
					'Publisher' => array(
						'fields' => array(
							'publisher_name'
						)
					),
					'Section'
				)
			));

			## get a list of the current users favorite creators, if logged in
			if($this->Auth->user()) {
				$userFavCreators = $this->UserFavorite->find('list', array(
					'conditions' => array(
						'UserFavorite.user_id' => $this->Auth->user('id'),
						'UserFavorite.item_type' => 3
					),
					'fields' => array(
						'favorite_item_id'
					)
				));
			} else {
				$userFavCreators = array();
			}

			$data = array('thumbs' => array('large' => '_50p.jpg', 'small' => '_25p.jpg'));

			foreach($publishers as $pub) {
				$pubId = $pub['Publisher']['id'];

				$this->Item->bindModel(array(
					'hasOne' => array(
						'Pull' => array(
							'conditions' => array(
								'Pull.user_id' => $this->Auth->user('id')
							)
						)
					)
				));

				$items = $this->Item->find('all', array(
					'conditions' => array(
						'Item.item_date' => $release_date,
						'Section.category_id' => $content_type,
						'Item.publisher_id' => $pubId
					),
					'order' => array(
						'Pull.created' => 'DESC',
						'Item.series_id' => 'DESC'
					),
					'fields' => array(
						'id', 'item_name', 'description', 'img_fullpath'
					),
					'contain' => array(
						'Section' => array(
							'fields' => array(
								'section_name'
							)
						),
						'Publisher' => array(
							'fields' => array(
								'publisher_name'
							)
						),
						'Series' => array(
							'fields' => array(
								'series_name'
							)
						),
						'ItemCreator' => array(
							'Creator' => array(
								'fields' => array(
									'creator_name'
								)
							),
							'CreatorType' => array(
								'fields' => array(
									'creator_short_name',
									'creator_type_name'
								)
							),
							'fields' => array(
								'id'
							)
						),
						'ItemTag',
						'Pull'
					)
				));

				if($items) {
					$data['publishers'][] = array(
						'publisher_id' => $pubId,
						'publisher_name' => $pub['Publisher']['publisher_name'],
						'items' => $items,
						'item_count' => count($items)
					);

					$favItems = $this->Item->ItemCreator->find('all', array(
						'conditions' => array(
							'Item.item_date' => $release_date,
							'Item.publisher_id' => $pubId,
							'ItemCreator.creator_id' => $userFavCreators
						),
						'group' => array(
							'Item.id'
						)
					));

					if($favItems) {
						foreach($favItems as $fav) {
							$data['favorites'][$fav['ItemCreator']['id']][] = array(
								'fav_name' => $fav['Creator']['creator_name'],
								'item' => array(
									'name' => $fav['Item']['item_name'],
									'id' => $fav['Item']['id'],
									'img_fullpath' => $fav['Item']['img_fullpath']
								)
							);
						}
					}
				}
			}

			if(@$data['publishers']) {
				$result['data'] = $data;
				$result['status'] = array(
					'status_code' => 200,
					'status_message' => ''
				);
			} else {
				$result['status'] = array(
					'status_code' => 204,
					'status_message' => ''
				);
			}

			return new CakeResponse(array('body' => json_encode($result)));
		}

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

		$release_date = $this->_getReleaseDate('next_week');

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
			'conditions' => array(
				'Item.item_date' => $release_date,
				'Section.category_id' => $content_type
			),
			'order' => array(
				'Pull.created' => 'DESC',
				'Item.series_id' => 'DESC'
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
				'ItemTag',
				'Pull'
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
		if($this->request->ext == 'json') {
			$result = array('error' => false);

			$release_date = $this->_getReleaseDate('this_week');

			## get a list of publishers for the given date
			$publishers = $this->Item->find('all', array(
				'conditions' => array(
					'Item.item_date' => $release_date,
					'Section.category_id' => $content_type,
				),
				'fields' => array(
					'Item.publisher_id'
				),
				'group' => array(
					'publisher_id'
				),
				'contain' => array(
					'Publisher' => array(
						'fields' => array(
							'publisher_name'
						)
					),
					'Section'
				)
			));

			## get a list of the current users favorite creators, if logged in
			if($this->Auth->user()) {
				$userFavCreators = $this->UserFavorite->find('list', array(
					'conditions' => array(
						'UserFavorite.user_id' => $this->Auth->user('id'),
						'UserFavorite.item_type' => 3
					),
					'fields' => array(
						'favorite_item_id'
					)
				));
			} else {
				$userFavCreators = array();
			}

			$data = array('thumbs' => array('large' => '_50p.jpg', 'small' => '_25p.jpg'), 'favorites' => array());

			foreach($publishers as $pub) {
				$pubId = $pub['Publisher']['id'];

				$this->Item->bindModel(array(
					'hasOne' => array(
						'Pull' => array(
							'conditions' => array(
								'Pull.user_id' => $this->Auth->user('id')
							)
						)
					)
				));

				$items = $this->Item->find('all', array(
					'conditions' => array(
						'Item.item_date' => $release_date,
						'Section.category_id' => $content_type,
						'Item.publisher_id' => $pubId
					),
					'order' => array(
						'Pull.created' => 'DESC',
						'Item.series_id' => 'DESC'
					),
					'fields' => array(
						'id', 'item_name', 'description', 'img_fullpath'
					),
					'contain' => array(
						'Section' => array(
							'fields' => array(
								'section_name'
							)
						),
						'Publisher' => array(
							'fields' => array(
								'publisher_name'
							)
						),
						'Series' => array(
							'fields' => array(
								'series_name'
							)
						),
						'ItemCreator' => array(
							'Creator' => array(
								'fields' => array(
									'creator_name'
								)
							),
							'CreatorType' => array(
								'fields' => array(
									'creator_short_name',
									'creator_type_name'
								)
							),
							'fields' => array(
								'id'
							)
						),
						'ItemTag',
						'Pull'
					)
				));

				if($items) {
					$data['publishers'][] = array(
						'publisher_id' => $pubId,
						'publisher_name' => $pub['Publisher']['publisher_name'],
						'items' => $items,
						'item_count' => count($items)
					);

					$favItems = $this->Item->ItemCreator->find('all', array(
						'conditions' => array(
							'Item.item_date' => $release_date,
							'Item.publisher_id' => $pubId,
							'ItemCreator.creator_id' => $userFavCreators
						),
						'group' => array(
							'Item.id'
						)
					));

					if($favItems) {
						foreach($favItems as $fav) {
							$data['favorites'][$fav['ItemCreator']['id']][] = array(
								'fav_name' => $fav['Creator']['creator_name'],
								'item' => array(
									'name' => $fav['Item']['item_name'],
									'id' => $fav['Item']['id'],
									'img_fullpath' => $fav['Item']['img_fullpath']
								)
							);
						}
					}
				}
			}

			if(@$data['publishers']) {
				$result['data'] = $data;
				$result['status'] = array(
					'status_code' => 200,
					'status_message' => ''
				);
			} else {
				$result['status'] = array(
					'status_code' => 204,
					'status_message' => ''
				);
			}

			return new CakeResponse(array('body' => json_encode($result)));
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['Item']['publisher_id'])) {
				if(empty($data['Item']['publisher_id'])) {
					$this->redirect('/items/this_week');
				}

				$this->set('publisher_id', $data['Item']['publisher_id']);
				$this->redirect(sprintf('/items/this_week?pubid=%s', $data['Item']['publisher_id']));
			}
		}

		$release_date = $this->_getReleaseDate();

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
			'conditions' => array(
				'Item.item_date' => $release_date,
				'Section.category_id' => $content_type
			),
			'order' => array(
				'Pull.created' => 'DESC',
				'Item.series_id' => 'DESC'
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
				'ItemTag',
				'Pull'
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

	public function listByDate($date=null) {
		if(!$date) {
			$date = date('Y-m-d', strtotime('NOW'));
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$pubid = "";
			$terms = "";

			if(isset($data['Item']['publisher_id'])) {
				$pubid = $data['Item']['publisher_id'];
			}

			if(isset($data['Item']['terms'])) {
				$terms = $data['Item']['terms'];
			}

			$query = "";
			if(!empty($pubid)) {
				$this->set('publisher_id', $data['Item']['publisher_id']);
				$query = sprintf("?pubid=%s", $pubid);
			}

			if(!empty($terms)) {
				$this->set('terms', $data['Item']['terms']);

				if(empty($query)) {
					$query = sprintf("?terms=%s", $terms);
				} else {
					$query .= sprintf('&terms=%s', $terms);
				}
			}

			$this->redirect(sprintf('/items/date/%s%s', $date, $query));
		}

		if(strtoupper(date('l', strtotime($date))) == 'WEDNESDAY') {
			## date passed is a wednesday, no need to do extra work
		} else {
			## date passed wasn't a wednesday, get the next wednesday after date to start with
			$date = date('Y-m-d', strtotime('next Wednesday'));
		}

		$previous = date('Y-m-d', strtotime('last Wednesday', strtotime($date)));
		$next = date('Y-m-d', strtotime('next Wednesday', strtotime($date)));

		$this->set('dateCurrent', $date);
		$this->set('dateNext', $next);
		$this->set('datePrevious', $previous);

		$this->Item->recursive = 0;

		$this->paginate = array(
			'Item' => array(
				'limit' => 24,
				'order' => array(
					'Pull.created' => 'DESC',
					'Item.id' => 'DESC'
				)
			)
		);

		$con = array(
			'AND' => array(
				'Item.item_date' => $date
			)
		);

		if(isset($this->request->query['terms'])) {
			$terms = $this->request->query['terms'];

			$con['OR'] = array(
				'Item.item_name LIKE' => '%' . $terms . '%',
				'Item.description LIKE' => '%' . $terms . '%'
			);
		}

		$this->Item->bindModel(array(
			'hasOne' => array(
				'Pull' => array(
					'conditions' => array(
						'Pull.user_id' => $this->Auth->user('id')
					)
				)
			)
		));

		if(isset($this->request->query['pubid']) && $this->request->query['pubid'] != 0) {
			$con['AND']['Item.publisher_id'] = $this->request->query['pubid'];
		}

		$items = $this->paginate('Item', $con);

		$this->set('items', $items);

		if(!$this->request->is('ajax')) {
			$list = $this->Item->find('all', array('conditions' => array('Item.item_date' => $date), 'fields' => array('Publisher.publisher_name'), 'group' => array('Publisher.publisher_name'), 'contain' => array('Publisher', 'Section'), 'order' => array('Publisher.publisher_name' => 'ASC')));

			$publishers = array('0' => __('All'));
			foreach($list as $pub) {
				$publishers[$pub['Publisher']['id']] = $pub['Publisher']['publisher_name'];
			}
			$this->set('publishers', $publishers);
		}
		
		$this->set('title_for_layout','Items by Date (' . date("m/d/Y", strtotime($date)) . ')');
		$this->set('release', date("m/d/Y", strtotime($date)));
		
	}

	private function _getReleaseDate($type='this_week') {
		$first_day = date("N", strtotime("today"));
		$release_date = date("Y-m-d", strtotime("today"));

		switch(strtolower($type)) {
			case 'this_week':
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
				break;
			case 'next_week':
				$release_date = date("Y-m-d", strtotime("+1 week"));

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
				break;
		}

		return $release_date;
	}
}