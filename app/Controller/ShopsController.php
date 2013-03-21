<?php

App::uses('AppController', 'Controller');

/**
 * @property Store $Store
 */
class ShopsController extends AppController {
	public $name = 'Shops';
	public $uses = array('Store');

	public function index() {
	}

	public function getStores() {
		if($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => '');

			$url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&sensor=false', $this->request->query['lat'], $this->request->query['long']);
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

				if($data = $this->Store->radius2($this->request->query['lat'], $this->request->query['long'], 10)) {
					$result['location'] = $coordAddress;
					$result['stores'] = array();

					foreach($data as $store) {
						$result['stores'][] = $store;
					}
				}
			} else {
				$result['message'] = __('ERROR: %s', $address->status);
			}

			return new CakeResponse(array('body' => json_encode($result)));
		}

		return null;
	}
}