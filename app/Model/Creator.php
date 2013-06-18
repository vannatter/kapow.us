<?php
App::uses('AppModel', 'Model');
class Creator extends AppModel {

	public $actsAs = array('Containable');

	public $hasMany = array(
		'ItemCreator' => array(
			'className' => 'ItemCreator',
			'foreignKey' => 'creator_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

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

	public function getRandom($con=array('Creator.creator_bio !=' => '', 'Creator.creator_photo !=' => '')) {
		return $this->find('first', array('conditions' => $con, 'order' => 'RAND()', 'recursive' => -1));
	}

}