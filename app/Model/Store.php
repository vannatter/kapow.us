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

	public function radius($lat, $long, $rad=25) {
		$distanceQuery = '(3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( ' . $this->alias. '.latitude ) ) * cos( radians( ' . $this->alias . '.longitude ) - radians(' . $long . ') ) + sin( radians(' . $lat . ') ) * sin( radians( ' . $this->alias . '.latitude ) ) ) )';
		$query = '
			SELECT Store.*, Hour.*, ' . $distanceQuery . ' AS distance
				FROM stores AS Store
				LEFT JOIN hours AS Hour ON Hour.store_id = Store.id
				HAVING distance < ' . $rad . '
				ORDER BY distance
		';

		return $this->query($query);
	}
}