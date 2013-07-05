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
		'type' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => '1=item,2=series,3=creator,4=publisher,5=store'),
		'type_item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index', 'comment' => '0=unread,1=open,99=closed'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'type' => array('column' => 'type', 'unique' => 0),
			'type_item_id' => array('column' => 'type_item_id', 'unique' => 0),
			'status' => array('column' => 'status', 'unique' => 0),
			'created' => array('column' => 'created', 'unique' => 0),
			'modified' => array('column' => 'modified', 'unique' => 0)
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
			'type' => 1,
			'type_item_id' => 1,
			'status' => 1,
			'user_id' => 1,
			'admin_user_id' => 1,
			'created' => '2013-07-05 14:12:35',
			'modified' => '2013-07-05 14:12:35',
			'indexes' => '2013-07-05 14:12:35'
		),
	);

}
