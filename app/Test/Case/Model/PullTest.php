<?php
App::uses('Pull', 'Model');

/**
 * Pull Test Case
 *
 */
class PullTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pull',
		'app.user',
		'app.user_favorite',
		'app.item',
		'app.section',
		'app.category',
		'app.publisher',
		'app.series',
		'app.item_creator',
		'app.creator',
		'app.creator_type',
		'app.item_tag',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pull = ClassRegistry::init('Pull');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pull);

		parent::tearDown();
	}

}
