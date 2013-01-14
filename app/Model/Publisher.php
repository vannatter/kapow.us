<?php
App::uses('AppModel', 'Model');
class Publisher extends AppModel {

	public function getsetPublisher($publisher_name) {

		$publisher = $this->find('first', array('conditions' => array('Publisher.publisher_name' => $publisher_name), 'limit' => 1, 'recursive' => -1));
		if ($publisher) {
			return $publisher['Publisher']['id'];
		} else {
			$save_publisher = array();
			$save_publisher['publisher_name'] = $publisher_name;
			$this->create();
			$this->save($save_publisher);
			return $this->id;
		}
	}

}