<?php
/**
 * ItemUserFavoriteFixture
 *
 */
class ItemUserFavoriteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'favorite_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_favorite_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'item_id' => array('column' => 'item_id', 'unique' => 0),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'favorite_type_id' => array('column' => 'favorite_type_id', 'unique' => 0),
			'user_favorite_id' => array('column' => 'user_favorite_id', 'unique' => 0)
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
			'item_id' => 1,
			'user_id' => 1,
			'favorite_type_id' => 1,
			'user_favorite_id' => 1,
			'created' => '2014-05-29 19:04:59',
			'modified' => '2014-05-29 19:04:59'
		),
	);

}
