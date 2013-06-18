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
		//$this->layout = "plain";

		$blog = $this->Blog->getLatestEntry();
		$this->set('blog', $blog);

		$item = $this->Item->getRandomItemByDate();
		$this->set('item', $item);

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
	}
}

?>