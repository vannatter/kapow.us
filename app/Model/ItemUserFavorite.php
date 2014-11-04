<?php
App::uses('AppModel', 'Model');
/**
 * ItemUserFavorite Model
 *
 * @property Item $Item
 * @property User $User
 * @property UserFavorite $UserFavorite
 */
class ItemUserFavorite extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
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
		),
		'UserFavorite' => array(
			'className' => 'UserFavorite',
			'foreignKey' => 'user_favorite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function removeByFavoriteId($favId) {
		if ($fav = $this->findByUserFavoriteId($favId)) {
			$this->deleteAll(array('ItemUserFavorite.user_favorite_id' => $favId));
		}
	}

	public function add($userId, $itemId, $typeId, $favId) {
		$toAdd = array(
			'ItemUserFavorite' => array(
				'item_id' => $itemId,
				'user_id' => $userId,
				'favorite_type_id' => $typeId,
				'user_favorite_id' => $favId
			)
		);

		$this->create();
		$this->save($toAdd);
	}
}
