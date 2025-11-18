<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

/**
 * Test email validation
 *
 * @return void
 */
	public function testEmailValidation() {
		$data = array(
			'User' => array(
				'email' => 'invalid-email',
				'password' => 'hashedpassword',
			)
		);

		$this->User->set($data);
		$this->assertFalse($this->User->validates());
		$this->assertArrayHasKey('email', $this->User->validationErrors);
	}

/**
 * Test valid email passes validation
 *
 * @return void
 */
	public function testValidEmailPassesValidation() {
		$data = array(
			'User' => array(
				'email' => 'test@example.com',
				'password' => 'hashedpassword',
			)
		);

		$this->User->set($data);
		$result = $this->User->validates(array('fieldList' => array('email', 'password')));
		$this->assertTrue($result);
	}

/**
 * Test password is required
 *
 * @return void
 */
	public function testPasswordRequired() {
		$data = array(
			'User' => array(
				'email' => 'test@example.com',
				'password' => '',
			)
		);

		$this->User->set($data);
		$this->assertFalse($this->User->validates());
		$this->assertArrayHasKey('password', $this->User->validationErrors);
	}

/**
 * Test model instance
 *
 * @return void
 */
	public function testUserInstance() {
		$this->assertInstanceOf('User', $this->User);
		$this->assertEquals('User', $this->User->name);
	}

}
