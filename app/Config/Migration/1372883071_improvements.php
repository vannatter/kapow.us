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
				'improvements' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'improve_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'id'),
					'improve_type' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'improve_id'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'improve_type'),
					'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'user_id'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'admin_user_id'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'after' => 'created'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'improvements'
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
