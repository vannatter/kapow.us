<?php
App::uses('Flag', 'Model');

/**
 * Flag Test Case
 *
 */
class FlagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.flag',
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
		$this->Flag = ClassRegistry::init('Flag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Flag);

		parent::tearDown();
	}

}
