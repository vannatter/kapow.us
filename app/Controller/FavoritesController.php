<?php

App::uses('AppController', 'Controller');

/**
 * @property UserFavorite $UserFavorite
 */
class FavoritesController extends AppController {
	public $name = 'Favorites';
	public $uses = array('Item', 'UserFavorite');

	public function index() {
		$this->redirect('/', 301);
	}

	public function toggle($id=null, $type=null) {
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
					case 'SHOP':
						$result['type'] = $this->UserFavorite->toggle($this->Auth->user('id'), $id, 5);
						$result['error'] = false;
						break;
					case 'ALL':
						## id in this instance is the item id
						## get all the information for the item, so we can favorite everything
						$item = $this->Item->find('first', array(
							'conditions' => array(
								'Item.id' => $id
							),
							'contain' => array(
								'ItemCreator' => array(
									'fields' => array('id', 'creator_id')
								),
								'Publisher' => array(
									'fields' => array('id')
								),
								'Series' => array(
									'fields' => array('id')
								)
							)
						));

						if($item) {
							## toggle favorite on for each type
							$this->UserFavorite->toggle($this->Auth->user('id'), $item['Series']['id'], 2, 1);
							$this->UserFavorite->toggle($this->Auth->user('id'), $item['Publisher']['id'], 4, 1);

							## walk each creator
							foreach($item['ItemCreator'] as $c) {
								$this->UserFavorite->toggle($this->Auth->user('id'), $c['creator_id'], 3, 1);
							}

							$result['error'] = false;
							$result['type'] = 1;
						}
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