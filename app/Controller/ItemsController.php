<?php

App::uses('AppController', 'Controller');

class ItemsController extends AppController {

	public $name = 'Items';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator');

	public function this_week() {

		$release_date = date("Y-m-d", strtotime("this wednesday"));

		echo "release_date = " . $release_date . "<br/>";
		
		$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date), 'limit' => 2500, 'recursive' => 4));
		
		echo "<pre>";
		print_r($items);
		echo "</pre>";
		
		
	}
		
}
?>