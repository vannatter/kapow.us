<?php
App::uses('UserStore', 'Model');

/**
 * UserStore Test Case
 *
 */
class UserStoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_store',
		'app.user',
		'app.user_favorite',
		'app.store',
		'app.hour',
		'app.store_photo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserStore = ClassRegistry::init('UserStore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserStore);

		parent::tearDown();
	}

}
