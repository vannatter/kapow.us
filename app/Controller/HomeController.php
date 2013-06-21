<?php
App::uses('AppController', 'Controller');

/**
 * @property Blog $Blog
 * @property Item $Item
 */
class HomeController extends AppController {
	public $name = 'Home';
	public $uses = array('Blog', 'Item', 'Creator');

	public function index() {

		$blog = $this->Blog->getLatestEntry();
		$this->set('blog', $blog);

		$this->Item->bindModel(array(
			'hasOne' => array(
				'Pull' => array(
					'conditions' => array(
						'Pull.user_id' => $this->Auth->user('id')
					)
				)
			)
		));

		$item = $this->Item->getRandomItemByDate();
		$this->set('random_item', $item);
		
		$ticker = null;
		$tapeTypes = array('item', 'creator');

		switch($tapeTypes[array_rand($tapeTypes)]) {
			case 'item':
				$ticker = $this->Item->getRandom();
				break;
			case 'creator':
				$ticker = $this->Creator->getRandom();
				break;
		}
		$this->set('ticker', $ticker);
		
		$this->set('types', array(
			'1' => __('Item'),
			'2' => __('Publisher'),
			'3' => __('Creator'),
			'4' => __('Series')
		));
		
		// dynamically set this, or set it from a collection
		$this->set('welcome', 'Welcome to Kapow!');
				
	}
	
	public function about() {
		
	}
	
	public function contact() {
		
	}
	
	public function tos() {
		
	}
	
	public function privacy() {
		
	}
	
}

?>