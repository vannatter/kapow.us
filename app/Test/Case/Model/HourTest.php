<?php
App::uses('Hour', 'Model');

/**
 * Hour Test Case
 *
 */
class HourTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hour',
		'app.store'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Hour = ClassRegistry::init('Hour');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hour);

		parent::tearDown();
	}

}
