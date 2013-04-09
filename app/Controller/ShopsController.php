<?php

App::uses('AppController', 'Controller');

/**
 * @property Store $Store
 */
class ShopsController extends AppController {
	public $name = 'Shops';
	public $uses = array('Store', 'StorePhoto');
	public $components = array('Upload');

	public function index() {
	}

	public function view($id, $name) {
		$this->Store->id = $id;
		if(!$this->Store->exists()) {
			$this->Session->setFlash(__('Store Not Found!'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect($this->referer());
		}

		$shop = $this->Store->read();
		$this->set('shop', $shop);
		$this->set('title_for_layout', $shop['Store']['name']);
	}

	public function viewById($id) {
		$this->Store->id = $id;
		if(!$this->Store->exists()) {
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
		if($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => '');

			$lat = '';
			$long = '';
			$coordAddress = '';

			$radius = 25;

			if(isset($this->request->query['lat']) && isset($this->request->query['long'])) {
				$lat = $this->request->query['lat'];
				$long = $this->request->query['long'];

				$url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&sensor=false', $lat, $long);
				$address = json_decode(file_get_contents($url));

				if($address && $address->status === "OK") {
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

					if(!empty($city)) {
						$coordAddress = $city;
					}
					if(!empty($state)) {
						$coordAddress .= ', ' . $state;
					}
					if(!empty($zip)) {
						$coordAddress .= ', ' . $zip;
					}
				} else {
					$result['message'] = __('ERROR: %s', $address->status);
				}
			} elseif(isset($this->request->query['location'])) {
				$coordAddress = $this->request->query['location'];

				if(isset($this->request->query['radius'])) {
					$radius = (int)$this->request->query['radius'];
				}

				## get lat/long from location
				$locUrl = sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false', str_replace(' ', '+', $coordAddress));
				$loc = json_decode(file_get_contents($locUrl));

				if($loc->status == 'OK') {
					$loc = $loc->results;
					$loc = $loc[0];

					$lat = $loc->geometry->bounds->northeast->lat;
					$long = $loc->geometry->bounds->northeast->lng;
				}
			}

			if(!empty($lat) && !empty($long)) {
				if($data = $this->Store->radius($lat, $long, $radius)) {
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
		if(!$id) {
			$this->Session->setFlash(__('Invalid Shop'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/shops');
		}

		if(!$this->Session->read('Auth.User')) {
			$this->Session->setFlash(__('Not Logged In'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/shops');
		}

		$this->Store->id = $id;
		if(!$this->Store->exists()) {
			$this->Session->setFlash(__('Invalid Shop'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/shops');
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			if(isset($data['StorePhoto']['photo_upload']['name']) && !empty($data['StorePhoto']['photo_upload']['name'])) {
				$uploadPath = Configure::read('Settings.store_img_path');
				$uploadPath .= '/' . $id . '/';

				## process the upload, make sure its valid
				$upload = $data['StorePhoto']['photo_upload'];
				$name = uniqid() . '-' . $upload['name'];

				if($msg = $this->Upload->image($upload, $uploadPath, $name)) {
					$this->StorePhoto->validationErrors['photo_upload'] = $msg;
				} else {
					$data['StorePhoto']['photo_path'] = Configure::read('Settings.store_img_web_path') . '/' . $id . '/' . $name;
					$data['StorePhoto']['uploader_user_id'] = $this->Auth->user('id');
					$data['StorePhoto']['store_id'] = $id;

					$this->StorePhoto->create($data);
					if($this->StorePhoto->save($data)) {
						$this->Session->setFlash(__('Photo Added'), 'alert', array(
							'plugin' => 'TwitterBootstrap',
							'class' => 'alert-success'
						));
					}
				}
			} else {
				$this->StorePhoto->validationErrors['photo_upload'] = __('Invalid');
			}
		}

		$this->Store->recursive = 0;
		$this->set('shop', $this->Store->read(array('id', 'name')));
	}
}