<?php
class Merge extends CakeMigration {

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
				'item_creators' => array(
					'creator_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
				),
				'item_tags' => array(
					'item_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
					'tag_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
				),
				'items' => array(
					'status' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4, 'key' => 'index'),
					'section_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'publisher_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
				),
				'publishers' => array(
					'status' => array('type' => 'integer', 'null' => true, 'default' => '0'),
					'publisher_photo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'publisher_bio' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				),
				'pulls' => array(
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
					'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
				),
				'store_photos' => array(
					'active' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4),
					'primary' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
				),
				'stores' => array(
					'twitter_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'ebay_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 400, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
				'users' => array(
					'user_bio' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_fullname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_website' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_facebook' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_twitter' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
			),
			'create_field' => array(
				'item_creators' => array(
					'indexes' => array(
						'creator_type_id' => array('column' => 'creator_type_id', 'unique' => 0),
					),
				),
				'item_tags' => array(
					'indexes' => array(
						'item_id' => array('column' => 'item_id', 'unique' => 0),
						'tag_id' => array('column' => 'tag_id', 'unique' => 0),
					),
				),
				'items' => array(
					'combo_pack' => array('type' => 'integer', 'null' => true, 'default' => '0', 'after' => 'printing'),
					'indexes' => array(
						'section_id' => array('column' => 'section_id', 'unique' => 0),
						'status' => array('column' => 'status', 'unique' => 0),
						'publisher_id' => array('column' => 'publisher_id', 'unique' => 0),
					),
				),
				'pulls' => array(
					'indexes' => array(
						'user_id' => array('column' => 'user_id', 'unique' => 0),
						'item_id' => array('column' => 'item_id', 'unique' => 0),
					),
				),
				'series' => array(
					'status' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4, 'after' => 'description'),
				),
				'store_photos' => array(
					'indexes' => array(
						'primary_2' => array('column' => 'primary', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'item_creators' => array(
					'creator_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
				),
				'item_tags' => array(
					'item_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
					'tag_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
				),
				'items' => array(
					'status' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
					'section_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'publisher_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
				),
				'publishers' => array(
					'status' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'publisher_photo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'publisher_bio' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				),
				'pulls' => array(
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
					'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
				),
				'store_photos' => array(
					'primary' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'active' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
				),
				'stores' => array(
					'twitter_url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'ebay_url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 400, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
				'users' => array(
					'user_bio' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_fullname' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_website' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_facebook' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'user_twitter' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
			),
			'drop_field' => array(
				'item_creators' => array('', 'indexes' => array('creator_type_id')),
				'item_tags' => array('', 'indexes' => array('item_id', 'tag_id')),
				'items' => array('combo_pack', 'indexes' => array('section_id', 'status', 'publisher_id')),
				'pulls' => array('', 'indexes' => array('user_id', 'item_id')),
				'series' => array('status',),
				'store_photos' => array('', 'indexes' => array('primary_2')),
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
