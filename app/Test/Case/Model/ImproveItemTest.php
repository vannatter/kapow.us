<?php
App::uses('ImproveItem', 'Model');

/**
 * ImproveItem Test Case
 *
 */
class ImproveItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.improve_item',
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
		$this->ImproveItem = ClassRegistry::init('ImproveItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ImproveItem);

		parent::tearDown();
	}

}
