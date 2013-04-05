<?php
App::uses('AppModel', 'Model');
/**
 * Publisher Model
 *
 * @property Item $Item
 */
class Publisher extends AppModel {
	public $actsAs = array('Containable');
	public $recursive = 0;

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'publisher_name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'publisher_id',
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
