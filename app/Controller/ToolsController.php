<?php

App::uses('AppController', 'Controller');
App::uses('SmushIt','Lib');

/**
 * @property Store $Store
 * @property Creator $Creator
 * @property Tag $Tag
 * @property Item $Item
 * @property ItemUserFavorite $ItemUserFavorite
 * @property UserFavorite $UserFavorite
 */

class ToolsController extends AppController {

	public $name = 'Tools';
	public $uses = array(
		'Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator',
		'Store','Tag','ItemTag','StorePhoto', 'ItemUserFavorite', 'UserFavorite',
		'UserSeries', 'UserItem'
	);
	public $components = array('Curl');
	public $helpers = array('Common');
	
	public function process_tags() {
		
		## delete all existing tags..
		$this->ItemTag->query('TRUNCATE item_tags;');
		echo "truncated item_tags, beginning run... <br/>";

		$items = $this->Item->find('all', array('fields' => array('Item.id', 'Item.item_name'), 'conditions' => array('Item.status' => 1), 'recursive' => -1));
		$tags = $this->Tag->find('all', array('conditions' => array('Tag.approved' => 1), 'recursive' => -1));
		
		foreach ($items as $i) {
		
			echo "processing item_id = " . $i['Item']['id'] . " [" . $i['Item']['item_name'] . "]<br/>";
			
			$item_string = trim(strtolower($i['Item']['item_name']));
			$item_string = "  " . $item_string . "  ";
			
			## find matching tags; loop through active tags and look for matches..
			foreach ($tags as $t) {
				
				if (strpos($item_string, " ".$t['Tag']['tag_name']." ")) {
					## tag matched..
					
					$tmp = array();
					$tmp['item_id'] = $i['Item']['id'];
					$tmp['tag_id']  = $t['Tag']['id'];
					
					$this->ItemTag->create();
					$this->ItemTag->save($tmp);
				}
			}
		}
		exit;
	}

