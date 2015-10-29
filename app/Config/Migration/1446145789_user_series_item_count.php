<?php
class UserSeriesItemCount extends CakeMigration {

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
				'user_series' => array(
					'item_count' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'user_id'),
					'indexes' => array(
						'item_count' => array('column' => 'item_count', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'user_series' => array('item_count', 'indexes' => array('item_count')),
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
