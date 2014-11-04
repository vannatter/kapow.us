<?php
App::uses('AppModel', 'Model');
/**
 * Improvement Model
 *
 * @property User $User
 * @property ImprovementField $ImprovementField
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
		'Item' => array(
			'foreignKey' => 'type_item_id',
			'conditions' => array(
				'Improvement.type' => 1
			)
		),
		'Creator' => array(
			'foreignKey' => 'type_item_id',
			'conditions' => array(
				'Improvement.type' => 3
			)
		),
		'Series' => array(
			'foreignKey' => 'type_item_id',
			'conditions' => array(
				'Improvement.type' => 2
			)
		),
		'Publisher' => array(
			'foreignKey' => 'type_item_id',
			'conditions' => array(
				'Improvement.type' => 4
			)
		),
		'Store' => array(
			'foreignKey' => 'type_item_id',
			'conditions' => array(
				'Improvement.type' => 5
			)
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ImprovementField' => array(
			'className' => 'ImprovementField',
			'foreignKey' => 'improvement_id',
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

	public function add($type, $itemId, $data, $userId) {
		$add = array(
			'Improvement' => array(
				'type' => $type,
				'type_item_id' => $itemId,
				'status' => 0,
				'user_id' => $userId
			)
		);

		if ($this->save($add)) {
			$id = $this->id;

			foreach($data as $field) {
				$this->ImprovementField->add($id, $field['field_name'], $field['data']);
			}
		}
	}
}