	public function cleanup_item_names() {

		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(COMBO)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...

			$clean_name = trim(str_replace("(COMBO)", "[COMBO]", $i['Item']['item_name']));
			if ($clean_name) {
				## go ahead and update this guy..
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}

		## get all items with broken/partials ID fields that regex didnt catch..
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(C:%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...
			$name_parts = explode("(C:", $i['Item']['item_name']);
			$clean_name = trim($name_parts[0]);
			
			if ($clean_name) {
				## go ahead and update this guy..
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}

		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(C%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...
			$name_parts = explode("(C", $i['Item']['item_name']);
			$clean_name = trim($name_parts[0]);
			
			if ($clean_name) {
				## go ahead and update this guy..
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}

		## get all items with broken/partials ID fields that regex didnt catch..
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(PP%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...
			$name_parts = explode("(PP", $i['Item']['item_name']);
			$clean_name = trim($name_parts[0]);
			
			if ($clean_name) {
				## go ahead and update this guy..
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}
		
		$keywords = array('GOTHTOPIA', 'NEW ED', 'UNLSHD PT2', 'UPRISING', 'AH', 'NOTE PRICE', 'VU', 'TRINITY', 'IDW', 'DC', 'NEW PTG', 'UNLEASHED PT5', 'WRATH', 'EVIL', 'ONE SHOT', 'ONGOING', 'AOFD', 'ZERO YEAR', 'WEEKLY', 'VF', 'DOOMED', 'UNLEASHED PT6', 'UNLEASHED PT4', 'UNLEASHED PT3', 'UNLEASHED PT2');
		
		foreach ($keywords as $vv) {
			echo "checking keyword -> " . $vv . " ... <br/>";	
		
			$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%('.$vv.')%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
			foreach ($items as $i) {
				echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
				$clean_name = trim(str_replace("(".$vv.")", "", $i['Item']['item_name']));
				if ($clean_name) {
					$this->Item->id = $i['Item']['id'];
					$this->Item->saveField('item_name', $clean_name);
				}
			}		

		}
				
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(NOTE PRICE)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(NOTE PRICE)", "", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		

		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 1)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 1)", "[OF 1]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 2)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 2)", "[OF 2]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 3)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 3)", "[OF 3]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 4)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 4)", "[OF 4]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 5)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 5)", "[OF 5]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 6)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 6)", "[OF 6]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 7)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 7)", "[OF 7]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 8)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 8)", "[OF 8]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 9)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 9)", "[OF 9]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 10)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 10)", "[OF 10]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 11)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 11)", "[OF 11]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		
		$items = $this->Item->find('all', array('conditions' => array('Item.status' => 1, 'Item.item_name LIKE' => '%(OF 12)%'), 'order' => array('Item.id ASC'), 'limit' => 1000, 'recursive' => 1));
		foreach ($items as $i) {
			echo "parsing = " . $i['Item']['item_name'] . " ... <br/>";			
			$clean_name = trim(str_replace("(OF 12)", "[OF 12]", $i['Item']['item_name']));
			if ($clean_name) {
				$this->Item->id = $i['Item']['id'];
				$this->Item->saveField('item_name', $clean_name);
			}
		}		

		exit;
	}

	public function cleanup_series_names() {

		## get all series with broken/partials ID fields that regex didnt catch..

		$series = $this->Series->find('all', array('conditions' => array('Series.status' => 1, 'Series.series_name LIKE' => '%(COMBO)%'), 'order' => array('Series.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($series as $s) {
			echo "parsing = " . $s['Series']['series_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...

			$clean_name = trim(str_replace("(COMBO)", "[COMBO]", $s['Series']['series_name']));
			echo "clean_name = " . $clean_name . "<br/>";
						
			if ($clean_name) {
				## go ahead and update this guy..
				$this->Series->id = $s['Series']['id'];
				$this->Series->saveField('series_name', $clean_name);
			}
		}

		$series = $this->Series->find('all', array('conditions' => array('Series.status' => 1, 'Series.series_name LIKE' => '%(C:%'), 'order' => array('Series.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($series as $s) {
			echo "parsing = " . $s['Series']['series_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...
			$name_parts = explode("(C:", $s['Series']['series_name']);
			$clean_name = trim($name_parts[0]);

			echo "clean_name = " . $clean_name . "<br/>";
						
			if ($clean_name) {
				## go ahead and update this guy..
				$this->Series->id = $s['Series']['id'];
				$this->Series->saveField('series_name', $clean_name);
			}
		}
		
		$series = $this->Series->find('all', array('conditions' => array('Series.status' => 1, 'Series.series_name LIKE' => '%(C%'), 'order' => array('Series.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($series as $s) {
			echo "parsing = " . $s['Series']['series_name'] . " ... <br/>";			

			## split the name on the like parameter, see if we can get our valid part...
			$name_parts = explode("(C", $s['Series']['series_name']);
			$clean_name = trim($name_parts[0]);

			echo "clean_name = " . $clean_name . "<br/>";

			if ($clean_name) {
				## go ahead and update this guy..
				$this->Series->id = $s['Series']['id'];
				$this->Series->saveField('series_name', $clean_name);
			}
		}

		$series = $this->Series->find('all', array('conditions' => array('Series.status' => 1, 'Series.series_name LIKE' => '%(PP%'), 'order' => array('Series.id ASC'), 'limit' => 1000, 'recursive' => 1));

		foreach ($series as $s) {
			echo "parsing = " . $s['Series']['series_name'] . " ... <br/>";

			## split the name on the like parameter, see if we can get our valid part...
			$name_parts = explode("(PP", $s['Series']['series_name']);
			$clean_name = trim($name_parts[0]);

			echo "clean_name = " . $clean_name . "<br/>";

			if ($clean_name) {
				## go ahead and update this guy..
				$this->Series->id = $s['Series']['id'];
				$this->Series->saveField('series_name', $clean_name);
			}
		}
		exit;
	}

	public function cleanup_series() {
		
		## first, start looping the series'...
		## get the first x ordered by name asc..
				
		$series = $this->Series->find('all', array('conditions' => array('Series.status' => 1), 'order' => array('Series.series_name ASC'), 'limit' => 150, 'recursive' => 1));

		foreach ($series as $s) {
			
			echo "series = " . $s['Series']['series_name'] . "<br/>";
			
			## check if > 1 series matches this name; if so, skip it..
			
			$series_count = $this->Series->query("SELECT count(*) as 'series_cnt' FROM Series WHERE series_name LIKE '" . $s['Series']['series_name'] . "%'");			
			echo "series_count = " . $series_count[0][0]['series_cnt'] . "<br/>";
			
			if ($series_count[0][0]['series_cnt'] > 1) {
				## do nothing, probably already a root..
			} else {
				## start trying to limit this down by breaking off sections of the string.
				
			}
			
		}
		exit;
	}

	public function update_images_filesystem() {
		set_time_limit(0);	
		
		## this should get all the items from this week and make sure the file is on the filesystem. if its not, it should repull it..
		$release_date = $this->_getReleaseDate('this_week');
		
		echo "release_date = " . $release_date;
		
		$items = $this->Item->find('all', array('conditions' => array('Item.item_date' => $release_date), 'limit' => 2500, 'recursive' => 1));
		foreach ($items as $item) {
			
			$save = array();
			$updated_image = false;
			$rand = rand(500,999);
			$url = Configure::read('Settings.root_domain') . Configure::read('Settings.root_domain_path') . $rand . "?stockItemID=" . $item['Item']['item_id'];
			
			echo "updating image for (" . $item['Item']['item_id'] . ")  from [" . $url . "] .. <br/>";
			
			## first check if we have an image now in the file; sometimes they get updated..
			list ($d, $i) = $this->Curl->getRaw($url);
			$dom = new DOMDocument();
			@$dom->loadHTML($d);
			$xpath = new DOMXPath($dom);
			
			$img = $xpath->query('//div[@class="StockCodeImage"]/a');
			$final_img = "";
			foreach ($img as $tag) {
				$final_img = trim($tag->getAttribute('href'));
			}
			
			echo "img=" . $final_img . "<br/>";
			if ($final_img) {
				echo "[1] updating to use - " . $final_img . "<br/>";
				$imgpath = $this->Curl->getImage($final_img);
				
				$save['id'] = $item['Item']['id'];
				$save['img_fullpath'] = $imgpath;
				$this->Item->save($save);
				
				$updated_image = true;
			}
			
		}
		exit;
	}

	public function update_images() {
		set_time_limit(0);	
		
		## get a list of items that have no images..
		$items = $this->Item->find('all', array('conditions' => array('Item.img_fullpath' => "/img/covers"), 'limit' => 2500, 'recursive' => 1));
		foreach ($items as $item) {

			$save = array();
			$updated_image = false;
			$rand = rand(500,999);
			$url = Configure::read('Settings.root_domain') . Configure::read('Settings.root_domain_path') . $rand . "?stockItemID=" . $item['Item']['item_id'];
			
			echo "updating image for (" . $item['Item']['item_id'] . ")  from [" . $url . "] .. <br/>";
			
			## first check if we have an image now in the file; sometimes they get updated..
			list ($d, $i) = $this->Curl->getRaw($url);
			$dom = new DOMDocument();
			@$dom->loadHTML($d);
			$xpath = new DOMXPath($dom);
			
			$img = $xpath->query('//div[@class="StockCodeImage"]/a');
			$final_img = "";
			foreach ($img as $tag) {
				$final_img = trim($tag->getAttribute('href'));
			}
			
			echo "img=" . $final_img . "<br/>";
			if ($final_img) {
				echo "[1] updating to use - " . $final_img . "<br/>";
				$imgpath = $this->Curl->getImage($final_img);
				
				$save['id'] = $item['Item']['id'];
				$save['img_fullpath'] = $imgpath;
				$this->Item->save($save);
				
				$updated_image = true;
			}
			
			## if not, see if this item is a reprint. if it is, try using the image from the first print.
			if (!$updated_image) {
				if ($item['Item']['printing'] > 1) {
					$first_print = $this->Item->find('first', array('conditions' => array('Item.series_id' => $item['Item']['series_id'], 'Item.printing' => 1), 'limit' => 1, 'recursive' => 1));

					if (@$first_print['Item']['id']) {
						echo "[2] updating to " . $first_print['Item']['img_fullpath'] . "<br/>";						
						$save['id'] = $item['Item']['id'];
						$save['img_fullpath'] = $first_print['Item']['img_fullpath'];
						$this->Item->save($save);
						
						$updated_image = true;
					}
				} else {
					## its not a reprint, try getting the cover from a duplicate (variant)
					$first_print = $this->Item->find('first', array('conditions' => array('Item.series_id' => $item['Item']['series_id'], 'Item.printing' => 1), 'limit' => 1, 'recursive' => 1));

					if (@$first_print['Item']['id']) {
						if (@$first_print['Item']['img_fullpath'] != "/img/covers") {
							echo "[3] updating to " . $first_print['Item']['img_fullpath'] . "<br/>";						
							$save['id'] = $item['Item']['id'];
							$save['img_fullpath'] = $first_print['Item']['img_fullpath'];
							$this->Item->save($save);
							
							$updated_image = true;
						}
					}
									
				}			
			}			
			
			## still nothing, try getting anything from this series and using that..
			if (!$updated_image) {
			
				$series_print = $this->Item->find('first', array('conditions' => array('Item.series_id' => $item['Item']['series_id'], 'Item.img_fullpath != "/img/covers"'), 'limit' => 1, 'recursive' => 1));

				if (@$series_print['Item']['id']) {
					echo "[4] updating to " . $series_print['Item']['img_fullpath'] . "<br/>";						
					$save['id'] = $item['Item']['id'];
					$save['img_fullpath'] = $series_print['Item']['img_fullpath'];
					$this->Item->save($save);
					
					$updated_image = true;
				}

			}
			
			## still nothing?! try something external (google)
			echo "<br/>";
			
		}
		
		exit;
	}

	public function import_archives() {
		set_time_limit(0);	

		## first get a list of all the files..
		list ($d, $i) = $this->Curl->getRaw("http://www.previewsworld.com/Archive/1/1/71/994");
		$dom = new DOMDocument();
		@$dom->loadHTML($d);
		$xpath = new DOMXPath($dom);		

		$archive_files = $xpath->query('//div[@class="ArchiveFile"]/a');
		foreach ($archive_files as $file) {		
			$date = trim($file->nodeValue);
			$url = trim($file->getAttribute('href'));

			echo "date= " . $date . "<br/>";
			echo "getting archive url= " . $url . "<br/>";
			
			$this->_import("http://www.previewsworld.com".$url);
			echo "<br/><br/>";
		}
		exit;
	}

	public function import_next() {
		echo "importing upcoming... <br/>";
		$this->_import("http://www.previewsworld.com/shipping/upcomingreleases.txt");
		exit;
	}

	public function import($url="http://www.previewsworld.com/shipping/newreleases.txt") {
		$this->_import($url);
		exit;
	}
	
	public function _import($url="http://www.previewsworld.com/shipping/newreleases.txt") {
	
		set_time_limit(0);	
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
			if (substr($a, 0, 36) == "Sneak Peek At Upcoming Releases For ") {
				$date = trim(substr($a, 36));
			}
			if (substr($a, 0, 9) == "Shipping ") {
				$date = trim(substr($a, 9));
			}

			if (substr($a, 0, 33) == "PREVIEWSworld's New Releases For ") {
				$date = trim(substr($a, 33));
			}


			$a = trim($a);
			$parts = explode("\t", $a);

//			$part_1 = @$parts[0];
//
//			if ($part_1) {
//				echo "part 1 = " . $part_1 . "<br/>";
//			}

			$part_1 = @$parts[0];
			$part_2 = @$parts[1];
			$part_1 = trim($part_1);
			$part_2 = trim($part_2);

			if (!$part_2) {
				## try getting it w/ tabs
				$parts = explode("	", $a);
				$part_1 = @$parts[0];
				$part_2 = @$parts[1];
				$part_1 = trim($part_1);
				$part_2 = trim($part_2);
			} elseif ($part_2 == "PI") {
				## try getting it w/ tabs
				$parts = explode(" ", $a);
				$part_1 = @$parts[0];
				$part_2 = @$parts[1];
				$part_1 = trim($part_1);
				$part_2 = trim($part_2);
			}

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
				echo "part_1 = " . $part_1 . " - part_2 = " . $part_2 . " - section = " . $section . " - date = " . $date . "<br/>";
				$this->_getItem($part_1, $part_2, $section, $date);
				$cnt++;
			}


		}
	}
	
	function repull_img($id) {

		## get the item_id for this item..
		$item = $this->Item->find('first', array('conditions' => array('Item.id' => $id), 'limit' => 1, 'recursive' => 1));

		if ($item) {

			$update_img = array();
			$update_img['Item']['id'] = $item['Item']['id'];
			$update_img['Item']['thumbnails_processed'] = 0;

			$url = Configure::read('Settings.root_domain') . Configure::read('Settings.root_domain_path') . $item['Item']['item_id'];
			list ($d, $i) = $this->Curl->getRaw($url);

			$dom = new DOMDocument();
			@$dom->loadHTML($d);
			$xpath = new DOMXPath($dom);

			$img = $xpath->query('//img[@id="MainContentImage"]');
			foreach ($img as $tag) {
				$update_img['Item']['img'] = trim($tag->getAttribute('src'));
			}

			if (@$img) {

				$imgpath = $this->Curl->getsetImage($update_img['Item']['img'], $item['Item']['item_id'], 1);
				$update_img['Item']['img_fullpath'] = $imgpath;

				@unlink(WWW_ROOT.$update_img['Item']['img_fullpath'].'_50p.jpg');
				@unlink(WWW_ROOT.$update_img['Item']['img_fullpath'].'_25p.jpg');

				if ($this->Item->save($update_img)) {
					$this->Session->setFlash(__('Item Image Repulled!'), 'alert', array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					));
					$this->redirect('/items/'.$this->seoize($id, $item['Item']['item_name']));
				}
			}

		} else {
			$this->redirect('/');
			exit;
		}
		exit;

	}
	
	function get_inner_html( $node ) {
		$innerHTML= '';
		$children = $node->childNodes;
		foreach ($children as $child) {
			$innerHTML .= $child->ownerDocument->saveXML( $child );
		}
		return $innerHTML;
	}

	function strip_classes($data, $strips) {
		foreach ($strips as $strip) {
			$data = preg_replace('#<div class="'.$strip.'">(.*?)</div>#', '', $data);
		}
		return $data;
	}

	function _getItem($item_id, $item_name, $section, $date) {

		echo "<br/>";
		echo "iname=" . $item_name . "<br/>";
		
		$updatedTypes = array();

		$print = 1;
		$rand = rand(500,999);
		$url = Configure::read('Settings.root_domain') . Configure::read('Settings.root_domain_path') . $item_id;
		echo "url = " . $url . "<br/>";

		// check if we need this item, if its already been parsed, don't do it again..
		$item = $this->Item->find('first', array('conditions' => array('Item.item_id' => $item_id), 'limit' => 1, 'recursive' => 1));
		if (!$item) {
			
			list ($d, $i) = $this->Curl->getRaw($url);
			
			$dom = new DOMDocument();
			@$dom->loadHTML($d);
			$xpath = new DOMXPath($dom);

			$item = array();
			$item['item_id'] = $item_id;
			$item['item_date'] = date("Y-m-d", strtotime($date));
			
			$item['item_name'] = $item_name;
			echo "item_name  = [" . $item['item_name'] . "]<br/>";
			
			// fix 'of x' formatting..
			$item['item_name'] = trim(str_replace("Of(1)", "[OF 1]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(2)", "[OF 2]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(3)", "[OF 3]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(4)", "[OF 4]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(5)", "[OF 5]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(6)", "[OF 6]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(7)", "[OF 7]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(8)", "[OF 8]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(9)", "[OF 9]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(10)", "[OF 10]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(11)", "[OF 11]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(12)", "[OF 12]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(13)", "[OF 13]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(14)", "[OF 14]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(15)", "[OF 15]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(16)", "[OF 16]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(17)", "[OF 17]", $item['item_name']));
			$item['item_name'] = trim(str_replace("Of(18)", "[OF 18]", $item['item_name']));

			$item['item_name'] = trim(preg_replace("/\(C\:[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(C\: [^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(PP[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(NET\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(Net\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(MR\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(N52\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(RES\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(O\/A\)/","",$item['item_name']));
			
			$item['item_name'] = trim(preg_replace("/\(JAN[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(FEB[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(MAR[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(APR[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(MAY[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(JUN[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(JUL[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(AUG[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(SEP[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(OCT[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(NOV[^)]+\)/","",$item['item_name']));
			$item['item_name'] = trim(preg_replace("/\(DEC[^)]+\)/","",$item['item_name']));
			
			// remove 'COMBO PACK'..
			$item['item_name'] = trim(str_replace("COMBO PACK", "", $item['item_name']));
			$item['stock_id'] = $item_id;
			
			// parse item_name by # to get series name..
			$series_parts = explode("#", $item['item_name']);
			
			$item['series_name'] = trim($series_parts[0]);
			$item['series_name'] = trim(preg_replace("/\([^)]+\)/","",$item['series_name']));
			$item['series_name'] = trim(str_replace(" TP", "", $item['series_name']));
					
			if (@$series_parts[1]) {
				$series_num_parts = explode("\t", $series_parts[1]);
				$item['series_num'] = (int) $series_num_parts[0];
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
			if (strpos($item['item_name'], "6TH PTG")) {
				$print = 6;
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
				if (strpos($item_name, "6TH PTG")) {
					$print = 6;
				}
			}
			
			// remove printing strings from item name..
			$item['item_name'] = trim(str_replace("2ND PTG", "", $item['item_name']));
			$item['item_name'] = trim(str_replace("3RD PTG", "", $item['item_name']));
			$item['item_name'] = trim(str_replace("4TH PTG", "", $item['item_name']));
			$item['item_name'] = trim(str_replace("5TH PTG", "", $item['item_name']));
			$item['item_name'] = trim(str_replace("6TH PTG", "", $item['item_name']));
			$item['item_name'] = trim(str_replace("()", "", $item['item_name']));
			
			$item['printing'] = $print;
			
			$publisher = $xpath->query('//div[@class="Publisher"]');
			foreach ($publisher as $tag) {
				$item['publisher'] = $tag->nodeValue;
			}
			
			$creators = $xpath->query('//div[@class="Creators"]');
			foreach ($creators as $tag) {
				$creator_array = preg_split("/\(/", $tag->nodeValue);
				$cz = array();
				foreach ($creator_array as $c) {
					if ($c) {
						$creator_pieces = explode(")", $c);
						$e = explode("/", $creator_pieces[0]);
						foreach ($e as $el) {
							$creator_names = @explode(",", $creator_pieces[1]);
							foreach ($creator_names as $cn) {
								$cn = trim($cn);
								$cn = preg_replace('/\s+/', " ", $cn);
								if ($cn) {
									$cn = str_replace("& Various", "", $cn);
									$cz[$el][] = trim($cn);
								}
							}
						}
					}
				}
				$item['creators'] = $cz;
			}
	
			$description = @$xpath->query('//div[@class="Text"]');
			$desc = "";
			foreach ($description as $tag) {
				$desc = $this->get_inner_html($tag);
				$desc = preg_replace('/\s+/', " ", $desc);
			}

			$arr = array('ItemCode', 'ReleaseDate', 'SRP', 'PPrevue', 'Creators');
			$item['description'] = trim($this->strip_classes($desc, $arr));
			$item['description'] = trim(str_replace(array("\n", "\r", "&#13;"), '', $item['description']));
			$item['description'] = strip_tags($item['description']);

			$img = $xpath->query('//img[@id="MainContentImage"]');
			foreach ($img as $tag) {
				$item['img'] = trim($tag->getAttribute('src'));
			}
			
			$srp = $xpath->query('//div[@class="SRP"]');
			foreach ($srp as $tag) {
				$pri = substr($tag->nodeValue, 6);
				$item['srp'] = $pri;
			}
	
			// see if we have data; site can sometimes respond w/ an error..
			if (@$item['item_name']) {

				$item['section_id'] = $this->Section->getsetSection($section);
				$item['publisher_id'] = $this->Publisher->getsetPublisher($item['publisher']);
				$item['series_id'] = $this->Series->getsetSeries($item['series_name']);

				// override section_id for items matching t-shirt (T/S) and hoodies..
				if (strpos($item_name, "T/S")) {
					$item['section_id'] = 9;
				}
				if (strpos($item_name, "HOODIE")) {
					$item['section_id'] = 9;
				}
				if (strpos($item_name, "POSTER")) {
					$item['section_id'] = 9;
				}

				// check for digital packs / combo packs, set combo_pack flag if found..
				if (strpos($item_name, "DIG/P+")) {
					$item['combo_pack'] = 1;
					$item['item_name'] .= " (COMBO)";
				} elseif (strpos($item_name, "COMBO PACK")) {
					$item['combo_pack'] = 1;
					$item['item_name'] .= " (COMBO)";
				} else {
					$item['combo_pack'] = 0;
				}

				// get local image
				echo "img=" . $item['img'] . "<br/>";
				
				$imgpath = $this->Curl->getsetImage($item['img'], $item['item_id']);
				$item['img_fullpath'] = $imgpath;

//				echo "<textarea rows=50 style='width:100%;'>";
//				print_r($item);
//				echo "</textarea>";

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

							$updatedTypes['creator'][] = array(
								'item_id' => $item_id,
								'creator_id' => $creator_id
							);
						}
					}
				}

				///*************************************************************************************
				/// this code updates item_user_favorites so we can sort lists based on user favorites
				$favPublisher = $this->UserFavorite->find('all', array(
					'conditions' => array(
						'UserFavorite.favorite_item_id' => $item['publisher_id'],
						'UserFavorite.item_type' => 4
					)
				));

				foreach($favPublisher as $fav) {
					$this->ItemUserFavorite->add($fav['UserFavorite']['user_id'], $item_id, 4, $fav['UserFavorite']['id']);
				}

				$favSeries = $this->UserFavorite->find('all', array(
					'conditions' => array(
						'UserFavorite.favorite_item_id' => $item['series_id'],
						'UserFavorite.item_type' => 2
					)
				));

				foreach($favSeries as $fav) {
					$this->ItemUserFavorite->add($fav['UserFavorite']['user_id'], $item_id, 2, $fav['UserFavorite']['id']);
				}

				if (@$updatedTypes['creator']) {
					foreach($updatedTypes['creator'] as $creator) {
						$favCreator = $this->UserFavorite->find('all', array(
							'conditions' => array(
								'UserFavorite.favorite_item_id' => $creator['creator_id'],
								'UserFavorite.item_type' => 3
							)
						));
	
						foreach($favCreator as $fav) {
							$this->ItemUserFavorite->add($fav['UserFavorite']['user_id'], $item_id, 3, $fav['UserFavorite']['id']);
						}
					}
				}
				///*************************************************************************************
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
				} elseif (substr_count($value, ',') == 3) {
					$address = $value;

					## address can use a little cleanup
					$address = str_replace(', ....', '', $address);

				} elseif (strpos($value, 'Ph:') !== false) {
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
		if ($searchText) {
			$url = sprintf(Configure::read('Settings.API.google.places_url'), $searchText, Configure::read('Settings.API.google.key'));

			$this->log(sprintf('googlePlacesSearch: %s', $url));

			$results = file_get_contents($url);

			if ($log) {
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
		if ($reference) {
			$url = sprintf(Configure::read('Settings.API.google.details_url'), $reference, Configure::read('Settings.API.google.key'));

			$this->log(sprintf('googleDetailsSearch: %s', $url));

			$results = file_get_contents($url);

			if ($log) {
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
		if (!$data) {
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
			if (@$addressParts->types[0]) {
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
		}

		if (isset($data->result->formatted_phone_number)) {
			$store['phone_no'] = $data->result->formatted_phone_number;
		}

		if (isset($data->result->geometry->location->lat) && isset($data->result->geometry->location->lng)) {
			$store['latitude'] = $data->result->geometry->location->lat;
			$store['longitude'] = $data->result->geometry->location->lng;
		}

		if (isset($data->result->name)) {
			$store['name'] = $data->result->name;
		}

		if (isset($data->result->opening_hours->periods)) {
			foreach($data->result->opening_hours->periods as $day) {
				if (@$day->close->day) {
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
		}

		if (isset($data->result->website)) {
			$store['website'] = $data->result->website;
		}

		if (isset($data->result->reference)) {
			$store['google_reference'] = $data->result->reference;
		}

		return $store;
	}

	public function log($data="", $type=4) {
		echo sprintf('%s<br />', $data);
		CakeObject::log($data, 'tools');
	}
	
	
	
	public function import_store_photos() {

		set_time_limit(0);	
		
		## get stores that have a google reference id..
		$i = 0;
		$stores = $this->Store->find('all', array('conditions' => array('Store.google_reference <> ""'), 'recursive' => -1));
		foreach ($stores as $s) {

			$i++;
			echo "$i ] working [" . $s['Store']['name'] . "] ... <br/>";
			
			$url = sprintf(Configure::read('Settings.API.google.details_url'), $s['Store']['google_reference'], Configure::read('Settings.API.google.key'));
			$results = file_get_contents($url);
			$results = json_decode($results);

			$pc = 1;
			if (@$results->result->photos) {
				foreach ($results->result->photos as $p) {

					$photo_url = sprintf(Configure::read('Settings.API.google.photos_url'), $p->width, $p->photo_reference, Configure::read('Settings.API.google.key'));
					$img = $this->Curl->getStoreImage($photo_url, $s['Store']['id'], $pc);
					
					echo "img = " . $img . "<br/>";

					## store this in store_photos... 
					$store_photo = array();
					$store_photo['store_id'] = $s['Store']['id'];
					$store_photo['photo_path'] = $img;
					
					$this->StorePhoto->create();
					$this->StorePhoto->save($store_photo);					
					
					$pc++;					
				}
			}
			
			
			
		}

		exit;
	}

	public function removeMissingItemRefs() {
		set_time_limit(0);   ## forever

		$this->log('removeMissingItemRefs()');

		$this->log(' - processing creators (item_creators)');
		$creators = $this->Creator->query("SELECT * FROM item_creators WHERE NOT item_id IN (SELECT id FROM items)");
		$this->log(sprintf(' - found %s records', count($creators)));

		$this->log(' - removing creator records');
		$this->Creator->query("DELETE FROM item_creators WHERE NOT item_id IN (SELECT id FROM items)");

		$this->log(' - processing item tags');
		$tags = $this->Tag->query("SELECT * FROM item_tags WHERE NOT item_id IN (SELECT id FROM items)");
		$this->log(sprintf(' - found %s records', count($tags)));

		$this->log(' - removing item tag records');
		$this->Tag->query("DELETE FROM item_tags WHERE NOT item_id IN (SELECT id FROM items)");

		exit;
	}

	public function generateThumbs() {
		set_time_limit(0);   ## FOREVER

		$this->log('generateThumbs() - STARTED');

		$thumbs = array(
			'50' => array(
				'percent' => 0.5,
				'ext' => '_50p.jpg'
			),
			'25' => array(
				'percent' => 0.25,
				'ext' => '_25p.jpg'
			)
		);

		## get a list of items
		$items = $this->Item->find('all', array(
			'conditions' => array(
				'Item.img_fullpath != ""',
				'Item.thumbnails_processed' => false
			),
			'fields' => array(
				'Item.img_fullpath',
				'Item.id'
			),
			'recursive' => -1
		));

		if ($items) {
			$this->log(sprintf('%s items to process', count($items)));

			foreach($items as $item) {
				$img = $item['Item']['img_fullpath'];
				$img_fullPath = WWW_ROOT . $img;

				$img_fullPath = str_replace('//', '/', $img_fullPath);

				if (is_file($img_fullPath)) {
					$ext = pathinfo($img, PATHINFO_EXTENSION);

					foreach($thumbs as $thumb) {
						if (!is_file($img_fullPath . $thumb['ext'])) {
							list($width, $height) = getimagesize($img_fullPath);
							$new_width = $width * $thumb['percent'];
							$new_height = $height * $thumb['percent'];

							$image_p = imagecreatetruecolor($new_width, $new_height);
							$image = imagecreatefromjpeg($img_fullPath);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

							imagejpeg($image_p, $img_fullPath . $thumb['ext'], 100);

							$this->log(sprintf('generated thumb for %s - %s', $img, $img_fullPath . $thumb['ext']));
						}
					}

					$this->Item->id = $item['Item']['id'];
					$this->Item->saveField('thumbnails_processed', true);

					$this->_flushBuffers();
				} else {
					$this->Item->id = $item['Item']['id'];
					$this->Item->saveField('thumbnails_processed', true);

					$this->log(sprintf('file not found - %s', $img_fullPath));

					$this->_flushBuffers();
				}
			}
		} else {
			$this->log('no items found with images');
		}

		$this->log('generateThumbs() - FINISHED');

		exit;
	}

	private function _flushBuffers() {
		ob_end_flush();
		@ob_flush();
		ob_start();
	}
	
	/*public function buildUserSeries() {
		Configure::write('debug', 2);
		set_time_limit(0);   ## FOREVER
		
		## get a list of user items first
		$items = $this->UserItem->find('all', array(
			'contain' => array(
				'Item'
			)
		));
		
		foreach ($items as $item) {
			$itemId = $item['UserItem']['item_id'];
			$userId = $item['UserItem']['user_id'];
			$seriesId = $item['Item']['series_id'];
			
			echo sprintf(
				'item %s - series %s for user %s<br/>',
				$itemId,
				$seriesId,
				$userId
			);
			
			$this->UserSeries->add($userId, $seriesId);
		}
		
		echo 'DONE!'; exit;
	}*/
}