<?php

App::uses('AppController', 'Controller');

/**
 * @property Store $Store
 */
class ToolsController extends AppController {

	public $name = 'Tools';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator', 'Store');
	public $components = array('Curl');
	public $helpers = array('Common');

	public function import_next() {
		echo "importing upcoming... <br/>";
		$this->import("http://www.previewsworld.com/shipping/upcomingreleases.txt");
		exit;
	}

	public function import($url="http://www.previewsworld.com/shipping/newreleases.txt") {
	
		set_time_limit(9000);	
		echo "starting import.. <br/>";
	
		list ($d, $i) = $this->Curl->getRaw($url);
		$d = trim($d);
		
		echo "<pre>";
		print_r($d);
		echo "</pre>";
		
		$arr = explode("\n", $d);
		
		$section = "";
		$check_next_for_section = false;
		$date = "";
		
		$cnt = 0;
		foreach ($arr as $a) {
		
			if (substr($a, 0, 17) == "New Releases For ") {
				$date = trim(substr($a, 17));
			}
			if (substr($a, 0, 22) == "Upcoming Releases For ") {
				$date = trim(substr($a, 22));
			}
		
			$a = trim($a);
			$parts = explode(" 	", $a);
			$part_1 = @$parts[0];
			$part_2 = @$parts[1];
			$part_1 = trim($part_1);
			$part_2 = trim($part_2);
			
			if ($check_next_for_section) {
				if ( ($part_1) && (!$part_2) ) {
					$section = $part_1;				
				}
				$check_next_for_section = false;
			}
			
			if ( (!$part_1) && (!$part_2) ) {
				$check_next_for_section = true;
			}
			
			if ($part_2) {
				$this->_getItem($part_1, $part_2, $section, $date);		
				$cnt++;
			}
		}
		exit;
	}

