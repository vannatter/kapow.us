<?php

App::uses('AppController', 'Controller');

class ItemsController extends AppController {

	public $name = 'Items';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category');

	public function this_week($content_type="1") {

		$first_day = date("N", strtotime("today"));
		if ($first_day < 3) {
			$release_date = date("Y-m-d", strtotime("this wednesday"));
		}
		if ($first_day == 3) {
			$release_date = date("Y-m-d", strtotime("today"));
		}
		if ($first_day == 4) {
			$release_date = date("Y-m-d", strtotime("yesterday"));
		}
		if ($first_day > 4) {
			$release_date = date("Y-m-d", strtotime("last wednesday"));
		}
		
		$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
	}
		
}
?>