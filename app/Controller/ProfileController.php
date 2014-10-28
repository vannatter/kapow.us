<?php

App::uses('AppController', 'Controller');

/**
 * @property User $User
 * @property Pull $Pull
 * @property UserItem $UserItem
 * @property UserFavorite $UserFavorite
 */
 
class ProfileController extends AppController {
	public $name = 'Profile';
	public $uses = array('User', 'Pull', 'UserItem', 'UserFavorite');
	public $helpers = array('Gravatar');

	public function index($username="") {
	
		if (!$username) {
			$this->redirect('/');
			exit;
		}

		$user = $this->User->find('first', array('conditions' => array('User.username' =>$username), 'limit' => 1, 'recursive' => 1));
		if (!$user) {
			$this->redirect('/');
			exit;
		}

		$email = $user['User']['email'];
		$default = "http://kapow.us/theme/Kapow/img/noprofile.png";
		$size = 300;
		$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

		$this->set('gravatar', $grav_url);
		$this->_getProfileData($user);

		## see if the current user (if there is one), fav'd this publisher
		if($userFav = $this->UserFavorite->findByFavoriteItemIdAndUserIdAndItemType($user['User']['id'], $this->Auth->user('id'), 6)) {
			$this->set('userFav', true);
		} else {
			$this->set('userFav', false);
		}

		$this->set('user', $user);
		$this->set('username', $user['User']['username']);
		$this->set('title_for_layout','Profile - ' . $user['User']['username']);
	}

	private function _getProfileData(&$user) {
		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['publishers'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 4, 'UserFavorite.user_id' => $user['User']['id']), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['creators'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 3, 'UserFavorite.user_id' => $user['User']['id']), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'favorite_item_id'))));
		$this->User->UserFavorite->Series->bindModel(array('hasOne' => array('Item' => array('foreignKey' => 'series_id', 'order' => 'RAND()'))));
		$user['favorites']['series'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 2, 'UserFavorite.user_id' => $user['User']['id']), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Series' => array('Item' => array('fields' => array('img_fullpath'))))));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['shops'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 5, 'UserFavorite.user_id' => $user['User']['id']), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Store' => array('PrimaryPhoto', 'StorePhoto' => array('limit' => 1, 'order' => 'RAND()')))));

		$this->User->UserFavorite->bindModel(array('belongsTo' => array('Item' => array('foreignKey' => 'favorite_item_id'))));
		$user['favorites']['items'] = $this->User->UserFavorite->find('all', array('conditions' => array('UserFavorite.item_type' => 1, 'UserFavorite.user_id' => $user['User']['id']), 'order' => array('UserFavorite.id' => 'DESC'), 'limit' => 4, 'contain' => array('Item')));

		$pulls = $this->Pull->find('all', array('conditions' => array('Pull.user_id' => $user['User']['id']), 'order' => array('Pull.id DESC'), 'limit' => 4, 'recursive' => 1));
		$this->set('pulls', $pulls);

		$library = $this->UserItem->find('all', array('conditions' => array('UserItem.user_id' => $user['User']['id']), 'order' => array('UserItem.id DESC'), 'limit' => 4, 'recursive' => 1));
		$this->set('library', $library);
	}


}