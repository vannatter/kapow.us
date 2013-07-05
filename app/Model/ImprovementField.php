<?php
App::uses('AppModel', 'Model');
/**
 * ImprovementField Model
 *
 * @property Improvement $Improvement
 */
class ImprovementField extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Improvement' => array(
			'className' => 'Improvement',
			'foreignKey' => 'improvement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function add($improvementId, $fieldName, $data) {
		$add = array(
			'ImprovementField' => array(
				'improvement_id' => $improvementId,
				'field_name' => $fieldName,
				'data' => $data
			)
		);

		$this->create($add);
		$this->save($add);
	}
}
