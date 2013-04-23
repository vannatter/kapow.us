<?php

App::uses('AppController', 'Controller');

/**
 * @property Blog $Blog
 */
class BlogsController extends AppController {
	public $name = 'Blogs';
	public $uses = array('Blog');
	public $paginate = array(
		'Blog' => array(
			'order' => array('Blog.created' => 'DESC'),
			'limit' => 5
		)
	);

	public function index() {
		$this->Blog->recursive = 0;
		$this->set('blogs', $this->paginate('Blog'));
	}

	public function view($id, $name) {
		$this->Blog->id = $id;
		if(!$this->Blog->exists()) {
			$this->Session->setFlash(__('Not Found'));
			$this->redirect('/');
		}

		$this->set('blog', $this->Blog->read());
	}

	public function viewById($id) {
		if($blog = $this->Blog->findById($id)) {
			$this->redirect(sprintf('/blogs/%s', parent::seoize($id, $blog['Blog']['title'])), 301);
		}
	}
}