	function _getItem($item_id, $item_name, $section, $date) {
	
		$print = 1;
		$rand = rand(500,999);
		$url = Configure::read('Settings.root_domain') . Configure::read('Settings.root_domain_path') . $rand . "?stockItemID=" . $item_id;

		// check if we need this item, if its already been parsed, don't do it again..
		$item = $this->Item->find('first', array('conditions' => array('Item.item_id' => $item_id), 'limit' => 1, 'recursive' => 1));
		if (!$item) {
			
			echo "getting url = " . $url . "<br/>";		
			list ($d, $i) = $this->Curl->getRaw($url);
			
			$dom = new DOMDocument();
			@$dom->loadHTML($d);
			$xpath = new DOMXPath($dom);
			
			$item = array();
			$item['item_id'] = $item_id;
			$item['item_date'] = date("Y-m-d", strtotime($date));
	
			// name and stock_id				
			$stock_code_desc = $xpath->query('//div[@class="StockCodeDescription"]/a');
			foreach ($stock_code_desc as $tag) {
				
				$item['item_name'] = trim($tag->nodeValue);
				$item['item_name'] = trim(preg_replace("/\(\C\:[^)]+\)/","",$item['item_name']));
				
			    $stock_url = $tag->getAttribute('href');
				$stock_parts = split("=", $stock_url);		
				$item['stock_id'] = $stock_parts[1];
				
				// parse item_name by # to get series name..
				$series_parts = split("#", $item['item_name']);				
				
				$item['series_name'] = trim($series_parts[0]);
				$item['series_name'] = trim(preg_replace("/\([^)]+\)/","",$item['series_name']));
				$item['series_name'] = trim(str_replace(" TP", "", $item['series_name']));
						
				if (@$series_parts[1]) {
					$series_num_parts = split(" ", $series_parts[1]);
					$item['series_num'] = (int) $series_num_parts[0];
				}
			}

			if (strpos($item['item_name'], "2ND PTG")) {
				$print = 2;
			}
			if (strpos($item['item_name'], "3RD PTG")) {
				$print = 3;
			}
			if (strpos($item['item_name'], "4TH PTG")) {
				$print = 4;
			}
			if (strpos($item['item_name'], "5TH PTG")) {
				$print = 5;
			}
			
			if ($print == 1) {
				if (strpos($item_name, "2ND PTG")) {
					$print = 2;
				}
				if (strpos($item_name, "3RD PTG")) {
					$print = 3;
				}
				if (strpos($item_name, "4TH PTG")) {
					$print = 4;
				}
				if (strpos($item_name, "5TH PTG")) {
					$print = 5;
				}
			}
			
			$item['printing'] = $print;
			
			$publisher = $xpath->query('//div[@class="StockCodePublisher"]');
			foreach ($publisher as $tag) {
				$pub = substr($tag->nodeValue, 12);
				$item['publisher'] = $pub;
			}
			
			$creators = $xpath->query('//div[@class="StockCodeCreators"]');
			foreach ($creators as $tag) {
				$creator_array = preg_split("/\(/", $tag->nodeValue);
				$cz = array();
				foreach ($creator_array as $c) {
					if ($c) {
						$creator_pieces = split(")", $c);
						$e = split("/", $creator_pieces[0]);
						foreach ($e as $el) {
							$creator_names = split(",", $creator_pieces[1]);
							foreach ($creator_names as $cn) {
								$cn = str_replace("& Various", "", $cn);
								$cz[$el][] = trim($cn);
							}
						}
					}
				}
				$item['creators'] = $cz;
			}
	
			$description = $xpath->query('//div[@class="PreviewsHtml"]');
			foreach ($description as $tag) {
				$item['description'] = trim($tag->nodeValue);
				$item['description'] = trim(preg_replace('/[^a-zA-Z0-9_ %\;\:\@\*\$\?\,\"\'\!\[\]\.\(\)%&-]/s', '', $item['description']));
			}
			
			$img = $xpath->query('//div[@class="StockCodeImage"]/a');
			foreach ($img as $tag) {
				$item['img'] = trim($tag->getAttribute('href'));
			}
			
			$srp = $xpath->query('//div[@class="StockCodeSrp"]');
			foreach ($srp as $tag) {
				$pri = substr($tag->nodeValue, 8);
				$item['srp'] = $pri;
			}		
	
			// see if we have data; site can sometimes respond w/ an error..
			if (@$item['item_name']) {

				$item['section_id'] = $this->Section->getsetSection($section);
				$item['publisher_id'] = $this->Publisher->getsetPublisher($item['publisher']);
				$item['series_id'] = $this->Series->getsetSeries($item['series_name']);

				// override section_id for items matching t-shirt (T/S)
				if (strpos($item_name, "T/S")) {
					$item['section_id'] = 9;				
				}

				// get local image
				echo "img=" . $item['img'] . "<br/>";
				
				$imgpath = $this->Curl->getImage($item['img']);
				$item['img_fullpath'] = $imgpath;

				echo "<pre>";
				print_r($item);
				echo "</pre>";
				
				// save item
				$item_id = $this->Item->saveItem($item);
				echo "item-id=>" . $item_id . "<br/>";

				// save creators
				if (is_array(@$item['creators'])) {
					foreach (@$item['creators'] as $k=>$v) {
						$creator_type_id = $this->CreatorType->getsetCreatorType($k);
						foreach ($v as $x) {
							$creator_id = $this->Creator->getsetCreator($x);
							
							//save to item_creators
							$item_creators = array();
							$item_creators['item_id'] = $item_id;
							$item_creators['creator_type_id'] = $creator_type_id;
							$item_creators['creator_id'] = $creator_id;
	
							$this->ItemCreator->create();
							$this->ItemCreator->save($item_creators);						
						}
					}
				}

			} else {
				echo "server responded without data (" . $item_id . ") <br/>\n";
			}

		} else {
			echo "already have this item (" . $item_id . ") <br/>\n";
		}
	}

	public function parseStoresAll() {
	
		$us_states = array(
			'AL'=>"Alabama",  
			'AK'=>"Alaska",  
			'AZ'=>"Arizona",  
			'AR'=>"Arkansas",  
			'CA'=>"California",  
			'CO'=>"Colorado",  
			'CT'=>"Connecticut",  
			'DC'=>"District_of_Columbia",
			'DE'=>"Delaware",  
			'FL'=>"Florida",  
			'GA'=>"Georgia",  
			'HI'=>"Hawaii",  
			'ID'=>"Idaho",  
			'IL'=>"Illinois",  
			'IN'=>"Indiana",  
			'IA'=>"Iowa",  
			'KS'=>"Kansas",  
			'KY'=>"Kentucky",  
			'LA'=>"Louisiana",  
			'ME'=>"Maine",  
			'MD'=>"Maryland",  
			'MA'=>"Massachusetts",  
			'MI'=>"Michigan",  
			'MN'=>"Minnesota",  
			'MS'=>"Mississippi",  
			'MO'=>"Missouri",  
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New_Hampshire",
			'NJ'=>"New_Jersey",
			'NM'=>"New_Mexico",
			'NY'=>"New_York",
			'NC'=>"North_Carolina",
			'ND'=>"North_Dakota",
			'OH'=>"Ohio",  
			'OK'=>"Oklahoma",  
			'OR'=>"Oregon",  
			'PA'=>"Pennsylvania",
			'RI'=>"Rhode_Island",  
			'SC'=>"South_Carolina",  
			'SD'=>"South_Dakota",
			'TN'=>"Tennessee",  
			'TX'=>"Texas",  
			'UT'=>"Utah",  
			'VT'=>"Vermont",  
			'VA'=>"Virginia",  
			'WA'=>"Washington",  
			'WV'=>"West_Virginia",  
			'WI'=>"Wisconsin",  
			'WY'=>"Wyoming"
		);
		
		$ca_states = array(			
			'AC' => "Alberta",
			'BC' => "British_Columbia",
			'MB' => "Manitoba",
			'NB' => "New_Brunswick",
			'NL' => "Newfoundland_&_Labrador",
			'NS' => "Nova_Scotia",
			'ON' => "Ontario",
			'PE' => "Prince_Edward_Island",
			'QU' => "Quebec",
			'SA' => "Saskatchewan"
		);	
		
		foreach ($us_states as $code => $state){
			$this->_parseStores('USA', $state);
		}		

		foreach ($ca_states as $code => $state){
			$this->_parseStores('Canada', $state);
		}		
		
		exit;
	}

