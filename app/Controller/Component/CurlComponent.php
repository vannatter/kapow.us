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
      		$local_path = Configure::read('Settings.icon_path') . strtolower($img);
      		$web_path   = Configure::read('Settings.icon_web_path') . strtolower($img);
      		
      		if (file_exists($local_path)) {
        		return $web_path;        
      		} else {
        		$img_path = Configure::read('Settings.root_domain') . strtolower($img);
        		@mkdir(dirname($local_path), 0755, true);        		
        
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