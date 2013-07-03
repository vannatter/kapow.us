<?php
/**
 * ImprovementFixture
 *
 */
class ImprovementFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'improve_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'improve_type' => array('type' => 'integer', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'improve_id' => 1,
			'improve_type' => 1,
			'user_id' => 1,
			'admin_user_id' => 1,
			'created' => '2013-07-03 22:24:11',
			'modified' => '2013-07-03 22:24:11'
		),
	);

}
