<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

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

		$items = $this->Item->getRandomItems(5);
		$this->set('random_items', $items);
		
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
		$this->set('title_for_layout', '');

		$this->set('og_image', 'http://kapow.us/img/kapow_fb.png');
	}
	
	public function about() {
		$this->set('title_for_layout', 'About Us');
	}
	
	public function contact() {
		$this->set('title_for_layout', 'Contact Us');
	}
	
	public function contact_submit() {
		$email = new CakeEmail('default');
		$email->template('contact');
		$email->emailFormat('html');
		$email->from('info@kapow.us');
		$email->to('info@kapow.us');
		$email->subject('Kapow! Contact');
		$email->viewVars(array('email'=>$_POST['email'], 'emailVars'=>$_POST));
		$email->send();

		$this->Session->setFlash('Email sent, we\'ll be in touch!', 'flash_pos');
		$this->redirect("/");
		exit;
	}
	
	public function tos() {
		$this->set('title_for_layout', 'Terms of Service');
	}
	
	public function privacy() {
		$this->set('title_for_layout', 'Privacy Policy');
	}


	public function random_item() {

		$this->layout = 'blank';
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