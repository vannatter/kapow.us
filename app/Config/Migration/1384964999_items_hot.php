<?php
class ItemsHot extends CakeMigration {

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
			'create_field' => array(
				'items' => array(
					'hot' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'comment' => 'weight of how \'hot\' an item is', 'after' => 'thumbnails_processed'),
					'indexes' => array(
						'hot' => array('column' => 'hot', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'items' => array('hot', 'indexes' => array('hot')),
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
