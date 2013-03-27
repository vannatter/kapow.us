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
 */
class AdminController extends AppController {
	public $name = 'Admin';
	public $uses = array('Item', 'Creator', 'Publisher', 'Series', 'Store', 'User', 'Category', 'CreatorType');
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

				$this->redirect($this->referer());
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

	public function creatorTypes() {
		$this->CreatorType->recursive = 0;
		$this->set('creatorTypes', $this->paginate('CreatorType'));
	}

	public function publishers() {
		$this->Publisher->recursive = 0;
		$this->set('publishers', $this->paginate('Publisher'));
	}

	public function series() {
		$this->Series->recursive = 0;
		$this->set('series', $this->paginate('Series'));
	}

	public function stores() {
		$this->Store->recursive = 0;
		$this->set('stores', $this->paginate('Store'));
	}

	public function users() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate('User'));
	}

	public function categories() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate('Category'));
	}
}