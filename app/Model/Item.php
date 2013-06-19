<?php
App::uses('AppModel', 'Model');
class Item extends AppModel {

	public $actsAs = array('Containable');

	public $hasMany = array(
		'ItemCreator' => array(
			'className' => 'ItemCreator',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ItemTag' => array(
			'className' => 'ItemTag',
			'foreignKey' => 'item_id',
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
	
	public $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Publisher' => array(
			'className' => 'Publisher',
			'foreignKey' => 'publisher_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Series' => array(
			'className' => 'Series',
			'foreignKey' => 'series_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
		
	);	
	
	function saveItem($item) {

		$this->create();
		$this->save($item);
		return $this->id;
		
	}

	function getRandomItemByDate($date=null) {
		if(!$date) {
			$first_day = date("N", strtotime("today"));

			if ($first_day < 3) {
				$date = date("Y-m-d", strtotime("this wednesday"));
			}
			if ($first_day == 3) {
				$date = date("Y-m-d", strtotime("today"));
			}
			if ($first_day == 4) {
				$date = date("Y-m-d", strtotime("yesterday"));
			}
			if ($first_day > 4) {
				$date = date("Y-m-d", strtotime("last wednesday") );
			}
		}

		return $this->find('first', array('conditions' => array('Item.item_date' => $date, 'Section.category_id' => 1), 'order' => array('RAND()')));
	}

	function getRandom() {
		return $this->find('first', array('order' => array('RAND()')));
	}
}
