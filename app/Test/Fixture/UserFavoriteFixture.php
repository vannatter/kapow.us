<?php
/**
 * UserFavoriteFixture
 *
 */
class UserFavoriteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'favorite_item_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'item_type' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '1=item,2=series,3=creator,4=publisher,5=store'),
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
			'user_id' => 1,
			'favorite_item_id' => 1,
			'item_type' => 1,
			'created' => '2013-04-10 21:26:10',
			'modified' => '2013-04-10 21:26:10'
		),
	);

}
