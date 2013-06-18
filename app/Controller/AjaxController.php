<?php

App::uses('AppController', 'Controller');

class AjaxController extends AppController {

	public $name = 'Ajax';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator', 'Store','Tag','ItemTag','StorePhoto');
	public $components = array('Curl');
	public $helpers = array('Common');
	
	public function random_item() {

		$ticker = null;
		$tapeTypes = array('item', 'creator');

		switch($tapeTypes[array_rand($tapeTypes)]) {
			case 'item':
				$ticker = $this->Item->getRandom();
				break;
			case 'creator':
				$ticker = $this->Creator->getRandom();
				break;
		}
		
		$output = json_encode($ticker);
		echo $output;
		exit;
	}
	
}