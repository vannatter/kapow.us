<?php
App::uses('AppMessage', 'Model');

/**
 * AppMessage Test Case
 *
 */
class AppMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.app_message',
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
		$this->AppMessage = ClassRegistry::init('AppMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AppMessage);

		parent::tearDown();
	}

}
