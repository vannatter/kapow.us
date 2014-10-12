<?php

App::uses('AppController', 'Controller');

/**
 * @property Store $Store
 * @property AppMessage $AppMessage
 */
class ApiController extends AppController {
	public $name = 'Api';
	public $uses = array('Store', 'AppMessage');

	public function index() {
		$this->redirect('/');
	}

	public function findCloseByShops() {
		if ($this->request->ext == 'json') {
			$result = array('status' => array('status_code' => 204, 'status_message' => ''));
			$radius = 10;

			if (!isset($this->request->query['lat']) || !isset($this->request->query['long']) || !isset($this->request->query['userId'])) {
				$result['status']['status_message'] = __('Invalid Parameters');
				return new CakeResponse(array('body' => json_encode($result)));
			}

			$userId = $this->request->query['userId'];
			$lat = $this->request->query['lat'];
			$long = $this->request->query['long'];

			if (isset($this->request->query['radius'])) {
				$radius = $this->request->query['radius'];
			}

			if ($data = $this->Store->radius($lat, $long, $radius, $userId)) {
				$result['status']['status_code'] = 200;
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
						'is_fav' => ($store['UserFavorite']['is_fav']) ? 1 : 0,
					);
				}
			} else {
				$result['status']['status_message'] = __('No Shops Found');
			}

			if ($message = $this->AppMessage->getLatestMessage()) {
				$result['status']['app_message_title'] = $message['AppMessage']['title'];
				$result['status']['app_message_body'] = $message['AppMessage']['body'];
			} else {
				$result['status']['app_message_title'] = '';
				$result['status']['app_message_body'] = '';
			}

			return new CakeResponse(array('body' => json_encode($result)));
		}
		return 'error';
	}
}