<?php
class AddedItemUserFavorites extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'item_user_favorites' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'id'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'item_id'),
					'favorite_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'user_id'),
					'user_favorite_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'favorite_type_id'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'user_favorite_id'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'created'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'item_id' => array('column' => 'item_id', 'unique' => 0),
						'user_id' => array('column' => 'user_id', 'unique' => 0),
						'favorite_type_id' => array('column' => 'favorite_type_id', 'unique' => 0),
						'user_favorite_id' => array('column' => 'user_favorite_id', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'item_user_favorites'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