	private function _parseStores($country="USA", $state=null) {
		set_time_limit(0);   ## process could take a while

		$url = "http://the-master-list.com/" . $country . "/" . $state . "/index.shtml";
		$this->log(sprintf('getting data from: %s', $url));
		$data = file_get_contents($url);

		$this->log(sprintf('%s bytes', number_format(strlen($data))));

		$html = new DOMDocument();
		libxml_use_internal_errors(true);
		$html->loadHTML($data);
		$xpath = new DOMXPath($html);

		$tables = $xpath->query("//table[@width=550]");
		$this->log(sprintf('found %s tables', $tables->length));

		$storesLogPath = APP . 'tmp' . DS . 'logs' . DS . 'stores.txt';
		$storeDetailsLogPath = APP . 'tmp' . DS . 'logs' . DS . 'details.txt';

		## clear current log files
		file_put_contents($storesLogPath, '');
		file_put_contents($storeDetailsLogPath, '');

		for ($i=0;$i<$tables->length;$i++) {
			$table = $tables->item($i);

			$storeName = null;
			$address = null;
			$phoneNo = null;

			for ($q=0;$q<$table->childNodes->length;$q++) {
				$value = $table->childNodes->item($q)->nodeValue;

				if (strpos($value, 'last verified:') !== false) {
					## get the store name
					$storeName = substr($value, 0, strpos($value, ':'));
				} elseif(substr_count($value, ',') == 3) {
					$address = $value;

					## address can use a little cleanup
					$address = str_replace(', ....', '', $address);

				} elseif(strpos($value, 'Ph:') !== false) {
					$phoneNo = $value;
				}

				if (!empty($storeName) && !empty($address)) {
					$this->log(sprintf('STORE: %s; ADDRESS: %s', $storeName, $address));

					if (!empty($storeName)) {
						$storeSearchString = urlencode($storeName . ' ' . $address);
						$this->log(sprintf('searching for store with: %s', $storeSearchString));

						if ($results = $this->_googlePlacesSearch($storeSearchString, $storesLogPath)) {
							$stores = $results->results;

							if (count($stores) > 0) {
								$store = $stores[0];   ## take the first store, should be the correct one
								$storeName = $store->name;

								if ($storeDetails = $this->_googleDetailsSearch($store->reference, $storeDetailsLogPath)) {
									$storeDetails = $this->_processStore($storeDetails);
									if ($storeDetails && !empty($storeDetails['name'])) {
										## valid store information
										$storeDetails['country_code'] = $country;
										$this->Store->add(array('Store' => $storeDetails));
									}
								}
							} else {
								$this->log('no stores found; adding basic store info');
								$addressParts = explode(',', $address);
								$store = array(
									'Store' => array(
										'name' => $storeName,
										'address' => @trim($addressParts[0]),
										'city' => @trim($addressParts[1]),
										'state' => @trim($addressParts[2]),
										'zip' => @trim($addressParts[3]),
										'country_code' => $country,
										'status_id' => 99,   ## NEEDS ATTENTION
									)
								);

								$this->Store->add($store);
							}
						}
					}

					$storeName = null;
					$address = null;
				}
			}
		}

		$this->log('done');
	}

	private function _googlePlacesSearch($searchText=null, $log=null) {
		if($searchText) {
			$url = sprintf(Configure::read('Settings.API.google.places_url'), $searchText, Configure::read('Settings.API.google.key'));

			$this->log(sprintf('googlePlacesSearch: %s', $url));

			$results = file_get_contents($url);

			if($log) {
				file_put_contents($log, print_r($results, true), FILE_APPEND);
			}

			$results = json_decode($results);

			switch($results->status) {
				case 'OVER_QUERY_LIMIT':
					$this->log('googlePlacesSearch - OVER QUERY LIMIT');
					exit;
					break;
			}

			return $results;
		} else {
			$this->log('invalid search text for _googlePlacesSearch()');
		}

		return false;
	}

