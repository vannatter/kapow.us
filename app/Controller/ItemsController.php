<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

	public $name = 'Items';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator','Category');
	public $paginate = array(
		'Item' => array(
			'limit' => 24,
			'order' => array('Item.id' => 'desc')
		)
	);

	public function index() {
		#$this->redirect("/items/this_week");
		#exit;

		$this->Item->recursive = 0;
		$this->set('items', $this->paginate('Item'));
	}
	
	public function detail($item_id, $item_name) {
		if (!$item_id) {
			$this->Session->setFlash('Item ID not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}

		$item = $this->Item->find('first', array('conditions' => array('Item.id' => $item_id), 'limit' => 1, 'recursive' => 4));
		if (!$item) {
			$this->Session->setFlash('Item not found.', 'flash_neg');
			$this->redirect("/");
			exit;
		}
		
		## get a distinct set of creators for the 'favorites' logic..
		$unique_creators = array();
	    foreach ($item['ItemCreator'] as $c) {
		    $unique_creators[$c['Creator']['id']] = $c['Creator']['creator_name'];
	    }

		$this->set('unique_creators', $unique_creators);
		$this->set('item', $item);
		$this->set('title_for_layout', $item['Item']['item_name']);
	}

	public function next_week($content_type="1") {
		$first_day = date("N", strtotime("today"));
		if ($first_day < 3) {
			$release_date = date("Y-m-d", strtotime("+2 wednesdays"));
		}
		if ($first_day == 3) {
			$release_date = date("Y-m-d", strtotime("+1 week"));
		}
		if ($first_day == 4) {
			$release_date = date("Y-m-d", strtotime("+6 days"));
		}
		if ($first_day > 4) {
			$release_date = date("Y-m-d", strtotime("this wednesday"));
		}
	
		$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
		$this->set('release_date_formatted', date("m/d/Y", strtotime($release_date)));
		$this->set('title_for_layout','New Next Week (' . date("m/d/Y", strtotime($release_date)) . ')');
	}

	public function this_week($content_type="1") {
		$first_day = date("N", strtotime("today"));
		if ($first_day < 3) {
			$release_date = date("Y-m-d", strtotime("this wednesday"));
		}
		if ($first_day == 3) {
			$release_date = date("Y-m-d", strtotime("today"));
		}
		if ($first_day == 4) {
			$release_date = date("Y-m-d", strtotime("yesterday"));
		}
		if ($first_day > 4) {
			$release_date = date("Y-m-d", strtotime("last wednesday"));
		}

		$this->paginate = array(
			'conditions' => array(
				'Item.item_date' => $release_date,
				'Section.category_id' => $content_type
			),
			'limit' => 24,
			'recursive' => 4
		);

		$items = $this->paginate('Item');

		#$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date, 'Section.category_id' => $content_type), 'limit' => 2500, 'recursive' => 4));
		$categories = $this->Category->find('all', array('limit' => 2500, 'recursive' => -1));
		
		$this->set('items', $items);
		$this->set('categories', $categories);
		$this->set('content_type', $content_type);
		$this->set('release_date_formatted', date("m/d/Y", strtotime($release_date)));
		$this->set('title_for_layout','New This Week (' . date("m/d/Y", strtotime($release_date)) . ')');
	}

	public function viewById($id) {
		if($item = $this->Item->findById($id)) {
			$this->redirect(sprintf('/items/%s', parent::seoize($id, $item['Item']['item_name'])), 301);
		}
	}
}
?>