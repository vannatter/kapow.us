<?php

App::uses('AppController', 'Controller');

/**
 * @property UserFavorite $UserFavorite
 */
class FavoritesController extends AppController {
	public $name = 'Favorites';
	public $uses = array('UserFavorite');

	public function index() {
		$favs = $this->UserFavorite->find('all');
		debug($favs);
		exit;

		$this->redirect('/', 301);
	}

	public function add($id=null, $type=null) {
		if($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => __('Invalid'), 'type' => 1);

			$type = $this->request->query['type'];
			$id = $this->request->query['id'];

			## make sure use is logged in
			## 1=item,2=series,3=creator,4=publisher,5=store
			if($this->Auth->user()) {
				switch(strtoupper($type)) {
					case 'CREATOR':
						$result['type'] = $this->UserFavorite->toggle($this->Auth->user('id'), $id, 3);
						$result['error'] = false;
						break;
					case 'PUBLISHER':
						$result['type'] = $this->UserFavorite->toggle($this->Auth->user('id'), $id, 4);
						$result['error'] = false;
						break;
					case 'SERIES':
						$result['type'] = $this->UserFavorite->toggle($this->Auth->user('id'), $id, 2);
						$result['error'] = false;
						break;
					case 'ALL':
						break;
					default:
						$result['message'] = __('Invalid Type: %s', $type);
						break;
				}
			} else {
				$result['message'] = __('Not Logged In');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		} else {
			parent::hasSession();

			debug($id);
			debug($type);
			exit;
		}
	}
}