	private function _googleDetailsSearch($reference=null, $log=null) {
		if($reference) {
			$url = sprintf(Configure::read('Settings.API.google.details_url'), $reference, Configure::read('Settings.API.google.key'));

			$this->log(sprintf('googleDetailsSearch: %s', $url));

			$results = file_get_contents($url);

			if($log) {
				file_put_contents($log, print_r($results, true), FILE_APPEND);
			}

			$results = json_decode($results);

			switch($results->status) {
				case 'OVER_QUERY_LIMIT':
					$this->log('googleDetailsSearch - OVER QUERY LIMIT');
					exit;
					break;
			}

			return $results;
		} else {
			$this->log('invalid reference for _googleDetailsSearch()');
		}

		return false;
	}

	private function _processStore($data=null) {
		if(!$data) {
			$file = APP . 'tmp' . DS . 'logs' . DS . 'storeDetails.txt';
			$data = json_decode(file_get_contents($file));
		}

		$store = array(
			'name' => '',
			'address' => '',
			'city' => '',
			'state' => '',
			'zip' => '',
			'phone_no' => '',
			'latitude' => 0,
			'longitude' => 0,
			'Hour' => array(
				'sunday_open' => 0,
				'sunday_close' => 0,
				'monday_open' => 0,
				'monday_close' => 0,
				'tuesday_open' => 0,
				'tuesday_close' => 0,
				'wednesday_open' => 0,
				'wednesday_close' => 0,
				'thursday_open' => 0,
				'thursday_close' => 0,
				'friday_open' => 0,
				'friday_close' => 0,
				'saturday_open' => 0,
				'saturday_close' => 0,
			),
			'website' => '',
			'google_reference' => '',
		);

		foreach($data->result->address_components as $addressParts) {
			switch($addressParts->types[0]) {
				case 'street_number':
					$store['address'] = $addressParts->long_name;
					break;
				case 'route':
					$store['address'] .= ' ' . $addressParts->long_name;
					break;
				case 'administrative_area_level_1':
					$store['state'] = $addressParts->long_name;
					break;
				case 'postal_code':
					$store['zip'] = $addressParts->long_name;
					break;
				case 'locality':
					$store['city'] = $addressParts->long_name;
					break;
			}
		}

		if(isset($data->result->formatted_phone_number)) {
			$store['phone_no'] = $data->result->formatted_phone_number;
		}

		if(isset($data->result->geometry->location->lat) && isset($data->result->geometry->location->lng)) {
			$store['latitude'] = $data->result->geometry->location->lat;
			$store['longitude'] = $data->result->geometry->location->lng;
		}

		if(isset($data->result->name)) {
			$store['name'] = $data->result->name;
		}

		if(isset($data->result->opening_hours->periods)) {
			foreach($data->result->opening_hours->periods as $day) {
				switch($day->close->day) {
					case 0:   ## SUNDAY
						$store['Hour']['sunday_close'] = (int)$day->close->time;
						$store['Hour']['sunday_open'] = (int)$day->open->time;
						break;
					case 1:   ## MONDAY
						$store['Hour']['monday_close'] = (int)$day->close->time;
						$store['Hour']['monday_open'] = (int)$day->open->time;
						break;
					case 2:   ## TUESDAY
						$store['Hour']['tuesday_close'] = (int)$day->close->time;
						$store['Hour']['tuesday_open'] = (int)$day->open->time;
						break;
					case 3:   ## WEDNESDAY
						$store['Hour']['wednesday_close'] = (int)$day->close->time;
						$store['Hour']['wednesday_open'] = (int)$day->open->time;
						break;
					case 4:   ## THURSDAY
						$store['Hour']['thursday_close'] = (int)$day->close->time;
						$store['Hour']['thursday_open'] = (int)$day->open->time;
						break;
					case 5:   ## FRIDAY
						$store['Hour']['friday_close'] = (int)$day->close->time;
						$store['Hour']['friday_open'] = (int)$day->open->time;
						break;
					case 6:   ## SATURDAY
						$store['Hour']['saturday_close'] = (int)$day->close->time;
						$store['Hour']['saturday_open'] = (int)$day->open->time;
						break;
				}
			}
		}

		if(isset($data->result->website)) {
			$store['website'] = $data->result->website;
		}

		if(isset($data->result->reference)) {
			$store['google_reference'] = $data->result->reference;
		}

		return $store;
	}

	public function log($data="") {
		echo sprintf('%s<br />', $data);

		parent::log($data, 'tools');
	}
}

?>