<?php

App::uses('AppController', 'Controller');

class ItemsController extends AppController {

	public $name = 'Items';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category');

	public function detail($item_string) {
		
	}

	public function next_week($content_type="1") {
		$first_day = date("N", strtotime("today"));
		if ($first_day < 3) {
			$release_date = date("Y-m-d", strtotime("+2 wednesdays"));
		}
		if ($first_day == 3) {
			$release_date = date("Y-m-d", strtotime("+1 week"));
		}
		if ($first_day == 4) {
			$release_date = date("Y-m-d", strtotime("+6 days"));
		}
		if ($first_day > 4) {
			$release_date = date("Y-m-d", strtotime("this wednesday"));
		}
		
/*
		echo "first_day = " . $first_day . "<br/>";
		echo "release_date = " . $release_date . "<br/>";
*/

		$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
		$this->set('release_date_formatted', date("m/d/Y", strtotime($release_date)));
	}

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

/*
		echo "first_day = " . $first_day . "<br/>";
		echo "release_date = " . $release_date . "<br/>";
*/
		
		$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
		$this->set('release_date_formatted', date("m/d/Y", strtotime($release_date)));
	}
		
}
?>