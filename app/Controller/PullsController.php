<?php

App::uses('AppController', 'Controller');

/**
 * @property Pull $Pull
 */
class PullsController extends AppController {
	public $name = 'Pulls';
	public $uses = array('Pull');

	public function index() {
		$this->redirect('/', 301);
	}

	public function toggle($id=null) {
		if($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => __('Invalid'));

			$id = $this->request->query['id'];

			## make sure user id logged in
			if($this->Auth->user()) {
				## make sure item is valid
				if($item = $this->Pull->Item->findById($id)) {
					$result['type'] = $this->Pull->toggle($id, $this->Auth->user('id'));
					$result['error'] = false;
				} else {
					$result['message'] = __('Item Not Found');
				}
			} else {
				$result['message'] = __('Not logged in; %s or %s', '<a href="/users/login">login</a>', '<a href="/users/register">create an account</a>');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		} else {
			debug($id);
			exit;
		}
	}
}