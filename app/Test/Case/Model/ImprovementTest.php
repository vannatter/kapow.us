<?php
App::uses('Improvement', 'Model');

/**
 * Improvement Test Case
 *
 */
class ImprovementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.improvement',
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
		$this->Improvement = ClassRegistry::init('Improvement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Improvement);

		parent::tearDown();
	}

}
