<?php
App::uses('AppModel', 'Model');
class CreatorType extends AppModel {

	public function getsetCreatorType($creator_short_name) {

		$creator_type = $this->find('first', array('conditions' => array('CreatorType.creator_short_name' => $creator_short_name), 'limit' => 1, 'recursive' => -1));
		if ($creator_type) {
			return $creator_type['CreatorType']['id'];
		} else {
			$save_creator_type = array();
			$save_creator_type['creator_short_name'] = $creator_short_name;
			$this->create();
			$this->save($save_creator_type);
			return $this->id;
		}
		
	}

}