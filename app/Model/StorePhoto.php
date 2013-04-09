<?php
App::uses('AppModel', 'Model');
class StorePhoto extends AppModel {

	public $belongsTo = array(
		'Store' => array(
			'className' => 'Store',
			'foreignKey' => 'store_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);		
	
	public function remove($id) {
		$this->id = $id;
		if(!$this->exists()) {
			return false;
		}

		$photo = $this->read();
		$path = $photo['StorePhoto']['photo_path'];

		unlink($path);

		$this->delete($id);

		return true;
	}
}