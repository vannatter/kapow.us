<?php
App::uses('AppModel', 'Model');
/**
 * Improvement Model
 *
 * @property User $User
 * @property ImproveItem $ImproveItem
 */
class Improvement extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ImproveItem' => array(
			'className' => 'ImproveItem',
			'foreignKey' => 'improve_id',
			'conditions' => array(
				'Improvement.improve_type' => 1
			)
		)
	);

	public function add($improveId, $improveType, $userId) {
		$this->save(array('Improvement' => array('improve_id' => $improveId, 'improve_type' => $improveType, 'user_id' => $userId)));
	}
}
