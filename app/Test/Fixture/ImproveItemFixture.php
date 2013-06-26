<?php
/**
 * ImproveItemFixture
 *
 */
class ImproveItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'section_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'section_id_new' => array('type' => 'integer', 'null' => true, 'default' => null),
		'publisher_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'publisher_id_new' => array('type' => 'integer', 'null' => true, 'default' => null),
		'series_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'series_id_new' => array('type' => 'integer', 'null' => true, 'default' => null),
		'stock_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'stock_id_new' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'printing' => array('type' => 'integer', 'null' => true, 'default' => null),
		'printing_new' => array('type' => 'integer', 'null' => true, 'default' => null),
		'item_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'item_date_new' => array('type' => 'date', 'null' => true, 'default' => null),
		'item_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'item_name_new' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'series_num' => array('type' => 'integer', 'null' => true, 'default' => null),
		'series_num_new' => array('type' => 'integer', 'null' => true, 'default' => null),
		'img_fullpath' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'img_fullpath_new' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'srp' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'srp_new' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description_new' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'admin_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'item_id' => array('column' => 'item_id', 'unique' => 0),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'admin_user_id' => array('column' => 'admin_user_id', 'unique' => 0),
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
			'item_id' => 1,
			'section_id' => 1,
			'section_id_new' => 1,
			'publisher_id' => 1,
			'publisher_id_new' => 1,
			'series_id' => 1,
			'series_id_new' => 1,
			'stock_id' => 'Lorem ipsum dolor sit amet',
			'stock_id_new' => 'Lorem ipsum dolor sit amet',
			'printing' => 1,
			'printing_new' => 1,
			'item_date' => '2013-06-26',
			'item_date_new' => '2013-06-26',
			'item_name' => 'Lorem ipsum dolor sit amet',
			'item_name_new' => 'Lorem ipsum dolor sit amet',
			'series_num' => 1,
			'series_num_new' => 1,
			'img_fullpath' => 'Lorem ipsum dolor sit amet',
			'img_fullpath_new' => 'Lorem ipsum dolor sit amet',
			'srp' => 'Lorem ipsum dolor sit amet',
			'srp_new' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'description_new' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_id' => 1,
			'admin_user_id' => 1,
			'created' => '2013-06-26 18:01:51',
			'modified' => '2013-06-26 18:01:51'
		),
	);

}
