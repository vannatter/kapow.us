<?php
App::uses('UserItem', 'Model');

/**
 * UserItem Test Case
 *
 */
class UserItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_item',
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
		$this->UserItem = ClassRegistry::init('UserItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserItem);

		parent::tearDown();
	}

}
