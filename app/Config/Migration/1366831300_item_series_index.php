<?php
class ItemSeriesIndex extends CakeMigration {

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
			'alter_field' => array(
				'items' => array(
					'series_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
				),
			),
			'create_field' => array(
				'items' => array(
					'indexes' => array(
						'series_id' => array('column' => 'series_id', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'items' => array(
					'series_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
				),
			),
			'drop_field' => array(
				'items' => array('', 'indexes' => array('series_id')),
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
