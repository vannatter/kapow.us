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
		if (!$this->Item->exists()) {
			$this->Session->setFlash(__('Invalid ID!'), 'flash_neg');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 1;   ## ITEM
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if ($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted!'), 'flash_pos');
				$this->redirect(array('controller' => 'items', 'action' => $id));
			}
		}

		$item = $this->Item->read('item_name');
		$item_id = $this->Item->read('id');
		
		$this->set('item', $item['Item']['item_name']);
		$this->set('link', "/items/".$this->seoize($item_id['Item']['id'], $item['Item']['item_name']));
		$this->set('title_for_layout', 'Report an Issue');

		$this->render('issue');
	}

	public function creator($id) {
		$this->Creator->id = $id;
		if (!$this->Creator->exists()) {
			$this->Session->setFlash(__('Invalid ID!'), 'flash_neg');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 3;   ## CREATOR
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if ($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted!'), 'flash_pos');
				$this->redirect(array('controller' => 'creators', 'action' => $id));
			}
		}

		$item = $this->Creator->read('creator_name');
		$item_id = $this->Creator->read('id');

		$this->set('item', $item['Creator']['creator_name']);
		$this->set('link', "/creators/".$this->seoize($item_id['Creator']['id'], $item['Creator']['creator_name']));
		$this->set('title_for_layout', 'Report an Issue');

		$this->render('issue');
	}

	public function series($id) {
		$this->Series->id = $id;
		if (!$this->Series->exists()) {
			$this->Session->setFlash(__('Invalid ID!'), 'flash_neg');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 2;   ## SERIES
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if ($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted!'), 'flash_pos');
				$this->redirect(array('controller' => 'series', 'action' => $id));
			}
		}

		$item = $this->Series->read('series_name');
		$item_id = $this->Series->read('id');
		
		$this->set('item', $item['Series']['series_name']);
		$this->set('link', "/series/".$this->seoize($item_id['Series']['id'], $item['Series']['series_name']));
		$this->set('title_for_layout', 'Report an Issue');

		$this->render('issue');
	}

	public function shop($id) {
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			$this->Session->setFlash(__('Invalid ID!'), 'flash_neg');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 5;   ## SHOP
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if ($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted!'), 'flash_pos');
				$this->redirect(array('controller' => 'shops', 'action' => $id));
			}
		}

		$item = $this->Store->read('name');
		$item_id = $this->Store->read('id');

		$this->set('item', $item['Store']['name']);
		$this->set('link', "/shops/".$this->seoize($item_id['Store']['id'], $item['Store']['name']));
		$this->set('title_for_layout', 'Report an Issue');

		$this->render('issue');
	}

	public function publisher($id) {
		$this->Publisher->id = $id;
		if (!$this->Publisher->exists()) {
			$this->Session->setFlash(__('Invalid ID!'), 'flash_neg');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Report']['user_id'] = $this->Auth->user('id');
			$data['Report']['item_type'] = 4;   ## PUBLISHER
			$data['Report']['report_item_id'] = $id;

			$this->Report->create($data);
			if ($this->Report->save($data)) {
				$this->Session->setFlash(__('Report Submitted!'), 'flash_pos');
				$this->redirect(array('controller' => 'publishers', 'action' => $id));
			}
		}

		$item = $this->Publisher->read('publisher_name');
		$item_id = $this->Publisher->read('id');
		
		$this->set('item', $item['Publisher']['publisher_name']);
		$this->set('link', "/publishers/".$this->seoize($item_id['Publisher']['id'], $item['Publisher']['publisher_name']));
		$this->set('title_for_layout', 'Report an Issue');

		$this->render('issue');
	}
}