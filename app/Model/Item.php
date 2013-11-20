<?php
App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');

/**
 * Item Model
 *
 * @property Section $Section
 * @property Publisher $Publisher
 * @property Series $Series
 * @property ItemCreator $ItemCreator
 * @property ItemTag $ItemTag
 */
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
	
	function getRandomItems($limit=10) {
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

		$contain = array(
			'Section',
			'Publisher',
			'Series',
			'Pull',
			'ItemCreator' => array(
				'Creator'
			),
			'ItemTag' => array(
				'Tag'
			)
		);

		return $this->find('all', array(
			'conditions' => array(
				'Item.img_fullpath <> ' => '/img/covers',
				'Item.item_date' => $date,
				'Section.category_id' => 1
			),
			'limit'=> $limit,
			'order' => array(
				'Item.hot DESC',
				'RAND()'
			),
			'contain' => $contain
		));
	}

	function getRandom() {
		return $this->find('first', array('order' => array('RAND()')));
	}

	function getItemForDisplay($itemId=null) {
		if($itemId) {
			$this->ItemCreator->Creator->bindModel(array(
				'hasOne' => array(
					'UserFavorite' => array(
						'foreignKey' => 'favorite_item_id',
						'conditions' => array(
							'UserFavorite.user_id' => CakeSession::read('Auth.User.id'),
							'UserFavorite.item_type' => 3
						)
					)
				)
			));

			$this->Publisher->bindModel(array(
				'hasOne' => array(
					'UserFavorite' => array(
						'foreignKey' => 'favorite_item_id',
						'conditions' => array(
							'UserFavorite.user_id' => CakeSession::read('Auth.User.id'),
							'UserFavorite.item_type' => 4
						)
					)
				)
			));

			$this->Series->bindModel(array(
				'hasOne' => array(
					'UserFavorite' => array(
						'foreignKey' => 'favorite_item_id',
						'conditions' => array(
							'UserFavorite.user_id' => CakeSession::read('Auth.User.id'),
							'UserFavorite.item_type' => 2
						)
					)
				)
			));

			$this->bindModel(array(
				'hasMany' => array(
					'UserFavorite' => array(
						'foreignKey' => 'favorite_item_id',
						'conditions' => array(
							'item_type' => 1
						),
						'limit' => 25,
						'order' => 'RAND()'
					)
				)
			));
			$this->UserFavorite->bindModel(array(
				'belongsTo' => array(
					'User' => array(
						'fields' => array('id', 'email', 'username')
					)
				)
			));

			$this->bindModel(array(
				'hasOne' => array(
					'Pull' => array(
						'conditions' => array(
							'Pull.user_id' => CakeSession::read('Auth.User.id')
						)
					),
					'UserItem' => array(
						'conditions' => array(
							'UserItem.user_id' => CakeSession::read('Auth.User.id')
						)
					)
				)
			));

			$item = $this->find('first', array(
				'conditions' => array(
					'Item.id' => $itemId
				),
				'limit' => 1,
				'contain' => array(
					'Section' => array(
						'Category'
					),
					'Publisher' => array(
						'UserFavorite'
					),
					'Series' => array(
						'UserFavorite'
					),
					'ItemCreator' => array(
						'Creator' => array(
							'UserFavorite'
						),
						'CreatorType'
					),
					'ItemTag' => array(
						'Tag'
					),
					'Pull',
					'UserItem',
					'UserFavorite' => array(
						'User'
					)
				)
			));

			if($item) {
				## get a distinct set of creators for the 'favorites' logic..
				$unique_creators = array();
				foreach ($item['ItemCreator'] as $c) {
					$fav = false;

					if(isset($c['Creator']['UserFavorite']['id'])) {
						$fav = true;
					}

					$unique_creators[$c['Creator']['id']] = array('name' => $c['Creator']['creator_name'], 'is_fav' => $fav);
				}

				$item['UniqueCreators'] = $unique_creators;
			}

			return $item;
		}

		return null;
	}
}
