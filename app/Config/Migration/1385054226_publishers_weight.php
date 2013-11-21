<?php
class PublishersWeight extends CakeMigration {

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
				'publishers' => array(
					'weight' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index', 'after' => 'locked_by_user_id'),
					'indexes' => array(
						'weight' => array('column' => 'weight', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'publishers' => array('weight', 'indexes' => array('weight')),
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
