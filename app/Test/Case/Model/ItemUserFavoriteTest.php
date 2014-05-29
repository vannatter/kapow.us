<?php
App::uses('ItemUserFavorite', 'Model');

/**
 * ItemUserFavorite Test Case
 *
 */
class ItemUserFavoriteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_user_favorite',
		'app.item',
		'app.section',
		'app.category',
		'app.publisher',
		'app.series',
		'app.item_creator',
		'app.creator',
		'app.creator_type',
		'app.item_tag',
		'app.tag',
		'app.user',
		'app.user_favorite',
		'app.user_vendor',
		'app.vendor',
		'app.vendor_store',
		'app.store',
		'app.hour',
		'app.store_photo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemUserFavorite = ClassRegistry::init('ItemUserFavorite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemUserFavorite);

		parent::tearDown();
	}

}
