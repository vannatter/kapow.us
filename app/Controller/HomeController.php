<?php
App::uses('AppController', 'Controller');

/**
 * @property Blog $Blog
 * @property Item $Item
 */
class HomeController extends AppController {
	public $name = 'Home';
	public $uses = array('Blog', 'Item');

	public function index() {
//		$this->layout = "plain";

		$this->paginate = array(
			'Blog' => array(
				'limit' => '5',
				'order' => array(
					'Blog.created' => 'ASC'
				)
			)
		);

		$this->set('blogs', $this->paginate('Blog'));

		$item = $this->Item->getRandomItemByDate();
	//	debug($item);
	}
}

?>