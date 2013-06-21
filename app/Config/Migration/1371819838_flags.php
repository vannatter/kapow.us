<?php
class Flags extends CakeMigration {

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
				'flags' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'id'),
					'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => '0=unread,1=open,99=closed', 'after' => 'user_id'),
					'item_type' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'comment' => '1=item,2=series,3=creator,4=publisher,5=store', 'after' => 'status'),
					'flag_item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'item_type'),
					'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'after' => 'flag_item_id'),
					'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'after' => 'description'),
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
				'flags'
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
