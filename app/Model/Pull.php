<?php
App::uses('AppModel', 'Model');
/**
 * Pull Model
 *
 * @property User $User
 * @property Item $Item
 */
class Pull extends AppModel {


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
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function toggle($id, $userId) {
		$return = 1;

		if($pull = $this->findByItemIdAndUserId($id, $userId)) {
			## remove pull
			$this->delete($pull['Pull']['id']);
			$return = 2;
		} else {
			## add pull
			$toAdd = array(
				'Pull' => array(
					'item_id' => $id,
					'user_id' => $userId
				)
			);

			$this->create($toAdd);
			if($this->save($toAdd)) {
				$return = 1;
			}
		}

		return $return;
	}
}
