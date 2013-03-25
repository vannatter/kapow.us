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

	public function login() {
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		} elseif($this->Auth->user()) {
			$this->redirect('/');
		}
	}

	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
}