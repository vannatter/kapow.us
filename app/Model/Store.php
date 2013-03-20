<?php
App::uses('AppModel', 'Model');
/**
 * Store Model
 *
 * @property Hour $Hour
 */
class Store extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Hour' => array(
			'className' => 'Hour',
			'foreignKey' => 'store_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function add($store=array()) {
		if($store && count($store) > 0) {
			## get the store Id if it exists already
			if($check = $this->find('first', array('conditions' => array('Store.name' => $store['Store']['name']), 'recursive' => -1))) {
				$store['Store']['id'] = $check['Store']['id'];
			} else {
				$this->create($store);
			}

			if($this->save($store)) {
				if(isset($store['Store']['Hour'])) {
					$store['Store']['Hour']['store_id'] = $this->id;

					## get the hour ID if it exists already
					if($hourCheck = $this->Hour->find('first', array('conditions' => array('Hour.store_id' => $this->id), 'recursive' => -1))) {
						$store['Store']['Hour']['id'] = $hourCheck['Hour']['id'];
					} else {
						$this->Hour->create($store['Store']['Hour']);
					}

					$this->Hour->save($store['Store']['Hour']);
				}
			}
		}
	}
	
	public function radius($lat, $lon, $rad) {

		$lat = '34.7405350';
		$lon = '-92.3245120';
		
		$sql = "SELECT Stores.*, ACOS(COS(RADIANS(lat)) *
		COS(RADIANS(lon)) * COS(RADIANS($lat)) * COS(RADIANS($lon)) +
		COS(RADIANS(lat)) * SIN(RADIANS(lon)) * COS(RADIANS($lat)) * 
		SIN(RADIANS($lon)) + SIN(RADIANS(lat)) * SIN(RADIANS($lat))) * 
		3963.1 AS Distance
		FROM Stores 
		WHERE 1
		HAVING Distance <= 50";
		
		
	}
	
}
