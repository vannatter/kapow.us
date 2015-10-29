<?php
App::uses('AppModel', 'Model');
/**
 * UserSeries Model
 *
 * @property Series $Series
 * @property User $User
 */
class UserSeries extends AppModel {
	public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Series' => array(
			'className' => 'Series',
			'foreignKey' => 'series_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function add($user_id, $series_id) {
		## make sure the series doesn't already exist for the user
		$check = $this->find('first', array(
			'conditions' => array(
				'UserSeries.series_id' => $series_id,
				'UserSeries.user_id' => $user_id
			)
		));
		
		if (!$check) {
			$toAdd = array(
				'UserSeries' => array(
					'series_id' => $series_id,
					'user_id' => $user_id,
					'item_count' => 1
				)
			);
			
			$this->create();
			$this->save($toAdd);
		} else {
			$this->id = $check['UserSeries']['id'];
			$currentCount = $this->field('item_count');
			$this->saveField('item_count', (int)$currentCount + 1);
		}
	}
	
	public function remove($user_id, $series_id) {
		## make sure the user has a record for the series
		$check = $this->find('first', array(
			'conditions' => array(
				'UserSeries.series_id' => $series_id,
				'UserSeries.user_id' => $user_id
			)
		));
		
		if ($check) {
			$currentCount = (int)$check['UserSeries']['item_count'];
			if ($currentCount == 1) {
				$this->delete($check['UserSeries']['id']);
			} else {
				$this->id = $check['UserSeries']['id'];
				$this->saveField('item_count', $currentCount - 1);
			}
		}
	}
}