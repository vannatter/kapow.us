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

			$lat = '';
			$long = '';
			$coordAddress = '';

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

				## get lat/long from location
				$loc = json_decode(file_get_contents('http://where.yahooapis.com/geocode?q=' . str_replace(' ', '+', $coordAddress) . '&flags=J&appid=S7cyGA32'));

				if($loc->ResultSet->Error == 0) {
					$lat = $loc->ResultSet->Results[0]->latitude;
					$long = $loc->ResultSet->Results[0]->longitude;
				}
			}

			if(!empty($lat) && !empty($long)) {
				if($data = $this->Store->radius2($lat, $long, 10)) {
					$result['location'] = $coordAddress;
					$result['stores'] = array();

					foreach($data as $store) {
						$result['stores'][] = array(
							'name' => $store['Store']['name'],
							'distance' => $store[0]['distance'],
							'latitude' => $store['Store']['latitude'],
							'longitude' => $store['Store']['longitude'],
						);
					}

					$result['error'] = false;
				} else {
					$result['message'] = __('No Stores Found!');
				}
			} else {
				$result['message'] = __('Invalid Location!');
			}

			return new CakeResponse(array('body' => json_encode($result)));
		}

		return null;
	}
}