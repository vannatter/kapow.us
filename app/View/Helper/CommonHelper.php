<?php

App::uses('Helper', 'View');

class CommonHelper extends Helper {

    public $helpers = array('Html');

    private $thumbs_dir = 'img/covers/thumbs';
    private $width;
    private $height;

	public function printing($printing) {
		
		switch ($printing) {			
			case "1":
				echo "1st Printing";
				break;
			case "2":
				echo "2nd Printing";
				break;
			case "3":
				echo "3rd Printing";
				break;
			case "4":
				echo "4th Printing";
				break;
			case "5":
				echo "5th Printing";
				break;
			
		}
	}
	
    public function thumb($orig) {
    
    	$real_path = str_replace("/img/covers","",$orig);
    
        if (!is_file(WWW_ROOT . $this->thumbs_dir . $real_path)) {

			$percent = 0.5;
			
			// Get new dimensions
			list($width, $height) = getimagesize(WWW_ROOT . $orig);
			$new_width = $width * $percent;
			$new_height = $height * $percent;
			
			// Resample
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg(WWW_ROOT . $orig);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			// Output
			imagejpeg($image_p, WWW_ROOT . $this->thumbs_dir . $real_path, 100);	    
			
		}
		
        return ("/" . $this->thumbs_dir . $real_path);
		
    }
	
}

?>