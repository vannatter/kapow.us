<?php
App::uses('VendorStore', 'Model');

/**
 * VendorStore Test Case
 *
 */
class VendorStoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vendor_store',
		'app.vendor',
		'app.store',
		'app.hour',
		'app.store_photo',
		'app.user',
		'app.user_favorite'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->VendorStore = ClassRegistry::init('VendorStore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VendorStore);

		parent::tearDown();
	}

}
