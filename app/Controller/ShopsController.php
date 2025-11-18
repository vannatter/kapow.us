<?php

App::uses('AppController', 'Controller');

/**
 * @property Store $Store
 */
class ShopsController extends AppController {
	public $name = 'Shops';
	public $uses = array('Store', 'StorePhoto', 'UserFavorite');
	public $components = array('Upload');

	public function index() {
	}

	public function view($id, $name) {
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			$this->Session->setFlash('Shop not found!', 'flash_neg');
			$this->redirect($this->referer());
			exit;
		}

		$this->Store->bindModel(array(
			'hasMany' => array(
				'UserFavorite' => array(
					'foreignKey' => 'favorite_item_id',
					'finderQuery' => 'SELECT UserFavorite.* FROM user_favorites AS UserFavorite LEFT JOIN users AS User ON User.id = UserFavorite.user_id WHERE UserFavorite.favorite_item_id = {$__cakeID__$} AND UserFavorite.item_type = 5 AND User.private_profile = 0 ORDER BY RAND() LIMIT 25'
				)
			)
		));
		$this->Store->UserFavorite->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'fields' => array('id', 'email', 'username')
				)
			)
		));

		$shop = $this->Store->find(
			'first',
			array(
				'conditions' => array(
					'Store.id' => $id
				),
				'contain' => array(
					'StorePhoto' => array(
						'conditions' => array(
							'StorePhoto.active' => 1
						)
					),
					'UserFavorite' => array(
						'User'
					)
				)
			)
		);

		$this->set('shop', $shop);
		$this->set('title_for_layout', $shop['Store']['name']);

		## see if the current user (if there is one), fav'd this shop
		if ($userFav = $this->UserFavorite->findByFavoriteItemIdAndUserIdAndItemType($id, $this->Auth->user('id'), 5)) {
			$this->set('userFav', true);
		} else {
			$this->set('userFav', false);
		}
	}

	public function viewById($id) {
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			$this->Session->setFlash(__('Store Not Found!'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect($this->referer());
		}

		$shop = $this->Store->read('name');
		$this->redirect(sprintf('/shops/%s', parent::seoize($id, $shop['Store']['name'])), 301);
	}

	public function getStores() {
		if ($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => '');

			$lat = '';
			$long = '';
			$coordAddress = '';

			$radius = 25;

			if (isset($this->request->query['lat']) && isset($this->request->query['long'])) {
				$lat = $this->request->query['lat'];
				$long = $this->request->query['long'];

				$url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&sensor=false', $lat, $long);
				$address = json_decode(file_get_contents($url));

				if ($address && $address->status === "OK") {
					$comps = $address->results;
					$comps = $comps[0];

					$state = '';
					$city = '';
					$zip = '';

					foreach($comps->address_components as $part) {
						switch($part->types[0]) {
							case 'street_number':
								break;
							case 'route':
								break;
							case 'administrative_area_level_1':
								$state = $part->short_name;
								break;
							case 'postal_code':
								$zip = $part->short_name;
								break;
							case 'locality':
								$city = $part->short_name;
								break;
						}
					}

					$coordAddress = '';

					if (!empty($city)) {
						$coordAddress = $city;
					}
					if (!empty($state)) {
						$coordAddress .= ', ' . $state;
					}
					if (!empty($zip)) {
						$coordAddress .= ', ' . $zip;
					}
				} else {
					$result['message'] = __('ERROR: %s', $address->status);
				}
			} elseif (isset($this->request->query['location'])) {
				$coordAddress = $this->request->query['location'];

				if (isset($this->request->query['radius'])) {
					$radius = (int)$this->request->query['radius'];
				}

				## get lat/long from location
				$locUrl = sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false', str_replace(' ', '+', $coordAddress));
				$loc = json_decode(file_get_contents($locUrl));

				if ($loc->status == 'OK') {
					$loc = $loc->results;
					$loc = $loc[0];

					$lat = $loc->geometry->bounds->northeast->lat;
					$long = $loc->geometry->bounds->northeast->lng;
				}
			}

			if (!empty($lat) && !empty($long)) {
				if ($data = $this->Store->radius($lat, $long, $radius)) {
					$result['location'] = $coordAddress;
					$result['latitude'] = $lat;
					$result['longitude'] = $long;
					$result['stores'] = array();

					foreach($data as $store) {
						$result['stores'][] = array(
							'link' => parent::seoize($store['Store']['id'], $store['Store']['name']),
							'name' => $store['Store']['name'],
							'city' => $store['Store']['city'],
							'state' => $store['Store']['state'],
							'zip' => $store['Store']['zip'],
							'address' => $store['Store']['address'],
							'distance' => $store[0]['distance'],
							'latitude' => $store['Store']['latitude'],
							'longitude' => $store['Store']['longitude'],
						);
					}

					$result['error'] = false;
				} else {
					$result['message'] = __('No Shops Found!');
				}
			} else {
				$result['message'] = __('Invalid Location!');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		}

		return null;
	}

	public function addImage($id=null) {
		if (!$id) {
			$this->Session->setFlash('Shop not found!', 'flash_neg');
			$this->redirect('/shops');
			exit;
		}

		if (!$this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are not logged in!', 'flash_neg');
			$this->redirect('/shops');
			exit;
		}

		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			$this->Session->setFlash('Shop not found!', 'flash_neg');
			$this->redirect('/shops');
			exit;
		}
		
		$shopshop = $this->Store->read(array('id', 'name'));

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->sanitizeData($this->request->data);

			if (isset($data['StorePhoto']['photo_upload']['name']) && !empty($data['StorePhoto']['photo_upload']['name'])) {
				$uploadPath = Configure::read('Settings.store_img_path');
				$uploadPath .= '/' . $id . '/';

				## process the upload, make sure its valid
				$upload = $data['StorePhoto']['photo_upload'];
				$name = uniqid() . '-' . $upload['name'];

				if ($msg = $this->Upload->image($upload, $uploadPath, $name)) {
					$this->StorePhoto->validationErrors['photo_upload'] = $msg;
				} else {
					$data['StorePhoto']['photo_path'] = Configure::read('Settings.store_img_web_path') . '/' . $id . '/' . $name;
					$data['StorePhoto']['uploader_user_id'] = $this->Auth->user('id');
					$data['StorePhoto']['store_id'] = $id;
					$data['StorePhoto']['active'] = 0;

					$this->StorePhoto->create($data);
					if ($this->StorePhoto->save($data)) {
						$this->Session->setFlash('Photo added for review!', 'flash_pos');
						$this->redirect('/shops/' . $this->seoize($id, $shopshop['Store']['name']));
						exit;
					}
				}
			} else {
				$this->StorePhoto->validationErrors['photo_upload'] = __('Invalid');
			}
		}

		$this->Store->recursive = 0;
		$this->set('shop', $shopshop);
		$this->set('title_for_layout', 'Add Shop Photo');
	}

	public function add() {
		parent::hasSession();

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->sanitizeData($this->request->data, array('encode' => false, 'escape' => false));

			$data['Store']['user_id'] = $this->Auth->user('id');
			$data['Store']['status_id'] = 2;   ### needs approval

			$address = '';
			if (!empty($data['Store']['address']) && !empty($data['Store']['city']) && !empty($data['Store']['state'])) {
				$address = $data['Store']['address'] . ' ';
				$address .= $data['Store']['address_2'] .  ' ';
				$address .= $data['Store']['city'] . ' ';
				$address .= $data['Store']['state'];

				## get lat/long from location
				$locUrl = sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false', str_replace(' ', '+', $address));
				$loc = json_decode(file_get_contents($locUrl));

				if ($loc->status == 'OK') {
					$loc = $loc->results;
					$loc = $loc[0];

					$data['Store']['latitude'] = $loc->geometry->location->lat;
					$data['Store']['longitude'] = $loc->geometry->location->lng;
				}
			}

			if ($this->Store->save($data)) {
				$this->Session->setFlash(__('Shop submitted for approval'), 'flash_pos');
			}
		}
	}

	public function claim($shopId=null) {
		if (!$shopId) {
			$this->Session->setFlash(__('Invalid Shop'), 'flash_neg');
			$this->redirect('/shops');
			exit;
		}

		## make sure the shop is valid
		if ($shop = $this->Store->findById($shopId)) {
			$this->set('title_for_layout', __('Claim Shop'));

			$this->set('shop', $shop);
		} else {
			$this->Session->setFlash(__('Invalid Shop'), 'flash_neg');
			$this->redirect('/shops');
		}
	}
}