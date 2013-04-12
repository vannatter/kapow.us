<?php

App::uses('AppController', 'Controller');

/**
 * @property Report $Report
 * @property Item $Item
 * @property Creator $Creator
 * @property Publisher $Publisher
 * @property Series $Series
 * @property Store $Store
 */
class ReportsController extends AppController {
	public $name = 'Reports';
	public $uses = array('Report', 'Item', 'Creator', 'Publisher', 'Series', 'Store');

	public function beforeFilter() {
		parent::beforeFilter();
		parent::hasSession();
	}

	public function index() {
	}

	public function item($id) {
		$this->Item->id = $id;
		if(!$this->Item->exists()) {
			$this->Session->setFlash(__('Invalid Item'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer());
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 1;   ## ITEM
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect(array('controller' => 'items', 'action' => $id));
			}
		}

		$item = $this->Item->read('item_name');
		$this->set('item', $item['Item']['item_name']);

		$this->render('issue');
	}

	public function creator($id) {
		$this->Creator->id = $id;
		if(!$this->Creator->exists()) {
			$this->Session->setFlash(__('Invalid Creator'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer());
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 3;   ## CREATOR
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect(array('controller' => 'creators', 'action' => $id));
			}
		}

		$item = $this->Creator->read('creator_name');
		$this->set('item', $item['Creator']['creator_name']);

		$this->render('issue');
	}

	public function series($id) {
		$this->Series->id = $id;
		if(!$this->Series->exists()) {
			$this->Session->setFlash(__('Invalid Series'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer());
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 2;   ## SERIES
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect(array('controller' => 'series', 'action' => $id));
			}
		}

		$item = $this->Series->read('series_name');
		$this->set('item', $item['Series']['series_name']);

		$this->render('issue');
	}

	public function shop($id) {
		$this->Store->id = $id;
		if(!$this->Store->exists()) {
			$this->Session->setFlash(__('Invalid Shop'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer());
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 5;   ## SHOP
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect(array('controller' => 'shops', 'action' => $id));
			}
		}

		$item = $this->Store->read('name');
		$this->set('item', $item['Store']['name']);

		$this->render('issue');
	}

	public function publisher($id) {
		$this->Publisher->id = $id;
		if(!$this->Publisher->exists()) {
			$this->Session->setFlash(__('Invalid Publisher'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer());
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 4;   ## PUBLISHER
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect(array('controller' => 'publishers', 'action' => $id));
			}
		}

		$item = $this->Publisher->read('publisher_name');
		$this->set('item', $item['Publisher']['publisher_name']);

		$this->render('issue');
	}
}