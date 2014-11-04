<?php
App::uses('AppModel', 'Model');
/**
 * UserFavorite Model
 *
 * @property User $User
 * @property ItemUserFavorite $ItemUserFavorite
 */
class UserFavorite extends AppModel {
	public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'favorite_item_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'item_type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public function toggle($userId, $id, $type, $forceAdd=0) {
		$returnType = 1;   ## ADD

		## if the fav already exists, remove it
		if ($fav = $this->find('first', array('conditions' => array('UserFavorite.user_id' => $userId, 'UserFavorite.favorite_item_id' => $id, 'UserFavorite.item_type' => $type), 'recursive' => -1))) {
			if (!$forceAdd) {   ## special logic for when forcing a type
				## remove
				$this->delete($fav['UserFavorite']['id']);

				$this->bindModel(array('hasOne' => array('ItemUserFavorite')));
				$this->ItemUserFavorite->removeByFavoriteId($fav['UserFavorite']['id']);

				$returnType = 2;   ## REMOVE
			}
		} else {
			## add
			$toAdd = array(
				'UserFavorite' => array(
					'user_id' => $userId,
					'favorite_item_id' => $id,
					'item_type' => $type
				)
			);

			$this->create($toAdd);
			$this->save($toAdd);

			$this->bindModel(array('hasOne' => array('ItemUserFavorite')));
			switch($type) {
				case 2:
					$this->bindModel(array('hasOne' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
					if ($items = $this->Item->find('list', array('conditions' => array('Item.series_id' => $id), 'fields' => array('id')))) {
						foreach($items as $item) {
							$this->ItemUserFavorite->add($userId, $item, 2, $this->id);
						}
					}

					break;
				case 3:
					$this->bindModel(array('hasOne' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
					if ($items = $this->Item->ItemCreator->find('list', array('conditions' => array('ItemCreator.creator_id' => $id), 'fields' => array('item_id')))) {
						foreach($items as $item) {
							$this->ItemUserFavorite->add($userId, $item, 3, $this->id);
						}
					}

					break;
				case 4:
					$this->bindModel(array('hasOne' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
					if ($items = $this->Item->find('list', array('conditions' => array('Item.publisher_id' => $id), 'fields' => array('id')))) {
						foreach($items as $item) {
							$this->ItemUserFavorite->add($userId, $item, 4, $this->id);
						}
					}

					break;
			}
		}

		return $returnType;
	}
}
