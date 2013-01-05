<?php

App::uses('AppController', 'Controller');

class ToolsController extends AppController {

	public $name = 'Tools';
	public $uses = array('Item','Section');
	public $components = array('Curl');

	public function import() {
	
		list ($d, $i) = $this->Curl->getRaw("http://www.previewsworld.com/shipping/newreleases.txt");
		$d = trim($d);
		$arr = explode("\n", $d);
		
		$section = "";
		$check_next_for_section = false;
		$date = "";
		
		$cnt = 0;
		foreach ($arr as $a) {
		
			if (substr($a, 0, 17) == "New Releases For ") {
				$date = trim(substr($a, 17));
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
				
				if ($cnt >= 6) {
					break;
				}
			}
		}
		exit;
	}

	function _getItem($item_id, $item_name, $section, $date) {
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
			$item['item_date'] = $date;
	
			// name and stock_id				
			$stock_code_desc = $xpath->query('//div[@class="StockCodeDescription"]/a');
			foreach ($stock_code_desc as $tag) {
				$item['item_name'] = trim($tag->nodeValue);
			    $stock_url = $tag->getAttribute('href');
				$stock_parts = split("=", $stock_url);		
				$item['stock_id'] = $stock_parts[1];
				
				// parse item_name by # to get series name..
				$series_parts = split("#", $item['item_name']);				
				
				$item['series_name'] = trim($series_parts[0]);				
				if (@$series_parts[1]) {
					$series_num_parts = split(" ", $series_parts[1]);
					$item['series_num'] = $series_num_parts[0];
				}
			}
			
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
	
				// load section, get section id
				$item['section_id'] = $this->Section->getsetSection($section);
	
				// get local image
				$imgpath = $this->Curl->getImage($item['img']);
				echo "imgpath=" . $imgpath;

				echo "<pre>";
				print_r($item);
				echo "</pre>";

			} else {
				echo "server responded without data (" . $item_id . ") <br/>\n";
			}

		} else {
			echo "already have this item (" . $item_id . ") <br/>\n";
		}
	}

}
