<?
	class CurlComponent extends Object {
	  
		function getRAW($url) {
			$curl = curl_init();
      
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
  			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);			
			
  			$f = curl_exec($curl);
			$i = curl_getinfo($curl);
  			
  			curl_close($curl);	

  			return array($f, $i);
		}
		
		function getBNET($url, $last_time_accessed=0) {
		
			$url_parts = parse_url($url);
			$curl = curl_init();
      
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
  			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
			
			date_default_timezone_set('GMT');
			$request_date = date(DATE_RFC2822);
			
			$StringToSign = "GET" . "\n" . $request_date . "\n" . $url_parts['path'] . "\n";
			
			$private_key = Configure::read('Settings.API.private');
			$public_key = Configure::read('Settings.API.public');
			
			$signature = base64_encode(hash_hmac('sha1', $StringToSign, $private_key, true));
			$authorization = "BNET" . " " . $public_key . ":" . $signature;
			
			if ($last_time_accessed > 0) {
				curl_setopt($curl, CURLOPT_TIMECONDITION, CURL_TIMECOND_IFMODSINCE);
				curl_setopt($curl, CURLOPT_TIMEVALUE, $last_time_accessed);
			}

			$header = array (
				"Date: " . $request_date,
				"Authorization: " . $authorization
			); 
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			
  			$f = curl_exec($curl);
			$i = curl_getinfo($curl);
  			curl_close($curl);
  			
  			return array($f, $i);
		}
		
		
	    function getIcon($icon_name) {
      		if (trim($icon_name) == "") {
        		$icon_name = "INV_Misc_QuestionMark";      
      		}
      		
      		$icon_name = str_replace(" ", "", $icon_name);
    
      		$local_path = Configure::read('Settings.icon_path') . strtolower($icon_name).".jpg";
      		$web_path   = Configure::read('Settings.icon_web_path') . strtolower($icon_name).".jpg";

      		if (file_exists($local_path)) {
        		return $web_path;        
      		} else {
        		$bnet_img = "http://us.media.blizzard.com/wow/icons/36/" . strtolower($icon_name) . ".jpg";
        
        		$ch = curl_init();
		        curl_setopt ($ch, CURLOPT_URL, $bnet_img);
		        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
		        $fc = curl_exec($ch);
		        curl_close($ch);
    
		        $new_img = imagecreatefromstring($fc);
		        imagejpeg($new_img, $local_path, 100);
		        return $web_path;
      		}       
    	}		
    	
    	
	    function getEnchant($enchant_id) {
	    	$url = "http://db.mmo-champion.com/e/" . $enchant_id;
	    	$ch = curl_init();
	    	curl_setopt ($ch, CURLOPT_URL, $url);
	    	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	    	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
	    	$fc = curl_exec($ch);
	    	curl_close($ch);

			preg_match_all('/<h1>(.*)<\/h1>/', $fc, $matches);
	    	$match = @$matches[0][1];
	    	
	    	if ($match) {
	    		$clean_enchant = strip_tags($match);
	    		return $clean_enchant;
	    	} else {
	    		return "";
	    	}
    	}	    

		function getAchievement($achievement_id) {
	    	$url = "http://db.mmo-champion.com/a/" . $achievement_id;
	    	$ch = curl_init();
	    	curl_setopt ($ch, CURLOPT_URL, $url);
	    	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	    	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
	    	$fc = curl_exec($ch);
	    	curl_close($ch);
	    	
			preg_match_all('/<h1>(.*)<\/h1>/', $fc, $titles);
			preg_match_all('/<li><span>(.*) points<\/span><\/li>/', $fc, $points);
			$title = @$titles[0][1];
			$point = @$points[1][0];
			
			preg_match_all('/<img src="http:\/\/static.mmo-champion.com\/db\/img\/icons\/(.*).png" width="48" height="48">/', $title, $icons);
			$icon = @$icons[1][0];

			preg_match_all('/<div class="tta-objective">(.*)<\/div>/', $fc, $objectives);
	    	$text = @$objectives[1][0];
	    	
			$text = preg_replace('/<table class="tta-criteria">(.*)<\/table>/', "", $text);
			
			preg_match_all('/<div class="tta-reward">(.*)<\/div>/', $text, $rewards);
			$reward = @$rewards[1][0];
	    	
			$text = preg_replace('/<div class="tta-reward">(.*)<\/div>/', "", $text);

			$text = trim(strip_tags($text));
			$title = trim(strip_tags($title));
			$reward = trim(strip_tags($reward));
			
			$point = trim($point);
			if (!$point) { $point = 0; }
			
	    	$tmp = array();
	    	$tmp['title'] = $title;
	    	$tmp['points'] = $point;
	    	$tmp['icon'] = $icon;
	    	$tmp['text'] = $text;
	    	$tmp['reward'] = $reward;
	    	
	    	return $tmp;
    	}    	
		
		function getBNETprefix($region) {
			$url = "";
			
			switch ($region) {
				case "us":
					$url = "http://us.battle.net";
					break;

				case "eu":
					$url = "http://eu.battle.net";
					break;
					
				case "kr":
					$url = "http://kr.battle.net";
					break;
					
				case "tw":
					$url = "http://tw.battle.net";
					break;

				case "cn":
					$url = "http://battlenet.com.cn";
					break;
					
				default:
					$url = "http://us.battle.net";
					break;
			}
			
			return $url;
		}		
		
		
		function _getUniqueName() {
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = "";
			while ($i <= 24) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}
	}
?>