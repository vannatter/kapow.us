<?php

App::uses('Helper', 'View');

class CommonHelper extends Helper {

    public $helpers = array('Html');

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
		$percent = 0.5;
		$thumb_ext = '_thumb.jpg';
    
        if (!is_file(WWW_ROOT . $orig . $thumb_ext)) {
 			list($width, $height) = getimagesize(WWW_ROOT . $orig);
			$new_width = $width * $percent;
			$new_height = $height * $percent;
			
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg(WWW_ROOT . $orig);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			imagejpeg($image_p, WWW_ROOT . $orig . $thumb_ext, 100);	    
		}
        return ($orig . $thumb_ext);
    }
    
    public function seoize($id, $string) {
	    return $id . "--" . low(Inflector::slug($string, '-'));
    }
	
}

?>