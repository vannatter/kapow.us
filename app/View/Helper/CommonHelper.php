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
	
    public function thumb($orig, $which="25p") {

		// build 50p    
		$percent = 0.5;
		$thumb_ext = '_50p.jpg';
    
        if (!is_file(WWW_ROOT . $orig . $thumb_ext)) {
 			list($width, $height) = getimagesize(WWW_ROOT . $orig);
			$new_width = $width * $percent;
			$new_height = $height * $percent;
			
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg(WWW_ROOT . $orig);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			imagejpeg($image_p, WWW_ROOT . $orig . $thumb_ext, 100);	    
		}

		// build 25p
		$percent = 0.25;
		$thumb_ext = '_25p.jpg';
    
        if (!is_file(WWW_ROOT . $orig . $thumb_ext)) {
 			list($width, $height) = getimagesize(WWW_ROOT . $orig);
			$new_width = $width * $percent;
			$new_height = $height * $percent;
			
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg(WWW_ROOT . $orig);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			imagejpeg($image_p, WWW_ROOT . $orig . $thumb_ext, 100);	    
		}
		
        return ($orig . "_" . $which . ".jpg");
    }
    
    public function seoize($id, $string) {
	    return $id . "--" . strtolower(Inflector::slug($string, '-'));
    }
    
    public function creators($creator_array) {
		$formatted = array();	    
		$output = "";
	    foreach ($creator_array as $c) {
		    $formatted[$c['CreatorType']['creator_type_name']][$c['Creator']['id']] = $c['Creator']['creator_name'];
	    }

		$output .= "<div class='creators'>";
		foreach ($formatted as $k=>$v) {
			$output .= "<div class='creator_type'><h4>" . $k . "(s):</h4>";
			$creator_string = "";
			foreach ($v as $x=>$y) {
				$creator_string .= "<a href='/creators/" . $this->seoize($x, $y) . "'>" . $y . "</a>, ";
			}
			$output .= substr($creator_string, 0, -2);
			$output .= "</div>";
						
		}
		$output .= "</div>";	    
	    return $output;
    }
    
    public function series($series_num, $series_data, $show_name_only=0) {
		$output = "";
	    
	    if ( ($series_num > 0) && ($show_name_only == 0) ) {
		    $output .= "#" . $series_num . " of ";
	    }

		$output .= "<a href='/series/" . $this->seoize($series_data['id'], $series_data['series_name']) . "'>" . $series_data['series_name'] . "</a>";	    
	    
	    return $output;
    }
    

	public function formatMoney($amount=0.00) {
		setlocale(LC_ALL, ''); // Locale will be different on each system.
		$locale = localeconv();
		echo $locale['currency_symbol'], number_format($amount, 2, $locale['decimal_point'], $locale['thousands_sep']);
	}
}

?>