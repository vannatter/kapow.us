<?php
App::uses('HomeController', 'Controller');

/**
 * HomeController Test Case
 *
 */
class HomeControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Test index method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/home/index', array('return' => 'vars'));
		$this->assertNotEmpty($result);
	}

/**
 * Test index renders correctly
 *
 * @return void
 */
	public function testIndexRendersView() {
		$result = $this->testAction('/home/index', array('return' => 'view'));
		$this->assertNotEmpty($result);
	}

/**
 * Test about page
 *
 * @return void
 */
	public function testAbout() {
		$result = $this->testAction('/home/about', array('return' => 'view'));
		$this->assertNotEmpty($result);
	}

}
