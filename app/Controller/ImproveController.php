<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 * @property Improvement $Improvement
 */
class ImproveController extends AppController {
	public $name = 'Improve';
	public $uses = array('Improvement');

	public function index() {
		$this->redirect('/');
	}

	public function item($itemId=null) {
		parent::hasSession();

		$this->Improvement->Item->id = $itemId;
		if(!$this->Improvement->Item->exists()) {
			$this->Session->setFlash(__('Invalid Item'), 'flash_neg');
			$this->redirect("/");
		}

		$item = $this->Improvement->Item->read();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('encode' => false, 'escape' => false));

			$fields = array('section_id', 'publisher_id', 'series_id', 'stock_id', 'printing', 'item_date', 'series_num', 'srp', 'description', 'item_name');

			$toSave = array();

			foreach($fields as $field) {
				if($item['Item'][$field] != $data['Item'][$field]) {
					$toSave[] = array(
						'field_name' => $field,
						'data' => $data['Item'][$field]
					);
				}
			}

			## only add if fields changed
			if(count($toSave) > 0) {
				$this->Improvement->add(1, $itemId, $toSave, $this->Auth->user('id'));

				$this->Session->setFlash(__('Item data submitted for Admin approval'), 'flash_pos');
				$this->redirect('/items/' . $itemId);
			} else {
				$this->Session->setFlash(__('No fields changed'), 'flash_pos');
			}
		} else {
			$this->request->data = $item;
		}

		$this->set('item', $item);

		$this->set('sections', $this->Improvement->Item->Section->find('list', array('fields' => array('id', 'section_name'))));
		$this->set('publishers', $this->Improvement->Item->Publisher->find('list', array('fields' => array('id', 'publisher_name'))));
		$this->set('series', $this->Improvement->Item->Series->find('list', array('fields' => array('id', 'series_name'))));
		$this->set('title_for_layout', 'Improve This Content');
	}

	public function creator($creatorId=null) {
		parent::hasSession();

		$this->Improvement->Creator->id = $creatorId;
		if(!$this->Improvement->Creator->exists()) {
			$this->Session->setFlash(__('Invalid Creator'), 'flash_neg');
			$this->redirect("/");
		}

		$creator = $this->Improvement->Creator->read();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('encode' => false, 'escape' => false));

			$fields = array('creator_name', 'creator_bio', 'creator_website', 'creator_twitter', 'creator_facebook');

			$toSave = array();

			foreach($fields as $field) {
				if($creator['Creator'][$field] != $data['Creator'][$field]) {
					$toSave[] = array(
						'field_name' => $field,
						'data' => $data['Creator'][$field]
					);
				}
			}

			## only add if fields changed
			if(count($toSave) > 0) {
				$this->Improvement->add(3, $creatorId, $toSave, $this->Auth->user('id'));

				$this->Session->setFlash(__('Creator data submitted for Admin approval'), 'flash_pos');
				$this->redirect('/creators/' . $creatorId);
			} else {
				$this->Session->setFlash(__('No fields changed'), 'flash_pos');
			}
		} else {
			$this->request->data = $creator;
		}

		$this->set('creator', $creator);
		$this->set('title_for_layout', 'Improve This Content');
	}

	public function series($seriesId=null) {
		parent::hasSession();

		$this->Improvement->Series->id = $seriesId;
		if(!$this->Improvement->Series->exists()) {
			$this->Session->setFlash(__('Invalid Series'), 'flash_neg');
			$this->redirect("/");
		}

		$series = $this->Improvement->Series->read();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('encode' => false, 'escape' => false));

			$fields = array('series_name', 'description');

			$toSave = array();

			foreach($fields as $field) {
				if($series['Series'][$field] != $data['Series'][$field]) {
					$toSave[] = array(
						'field_name' => $field,
						'data' => $data['Series'][$field]
					);
				}
			}

			## only add if fields changed
			if(count($toSave) > 0) {
				$this->Improvement->add(2, $seriesId, $toSave, $this->Auth->user('id'));

				$this->Session->setFlash(__('Series data submitted for Admin approval'), 'flash_pos');
				$this->redirect('/series/' . $seriesId);
			} else {
				$this->Session->setFlash(__('No fields changed'), 'flash_pos');
			}
		} else {
			$this->request->data = $series;
		}

		$this->set('series', $series);
		$this->set('title_for_layout', 'Improve This Content');
	}

	public function publisher($publisherId=null) {
		parent::hasSession();

		$this->Improvement->Publisher->id = $publisherId;
		if(!$this->Improvement->Publisher->exists()) {
			$this->Session->setFlash(__('Invalid Publisher'), 'flash_neg');
			$this->redirect("/");
		}

		$publisher = $this->Improvement->Publisher->read();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('encode' => false, 'escape' => false));

			$fields = array('publisher_name', 'publisher_bio', 'publisher_website');

			$toSave = array();

			foreach($fields as $field) {
				if($publisher['Publisher'][$field] != $data['Publisher'][$field]) {
					$toSave[] = array(
						'field_name' => $field,
						'data' => $data['Publisher'][$field]
					);
				}
			}

			## only add if fields changed
			if(count($toSave) > 0) {
				$this->Improvement->add(4, $publisherId, $toSave, $this->Auth->user('id'));

				$this->Session->setFlash(__('Publisher data submitted for Admin approval'), 'flash_pos');
				$this->redirect('/publishers/' . $publisherId);
			} else {
				$this->Session->setFlash(__('No fields changed'), 'flash_pos');
			}
		} else {
			$this->request->data = $publisher;
		}

		$this->set('publisher', $publisher);
		$this->set('title_for_layout', 'Improve This Content');
	}

	public function store($storeId=null) {
		parent::hasSession();

		$this->Improvement->Store->id = $storeId;
		if(!$this->Improvement->Store->exists()) {
			$this->Session->setFlash(__('Invalid Store'), 'flash_neg');
			$this->redirect("/");
		}

		$store = $this->Improvement->Store->read();

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('encode' => false, 'escape' => false));

			$fields = array('name', 'address', 'address_2', 'city', 'state', 'zip', 'phone_no', 'website', 'facebook_url', 'twitter_url', 'ebay_url');
			$toSave = array();

			foreach($fields as $field) {
				if($store['Store'][$field] != $data['Store'][$field]) {
					$toSave[] = array(
						'field_name' => $field,
						'data' => $data['Store'][$field]
					);
				}
			}

			## only add if fields changed
			if(count($toSave) > 0) {
				$this->Improvement->add(5, $storeId, $toSave, $this->Auth->user('id'));

				$this->Session->setFlash(__('Store data submitted for Admin approval'), 'flash_pos');
				$this->redirect('/shops/' . $storeId);
			} else {
				$this->Session->setFlash(__('No fields changed'), 'flash_pos');
			}
		} else {
			$this->request->data = $store;
		}

		$this->set('store', $store);
		$this->set('title_for_layout', 'Improve This Content');
	}
}