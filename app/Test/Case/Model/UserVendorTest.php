<?php
App::uses('UserVendor', 'Model');

/**
 * UserVendor Test Case
 *
 */
class UserVendorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_vendor',
		'app.user',
		'app.user_favorite',
		'app.vendor',
		'app.vendor_store'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserVendor = ClassRegistry::init('UserVendor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserVendor);

		parent::tearDown();
	}

}
