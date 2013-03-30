<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 * @property Creator $Creator
 * @property CreatorType $CreatorType
 * @property Publisher $Publisher
 * @property Series $Series
 * @property Store $Store
 * @property User $User
 * @property Category $Category
 * @property Section $Section
 */
class AdminController extends AppController {
	public $name = 'Admin';
	public $uses = array('Item', 'Creator', 'Publisher', 'Series', 'Store', 'User', 'Category', 'CreatorType', 'Section');
	public $helpers = array('States');
	public $paginate = array(
		'Item' => array(
			'limit' => 25,
			'order' => array('Item.id' => 'asc')
		),
		'Creator' => array(
			'limit' => 25,
			'order' => array('Creator.id' => 'asc')
		),
		'Publisher' => array(
			'limit' => 25,
			'order' => array('Publisher.id' => 'asc')
		),
		'Series' => array(
			'limit' => 25,
			'order' => array('Seriesid' => 'asc')
		),
		'Store' => array(
			'limit' => 25,
			'order' => array('Store.id' => 'asc')
		),
		'User' => array(
			'limit' => 25,
			'order' => array('User.id' => 'asc')
		),
		'Category' => array(
			'limit' => 25,
			'order' => array('Category.id' => 'asc')
		),
		'Section' => array(
			'limit' => 25,
			'order' => array('Section.id' => 'asc')
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		parent::hasAdminSession();

		$this->layout = 'admin';
	}

	public function index() {
	}

	##### ITEMS
	public function items() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate('Item'));
	}

	public function itemsEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Item']['id'] = $id;

			if($this->Item->save($data)) {
				$this->Session->setFlash(__('Item Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect('/admin/items');
			}
		} else {
			$this->Item->id = $id;
			if(!$this->Item->exists()) {
				$this->Session->setFlash(__('Item Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/items');
			}

			$item = $this->Item->read();
			$this->request->data = $item;
		}

		$this->set('sections', $this->Item->Section->find('list', array('fields' => array('id', 'section_name'))));
		$this->set('publishers', $this->Publisher->find('list', array('fields' => array('id', 'publisher_name'))));
		$this->set('series', $this->Series->find('list', array('fields' => array('id', 'series_name'))));
	}

	public function creators() {
		$this->Creator->recursive = 0;
		$this->set('creators', $this->paginate('Creator'));
	}

	public function creatorsEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Creator']['id'] = $id;

			if($this->Creator->save($data)) {
				$this->Session->setFlash(__('Creator Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/creators');
			}
		} else {
			$this->Creator->id = $id;
			if(!$this->Creator->exists()) {
				$this->Session->setFlash(__('Creator Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/creators');
			}

			$creator = $this->Creator->read();
			$this->request->data = $creator;
		}
	}

	public function creatorTypes() {
		$this->CreatorType->recursive = 0;
		$this->set('creatorTypes', $this->paginate('CreatorType'));
	}

	public function creatorTypesEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['CreatorType']['id'] = $id;

			if($this->CreatorType->save($data)) {
				$this->Session->setFlash(__('Creator Type Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/creatorTypes');
			}
		} else {
			$this->CreatorType->id = $id;
			if(!$this->CreatorType->exists()) {
				$this->Session->setFlash(__('Creator Type Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/creatorTypes');
			}

			$creatorType = $this->CreatorType->read();
			$this->request->data = $creatorType;
		}
	}

	public function publishers() {
		$this->Publisher->recursive = 0;
		$this->set('publishers', $this->paginate('Publisher'));
	}

	public function publishersEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Publisher']['id'] = $id;

			if($this->Publisher->save($data)) {
				$this->Session->setFlash(__('Publisher Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/publishers');
			}
		} else {
			$this->Publisher->id = $id;
			if(!$this->Publisher->exists()) {
				$this->Session->setFlash(__('Publisher Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/publishers');
			}

			$publisher = $this->Publisher->read();
			$this->request->data = $publisher;
		}
	}

	public function series() {
		$this->Series->recursive = 0;
		$this->set('series', $this->paginate('Series'));
	}

	public function seriesEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Series']['id'] = $id;

			if($this->Series->save($data)) {
				$this->Session->setFlash(__('Series Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/series');
			}
		} else {
			$this->Series->id = $id;
			if(!$this->Series->exists()) {
				$this->Session->setFlash(__('Series Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/series');
			}

			$series = $this->Series->read();
			$this->request->data = $series;
		}
	}

	public function stores() {
		$this->Store->recursive = 0;
		$this->set('stores', $this->paginate('Store'));
	}

	public function storesEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Store']['id'] = $id;

			if($this->Store->save($data)) {
				$this->Session->setFlash(__('Store Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/stores');
			}
		} else {
			$this->Store->id = $id;
			if(!$this->Store->exists()) {
				$this->Session->setFlash(__('Store Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/stores');
			}

			$store = $this->Store->read();
			$this->request->data = $store;
		}
	}

	public function users() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate('User'));
	}

	public function usersEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['User']['id'] = $id;

			if($this->User->save($data)) {
				$this->Session->setFlash(__('User Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/users');
			}
		} else {
			$this->User->id = $id;
			if(!$this->User->exists()) {
				$this->Session->setFlash(__('User Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/users');
			}

			$user = $this->User->read();
			$this->request->data = $user;
		}
	}

	public function categories() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate('Category'));
	}

	public function categoriesEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Category']['id'] = $id;

			if($this->Category->save($data)) {
				$this->Session->setFlash(__('Category Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/categories');
			}
		} else {
			$this->Category->id = $id;
			if(!$this->Category->exists()) {
				$this->Session->setFlash(__('Category Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/categories');
			}

			$category = $this->Category->read();
			$this->request->data = $category;
		}
	}

	public function sections() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate('Section'));
	}

	public function sectionsEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Section']['id'] = $id;

			if($this->Section->save($data)) {
				$this->Session->setFlash(__('Section Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/sections');
			}
		} else {
			$this->Section->id = $id;
			if(!$this->Section->exists()) {
				$this->Session->setFlash(__('Section Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/sections');
			}

			$section = $this->Section->read();
			$this->request->data = $section;
		}

		$this->set('categories', $this->Category->find('list', array('fields' => array('id', 'category_name'))));
	}
}