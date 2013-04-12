<?php

App::uses('AppController', 'Controller');

/**
 * @property User $User
 */
class UsersController extends AppController {
	public $name = 'Users';
	public $uses = array('User');

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
				$this->Session->setFlash(__('Invalid username or password, try again'));
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

	public function profile($user=null) {
		if(!$user && !$this->Auth->user()) {
			$this->redirect('/');
		}

		$this->User->id = $this->Auth->user('id');

		$user = $this->User->read();

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['publishers'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 4)));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['creators'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 3)));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['series'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 2)));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['shops'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 5)));

		$this->set('user', $user);
	}
}