<?php
class UserPrivateProfile extends CakeMigration {

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
				'users' => array(
					'private_profile' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index', 'after' => 'user_twitter'),
					'indexes' => array(
						'private_profile' => array('column' => 'private_profile', 'unique' => 0),
						'facebook_id' => array('column' => 'facebook_id', 'unique' => 0),
						'access_level' => array('column' => 'access_level', 'unique' => 0),
					),
				),
			),
			'alter_field' => array(
				'users' => array(
					'facebook_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'index'),
					'access_level' => array('type' => 'integer', 'null' => false, 'default' => '1', 'key' => 'index', 'comment' => '1=default,99=admin'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'users' => array('private_profile', 'indexes' => array('private_profile', 'facebook_id', 'access_level')),
			),
			'alter_field' => array(
				'users' => array(
					'facebook_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
					'access_level' => array('type' => 'integer', 'null' => false, 'default' => '1', 'comment' => '1=default,99=admin'),
				),
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
