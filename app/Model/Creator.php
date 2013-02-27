<?php
App::uses('AppModel', 'Model');
class Creator extends AppModel {

	public $actsAs = array('Containable');

	

	public function getsetCreator($creator_name) {

		$creator = $this->find('first', array('conditions' => array('Creator.creator_name' => $creator_name), 'limit' => 1, 'recursive' => -1));
		if ($creator) {
			return $creator['Creator']['id'];
		} else {
			$save_creator = array();
			$save_creator['creator_name'] = $creator_name;
			$this->create();
			$this->save($save_creator);
			return $this->id;
		}
		
	}

}