<?php
App::uses('UserFavorite', 'Model');

/**
 * UserFavorite Test Case
 *
 */
class UserFavoriteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_favorite',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserFavorite = ClassRegistry::init('UserFavorite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserFavorite);

		parent::tearDown();
	}

}
