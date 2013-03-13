<?php
/**
 * HourFixture
 *
 */
class HourFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'store_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sunday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sunday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'monday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'monday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'tuesday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'tuesday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'wednesday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'wednesday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'thursday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'thursday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'friday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'friday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'saturday_open' => array('type' => 'integer', 'null' => false, 'default' => null),
		'saturday_close' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'store_id' => 1,
			'sunday_open' => 1,
			'sunday_close' => 1,
			'monday_open' => 1,
			'monday_close' => 1,
			'tuesday_open' => 1,
			'tuesday_close' => 1,
			'wednesday_open' => 1,
			'wednesday_close' => 1,
			'thursday_open' => 1,
			'thursday_close' => 1,
			'friday_open' => 1,
			'friday_close' => 1,
			'saturday_open' => 1,
			'saturday_close' => 1,
			'created' => '2013-03-13 15:46:53',
			'modified' => '2013-03-13 15:46:53'
		),
	);

}
