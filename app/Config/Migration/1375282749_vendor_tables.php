<?php
class VendorTables extends CakeMigration {

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
				'user_vendors' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'id'),
					'vendor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'user_id'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'vendor_id'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'created'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
				'vendor_stores' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'vendor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'id'),
					'store_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'vendor_id'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'store_id'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'created'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
				'vendors' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'id'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'name'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'created'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
			),
			'alter_field' => array(
				'users' => array(
					'facebook_id' => array('type' => 'biginteger', 'null' => false, 'default' => NULL, 'key' => 'index'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'user_vendors', 'vendor_stores', 'vendors'
			),
			'alter_field' => array(
				'users' => array(
					'facebook_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'index'),
				),
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
