<?php
App::uses('ImprovementField', 'Model');

/**
 * ImprovementField Test Case
 *
 */
class ImprovementFieldTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.improvement_field',
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
		$this->ImprovementField = ClassRegistry::init('ImprovementField');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ImprovementField);

		parent::tearDown();
	}

}
