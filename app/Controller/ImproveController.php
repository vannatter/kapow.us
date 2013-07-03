<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 */
class ImproveController extends AppController {
	public $name = 'Improve';
	public $uses = array('Item');

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