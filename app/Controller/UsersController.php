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
	public $helpers = array('Gravatar');

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
		if($this->request->ext == 'json') {
			$result = array('error' => true, 'message' => '', 'user' => array());

			if(@$this->params['form']['user'] && @$this->params['form']['pass']) {
				$data = array('User' => array('email' => $this->params['form']['user'], 'password' => $this->params['form']['pass']));

				$data = $this->Auth->hashPasswords($data);

				if($this->Auth->login($data)) {
					$result['error'] = false;

					$result['user'] = array('id' => $this->Auth->user('id'), 'username' => $this->Auth->user('username'), 'email' => $this->Auth->user('email'));
				} else {
					$result['message'] = __('Invalid email or password, try again');
				}
			} else {
				$result['message'] = __('Invalid username or password, try again');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		} elseif ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$username = $this->Auth->user('username');
				if(empty($username)) {
					$this->redirect('/users/setUsername');
				} else {
					$this->redirect($this->Auth->redirect());
				}
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

		$items = $this->UserItem->find('all', array(
			'conditions' => array(
				'UserItem.user_id' => $this->Auth->user('id')
			),
			'joins' => array(
				array(
					'alias' => 'Item',
					'table' => 'items',
					'type' => 'INNER',
					'conditions' => 'Item.id = UserItem.item_id'
				),
				array(
					'alias' => 'Section',
					'table' => 'sections',
					'type' => 'INNER',
					'conditions' => 'Section.id = Item.section_id'
				),
				array(
					'alias' => 'Series',
					'table' => 'series',
					'type' => 'INNER',
					'conditions' => 'Series.id = Item.series_id'
				),
				array(
					'alias' => 'Publisher',
					'table' => 'publishers',
					'type' => 'INNER',
					'conditions' => 'Publisher.id = Item.publisher_id'
				)
			),
			'fields' => array(
				'UserItem.*',
				'Item.*',
				'Section.*',
				'Series.*',
				'Publisher.*'
			),
			'order' => array(
				'Series.series_name' => 'ASC'
			),
			'limit' => 24,
			'recursive' => -1
		));

		foreach($items as $k=>$item) {
			$creators = $this->UserItem->Item->ItemCreator->find('all', array(
				'conditions' => array(
					'ItemCreator.item_id' => $item['Item']['id']
				),
				'contain' => array(
					'Creator'
				)
			));

			$items[$k]['ItemCreator'] = $creators;

			$tags = $this->UserItem->Item->ItemTag->find('all', array(
				'conditions' => array(
					'ItemTag.item_id' => $item['Item']['id']
				)
			));

			$items[$k]['ItemTag'] = $tags;
		}

		$this->set('items', $items);
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
		if (!$user && !$this->Auth->user()) {
			$this->redirect('/');
		}

		$this->User->id = $this->Auth->user('id');
		$user = $this->User->read();

		$email = $user['User']['email'];
		$default = "http://kapow.us/img/noprofile.png";
		$size = 300;
		$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

		$this->set('gravatar', $grav_url);
		$this->_getProfileData($user);

		$this->set('user', $user);
		$this->set('username', $user['User']['username']);
		$this->set('title_for_layout','My Profile');
	}

	public function favoritePublishers() {
		parent::hasSession();

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
							),
							'order' => array(
								'Item.created DESC'
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
		parent::hasSession();

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
		parent::hasSession();

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
								),
							),
							'limit' => 1,
							'order' => array(
								'ItemCreator.created DESC'
							)
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
		parent::hasSession();

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
		parent::hasSession();

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

	public function profileEdit() {
		parent::hasSession();

		$this->User->id = $this->Auth->user('id');
		$user = $this->User->read();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['User']['id'] = $this->Auth->user('id');

			if($this->User->save($data)) {
				$message = __('Profile Saved');
				if(isset($data['User']['clear_password'])) {
					$message = __('Password Changed');
				}
				$this->Session->setFlash($message, 'flash_pos');
				$this->redirect($this->referer());
			}
		}

		if(isset($this->request->data)) {
			$this->request->data = array_merge($this->request->data, $user);
		} else {
			$this->request->data = $user;
		}
		
		$this->set('title_for_layout','Edit My Profile');
	}

	public function profilePublic() {
		parent::hasSession();

		$this->User->id = $this->Auth->user('id');
		$user = $this->User->read();

		$this->_getProfileData($user);

		$this->set('user', $user);
		$this->set('public', true);

		$this->render('profile');
	}

	private function _getProfileData(&$user) {
		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['publishers'] = $this->User->UserFavorite->find('all', array(
			'conditions' => array(
				'UserFavorite.item_type' => 4,
				'UserFavorite.user_id' => $this->Auth->user('id')
			),
			'order' => array(
				'UserFavorite.id' => 'DESC'
			),
			'limit' => 4,
			'contain' => array(
				'Publisher' => array(
					'Item' => array(
						'limit' => 1,
						'order' => array(
							'Item.created DESC'
						)
					)
				)
			)
		));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['creators'] = $this->User->UserFavorite->find('all', array(
			'conditions' => array(
				'UserFavorite.item_type' => 3,
				'UserFavorite.user_id' => $this->Auth->user('id')
			),
			'order' => array(
				'UserFavorite.id' => 'DESC'
			),
			'limit' => 4,
			'contain' => array(
				'Creator' => array(
					'ItemCreator' => array(
						'limit' => 1,
						'order' => array(
							'ItemCreator.created DESC',
						),
						'Item'
					)
				)
			)
		));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'favorite_item_id'))));
		$this->User->UserFavorite->Series->bindModel(array('hasOne' => array('Item' => array('foreignKey' => 'series_id', 'order' => 'RAND()'))));
		$user['favorites']['series'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 2, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Series' => array('Item' => array('fields' => array('img_fullpath'))))));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['shops'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 5, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Store' => array('PrimaryPhoto', 'StorePhoto' => array('limit' => 1, 'order' => 'RAND()')))));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['items'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 1, 'UserFavorite.user_id' => $this->Auth->user('id')), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Item')));

		$pulls = $this->Pull->find('all', array('conditions' => array('Pull.user_id' => $this->Auth->user('id')), 'order' => array('Pull.id DESC'), 'limit' => 4, 'recursive' => 1));
		$this->set('pulls', $pulls);

		$library = $this->UserItem->find('all', array('conditions' => array('UserItem.user_id' => $this->Auth->user('id')), 'order' => array('UserItem.id DESC'), 'limit' => 4, 'recursive' => 1));
		$this->set('library', $library);
	}

	public function setUsername() {
		parent::hasSession();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['User']['id'] = $this->Auth->user('id');

			if($this->User->save($data)) {
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));

				$this->Session->setFlash(__('Username saved!'), 'flash_pos');
				$this->redirect('/my');
			}
		}
		$this->set('title_for_layout','Select Your Username');
	}

	public function libraryRemove($itemId=null) {
		if($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => __('Invalid'), 'type' => 1);

			$itemId = $this->request->query['id'];

			if($this->Auth->user()) {
				## make sure the this favorite belongs to the user
				if($item = $this->UserItem->find('first', array('conditions' => array('UserItem.id' => $itemId), 'recursive' => -1))) {
					if($item['UserItem']['user_id'] == $this->Auth->user('id')) {
						$this->UserItem->delete($itemId);

						$result['error'] = false;
						$result['message'] = '';
					} else {
						$result['message'] = __('Invalid User');
					}
				} else {
					$result['message'] = __('Invalid');
				}
			} else {
				$result['message'] = __('Not Logged In!');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		} else {
			parent::hasSession();

			debug($itemId);
			exit;
		}
	}
}