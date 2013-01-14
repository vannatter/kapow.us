<?php
App::uses('AppModel', 'Model');
class Item extends AppModel {

	function saveItem($item) {

		$this->create();
		$this->save($item);
		return $this->id;
		
	}
	
}
