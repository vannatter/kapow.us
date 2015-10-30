<?php
App::uses('AppModel', 'Model');
/**
 * UserItem Model
 *
 * @property User $User
 * @property Item $Item
 */
class UserItem extends AppModel {
	public $actsAs = array('Containable');

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

		if ($ui = $this->findByItemIdAndUserId($id, $userId)) {
			$this->delete($ui['UserItem']['id']);
			$return = 2;
		} else {
			## add item
			$toAdd = array(
				'UserItem' => array(
					'item_id' => $id,
					'user_id' => $userId
				)
			);

			$this->create($toAdd);
			if ($this->save($toAdd)) {
				$return = 1;
			}
		}

		return $return;
	}
	
	## this function is here so we can paginate a standard query
	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {    
    $recursive = -1;
    
    // Mandatory to have
    $this->useTable = false;
    $sql = '';
    
    $sql .= sprintf("
    SELECT Item.*, Series.series_name, UserItem.*
		FROM user_items AS UserItem
		LEFT JOIN items AS Item ON Item.id = UserItem.item_id
		LEFT JOIN series AS Series ON Series.id = Item.series_id
		WHERE %s
		ORDER BY Series.series_name, Item.series_num DESC
		LIMIT
		",
		$conditions[0]
		);
    
    // Adding LIMIT Clause
    $sql .= (($page - 1) * $limit) . ', ' . $limit;
    
    $results = $this->query($sql);
    
    return $results;
  }
  
  ## this function is here so we can paginate a standard query
  public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
    $sql = '';
    
    $sql .= sprintf("
    SELECT Item.*, Series.series_name, UserItem.*
		FROM user_items AS UserItem
		LEFT JOIN items AS Item ON Item.id = UserItem.item_id
		LEFT JOIN series AS Series ON Series.id = Item.series_id
		WHERE %s
		ORDER BY Series.series_name, Item.series_num DESC
		",
		$conditions[0]
		);
        
    $this->recursive = $recursive;
    
    $results = $this->query($sql);
    
    return count($results);
  }
}
