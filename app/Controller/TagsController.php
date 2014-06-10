<?php

App::uses('AppController', 'Controller');

/**
 * @property Tag $Tag
 */
class TagsController extends AppController {
	public $name = 'Tags';
	public $uses = array('Tag', 'ItemTag');

	public function index() {
		$this->paginate = array(
			'Tag' => array(
				'limit' => '10',			
				'contain' => array(
					'ItemTag' => array(
						'Item',
						'limit' => 6
					),
				)
			)
		);

		$tags = $this->paginate('Tag');
		$this->set('tags', $tags);
	}

	public function view($id, $name) {
		$this->Tag->id = $id;
		if(!$this->Tag->exists()) {
			$this->Session->setFlash(__('Tag Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/tags');
		}

		$this->paginate = array(
			'ItemTag' => array(
				'limit' => 24,
				'contain' => 'Item',
				'order' => array('Item.id' => 'desc')
			)
		);
		

		$items = $this->paginate('ItemTag', array('ItemTag.tag_id' => $id));
		$this->set('items', $items);
		$this->set('tagged', $items[0]['Tag']['tag_name']);
	}

	public function viewById($id) {
		if($tag = $this->Tag->findById($id)) {
			$this->redirect(sprintf('/tags/%s', parent::seoize($id, $tag['Tag']['tag_name'])), 301);
		}
	}
}