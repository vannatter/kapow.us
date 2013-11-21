<?
	class CurlComponent extends Component {
	  
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
		
	    function getImage($img) {
	    
	    	echo "img = " . $img . "<br/>\n";
	    
      		$local_path = Configure::read('Settings.icon_path') . strtolower($img);
      		$web_path   = Configure::read('Settings.icon_web_path') . strtolower($img);
      		
      		
			echo $local_path . "<br/>\n";
      		
      		if (file_exists($local_path)) {
				
				echo "exists";      		
				exit;      		
      		
        		return $web_path;        
      		} else {
      		
				echo "doesnt exists";      		
				exit;      		
      		
        		$img_path = Configure::read('Settings.root_domain') . strtolower($img);
        		mkdir(dirname($local_path), 0777, true);        		
        
        		$ch = curl_init();
		        curl_setopt ($ch, CURLOPT_URL, $img_path);
		        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
		        $fc = curl_exec($ch);
		        curl_close($ch);
    
		        $new_img = imagecreatefromstring($fc);
		        imagejpeg($new_img, $local_path, 100);
		        return $web_path;
      		}       
    	}		
    	
	    function getStoreImage($img, $store_id, $image_id) {
	    
			set_time_limit(0);	
	    
      		$local_path = Configure::read('Settings.store_img_path') . "/" . $store_id . "/" . $image_id . ".jpg";
      		$web_path   = Configure::read('Settings.store_img_web_path') . "/" . $store_id . "/" . $image_id . ".jpg";
      		
      		if (file_exists($local_path)) {
        		return $web_path;        
      		} else {
        		@mkdir(dirname($local_path), 0755, true);        		
        
        		$ch = curl_init();
		        curl_setopt ($ch, CURLOPT_URL, $img);
		        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
		        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);			
		        $fc = curl_exec($ch);
		        curl_close($ch);
    
		        $new_img = imagecreatefromstring($fc);
		        imagejpeg($new_img, $local_path, 100);
		        return $web_path;
      		}       
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
