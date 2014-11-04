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
		if ($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => __('Invalid'));

			$id = $this->request->query['id'];

			## make sure user id logged in
			if ($this->Auth->user()) {
				## make sure item is valid
				if ($item = $this->Pull->Item->findById($id)) {
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

	public function myRemove($pullId=null) {
		if ($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => __('Invalid'), 'type' => 1);

			$pullId = $this->request->query['id'];

			if ($this->Auth->user()) {
				## make sure the this item belongs to the user
				if ($pull = $this->Pull->find('first', array('conditions' => array('Pull.id' => $pullId), 'recursive' => -1))) {
					if ($pull['Pull']['user_id'] == $this->Auth->user('id')) {
						$this->Pull->delete($pullId);

						$result['error'] = false;
						$result['message'] = '';
					} else {
						$result['message'] = __('Invalid User');
					}
				} else {
					$result['message'] = __('Invalid');
				}
			} else {
				$result['message'] = __('Not Logged In!');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		} else {
			parent::hasSession();

			debug($pullId);
			exit;
		}
	}
}