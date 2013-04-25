<?php

App::uses('AppController', 'Controller');

/**
 * @property User $User
 * @property Pull $Pull
 * @property UserItem $UserItem
 * @property UserFavorite $UserFavorite
 */
class UsersController extends AppController {
	public $name = 'Users';
	public $uses = array('User', 'Pull', 'UserItem', 'UserFavorite');

	public function index() {
	}

	public function register() {
		if ($this->Auth->user()) {
			$this->redirect('/');
			exit;
		}

		if ($this->request->is('post')) {
			$data = Sanitize::clean($this->request->data);

			if ($this->User->save($data)) {
				$this->Session->setFlash('User registration successful!', 'flash_pos');
				$this->redirect('/users/login');
				exit;
			}
		}
		$this->set('title_for_layout','User Registration');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'), 'flash_neg');
			}
		} elseif($this->Auth->user()) {
			$this->redirect('/');
		}
		
		$this->set('title_for_layout','User Login');
	}

	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
	
	public function pull_list_process($answer, $id) {
		if ($answer == "n") {
			// remove from pull list if this item is on your pull list..
			$this->Pull->toggle($id, $this->Auth->user('id'));
			$this->Session->setFlash('Item removed from your Pull List!', 'flash_pos');
			$this->redirect('/my/pull_list');
		} elseif ($answer == "y") {
			$user_item = array();
			$user_item['user_id'] = $this->Auth->user('id');
			$user_item['item_id'] = $id;
			
			$this->UserItem->create();
			$this->UserItem->save($user_item);

			$this->Pull->toggle($id, $this->Auth->user('id'));
			$this->Session->setFlash('Item added to your library!', 'flash_pos');
			$this->redirect('/my/pull_list');
		}
		
		exit;
	}
	
	public function library() {
		$this->set('title_for_layout','My Library');
		
	}
	
	public function pull_list() {
		$this->set('title_for_layout','My Pull List');

		$this->paginate = array(
			'Pull' => array(
				'order' => array(
					'Pull.created' => 'DESC'
				),
				'limit' => 24
			)
		);

		$list = $this->paginate('Pull', array('Pull.user_id' => $this->Auth->user('id')));
		$this->set('pulls', $list);
	}
	
	public function profile($user=null) {
		if(!$user && !$this->Auth->user()) {
			$this->redirect('/');
		}

		$this->User->id = $this->Auth->user('id');

		$user = $this->User->read();

		$email = $user['User']['email'];
		$default = "http://kapow.us/img/noprofile.png";
		$size = 300;
		$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

		$this->set('gravatar', $grav_url);
		
		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['publishers'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 4, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['creators'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 3, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'favorite_item_id'))));
		$this->User->UserFavorite->Series->bindModel(array('hasOne' => array('Item' => array('foreignKey' => 'series_id', 'order' => 'RAND()'))));
		$user['favorites']['series'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 2, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Series' => array('Item' => array('fields' => array('img_fullpath'))))));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['shops'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 5, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Store' => array('PrimaryPhoto', 'StorePhoto' => array('limit' => 1, 'order' => 'RAND()')))));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['items'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 1, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Item')));

		$this->set('user', $user);
		
		$pulls = $this->Pull->find('all', array('conditions' => array('Pull.user_id' => $this->Auth->user('id')), 'order' => array('Pull.id DESC'), 'limit' => 4, 'recursive' => 1));
		$this->set('pulls', $pulls);

		$library = $this->UserItem->find('all', array('conditions' => array('UserItem.user_id' => $this->Auth->user('id')), 'order' => array('UserItem.id DESC'), 'limit' => 4, 'recursive' => 1));
		$this->set('library', $library);
		
		$this->set('title_for_layout','My Profile');
	}

	public function favoritePublishers() {
		$this->paginate = array(
			'UserFavorite' => array(
				'limit' => 24,
				'order' => array(
					'UserFavorite.created' => 'DESC'
				),
				'contain' => array(
					'Publisher' => array(
						'Item' => array(
							'limit' => 1,
							'fields' => array(
								'Item.img_fullpath'
							)
						)
					)
				)
			)
		);

		$this->UserFavorite->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'favorite_item_id'))));
		$publishers = $this->paginate(
			'UserFavorite',
			array(
				'UserFavorite.item_type' => 4,
				'UserFavorite.user_id' => $this->Auth->user('id')
			)
		);

		$this->set('publishers', $publishers);
	}

	public function favoriteItems() {
		$this->paginate = array(
			'UserFavorite' => array(
				'limit' => 24,
				'order' => array(
					'UserFavorite.created' => 'DESC'
				)
			)
		);

		$this->UserFavorite->bindModel(array('belongsTo' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
		$items = $this->paginate(
			'UserFavorite',
			array(
				'UserFavorite.item_type' => 1,
				'UserFavorite.user_id' => $this->Auth->user('id')
			)
		);

		$this->set('items', $items);
	}

	public function favoriteCreators() {
		$this->paginate = array(
			'UserFavorite' => array(
				'limit' => 24,
				'order' => array(
					'UserFavorite.created' => 'DESC'
				),
				'contain' => array(
					'Creator' => array(
						'ItemCreator' => array(
							'Item' => array(
								'fields' => array(
									'Item.img_fullpath'
								)
							),
							'limit' => 1
						)
					)
				)
			)
		);

		$this->UserFavorite->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'favorite_item_id'))));
		$creators = $this->paginate(
			'UserFavorite',
			array(
				'UserFavorite.item_type' => 3,
				'UserFavorite.user_id' => $this->Auth->user('id')
			)
		);

		$this->set('creators', $creators);
	}

	public function favoriteSeries() {
		$this->paginate = array(
			'UserFavorite' => array(
				'limit' => 24,
				'order' => array(
					'UserFavorite.created' => 'DESC'
				),
				'contain' => array(
					'Series' => array(
						'Item' => array(
							'fields' => array(
								'Item.img_fullpath'
							),
							'limit' => 1
						)
					)
				)
			)
		);

		$this->UserFavorite->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'favorite_item_id'))));
		$this->UserFavorite->Series->bindModel(array('hasMany' => array('Item' => array('foreignKey' => 'series_id', 'order' => 'RAND()', 'limit' => 1))));
		$series = $this->paginate(
			'UserFavorite',
			array(
				'UserFavorite.item_type' => 2,
				'UserFavorite.user_id' => $this->Auth->user('id')
			)
		);

		$this->set('series', $series);
	}

	public function favoriteShops() {
		$this->paginate = array(
			'UserFavorite' => array(
				'limit' => 24,
				'order' => array(
					'UserFavorite.created' => 'DESC'
				),
				'contain' => array(
					'Store' => array(
						'StorePhoto' => array(
							'limit' => 1,
							'order' => array(
								'RAND()'
							),
							'fields' => array(
								'StorePhoto.photo_path'
							)
						)
					)
				)
			)
		);

		$this->UserFavorite->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'favorite_item_id'))));
		$shops = $this->paginate(
			'UserFavorite',
			array(
				'UserFavorite.item_type' => 5,
				'UserFavorite.user_id' => $this->Auth->user('id')
			)
		);

		$this->set('shops', $shops);
	}
}