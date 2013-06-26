<?php
class ImproveItem extends CakeMigration {

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
					'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'id'),
					'section_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'item_id'),
					'section_id_new' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'section_id'),
					'publisher_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'section_id_new'),
					'publisher_id_new' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'publisher_id'),
					'series_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'publisher_id_new'),
					'series_id_new' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'series_id'),
					'stock_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'series_id_new'),
					'stock_id_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'stock_id'),
					'printing' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'stock_id_new'),
					'printing_new' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'printing'),
					'item_date' => array('type' => 'date', 'null' => true, 'default' => NULL, 'after' => 'printing_new'),
					'item_date_new' => array('type' => 'date', 'null' => true, 'default' => NULL, 'after' => 'item_date'),
					'item_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'item_date_new'),
					'item_name_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'item_name'),
					'series_num' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'item_name_new'),
					'series_num_new' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'after' => 'series_num'),
					'img_fullpath' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'series_num_new'),
					'img_fullpath_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'img_fullpath'),
					'srp' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'img_fullpath_new'),
					'srp_new' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'srp'),
					'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'srp_new'),
					'description_new' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'description'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'description_new'),
					'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'user_id'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'admin_user_id'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'created'),
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
			),
			'alter_field' => array(
				'items' => array(
					'item_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				),
			),
			'create_field' => array(
				'items' => array(
					'indexes' => array(
						'item_id' => array('column' => 'item_id', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'improve_items'
			),
			'alter_field' => array(
				'items' => array(
					'item_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				),
			),
			'drop_field' => array(
				'items' => array('', 'indexes' => array('item_id')),
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
