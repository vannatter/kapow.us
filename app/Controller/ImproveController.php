<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 * @property Improvement $Improvement
 */
class ImproveController extends AppController {
	public $name = 'Improve';
	public $uses = array('Item', 'Improvement');

	public function index() {
		$this->redirect('/');
	}

	public function item($itemId=null) {
		parent::hasSession();

		$this->Item->id = $itemId;
		if(!$this->Item->exists()) {
			$this->Session->setFlash(__('Invalid Item'), 'flash_neg');
			$this->redirect("/");
		}

		$item = $this->Item->read();

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$toSave = array(
				'ImproveItem' => array(
					'item_id' => $itemId,
					'section_id' => $item['Item']['section_id'],
					'section_id_new' => $data['Item']['section_id'],
					'publisher_id' => $item['Item']['publisher_id'],
					'publisher_id_new' => $data['Item']['publisher_id'],
					'series_id' => $item['Item']['series_id'],
					'series_id_new' => $data['Item']['series_id'],
					'stock_id' => $item['Item']['stock_id'],
					'stock_id_new' => $data['Item']['stock_id'],
					'printing' => $item['Item']['printing'],
					'printing_new' => $data['Item']['printing'],
					'item_date' => $item['Item']['item_date'],
					'item_date_new' => $data['Item']['item_date'],
					'series_num' => $item['Item']['series_num'],
					'series_num_new' => $data['Item']['series_num'],
					'srp' => $item['Item']['srp'],
					'srp_new' => $data['Item']['srp'],
					'description' => $item['Item']['description'],
					'description_new' => $data['Item']['description'],
					'item_name' => $item['Item']['item_name'],
					'item_name_new' => $data['Item']['item_name']
				)
			);

			if($this->Improvement->ImproveItem->save($toSave)) {
				$newId = $this->Improvement->ImproveItem->id;

				$this->Improvement->add($newId, 1, $this->Auth->user('id'));

				$this->Session->setFlash(__('Item data submitted for Admin approval'), 'flash_pos');
				$this->redirect('/items/' . $itemId);
			}
		} else {
			$this->request->data = $item;
		}

		$this->set('item', $item);

		$this->set('sections', $this->Item->Section->find('list', array('fields' => array('id', 'section_name'))));
		$this->set('publishers', $this->Item->Publisher->find('list', array('fields' => array('id', 'publisher_name'))));
		$this->set('series', $this->Item->Series->find('list', array('fields' => array('id', 'series_name'))));
		$this->set('title_for_layout', 'Improve This Item Content');
	}
}