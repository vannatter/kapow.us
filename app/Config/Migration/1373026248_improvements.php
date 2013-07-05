<?php
class Improvements extends CakeMigration {

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
				'improve_items' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'section_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'section_id_new' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'publisher_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'publisher_id_new' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'series_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'series_id_new' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'stock_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'stock_id_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'printing' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'printing_new' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'item_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
					'item_date_new' => array('type' => 'date', 'null' => true, 'default' => NULL),
					'item_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'item_name_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'series_num' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'series_num_new' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'img_fullpath' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'img_fullpath_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'srp' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'srp_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'description_new' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'item_id' => array('column' => 'item_id', 'unique' => 0),
						'user_id' => array('column' => 'user_id', 'unique' => 0),
						'admin_user_id' => array('column' => 'admin_user_id', 'unique' => 0),
						'created' => array('column' => 'created', 'unique' => 0),
						'modified' => array('column' => 'modified', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
				'improvements' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'improve_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'improve_type' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'improve_items', 'improvements'
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
