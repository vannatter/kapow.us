<?php

App::uses('Helper', 'View');

class CommonHelper extends Helper {

    public $helpers = array('Html', 'Form');

    public function store_hours($open, $close) {
	    $tim = "";
	    if ($open == 0) {
		    return "Closed";
	    } else {

		    ## split parts by last two chars to get mins, remainder is time..
		    $open_hour = substr($open."", 0, -2);
		    $open_min  = substr($open."", -2);
		    
		    if ($open_min != "00") { $open_sub = ":" . $open_min; } else { $open_sub = ""; }
		    if ($open_hour > 12) {
			    $tim = (($open_hour+0)-12) . $open_sub . " PM to ";
		    } elseif ($open_hour == 12) {
			    $tim = "12" . $open_sub . " PM to ";
		    } else {
			    $tim = $open_hour . $open_sub . " AM to ";
		    }

		    $close_hour = substr($close."", 0, -2);
		    $close_min  = substr($close."", -2);
					    
		    if ($close_min != "00") { $close_sub = ":" . $close_min; } else { $close_sub = ""; }
		    if ($close_hour > 12) {
			    $tim .= (($close_hour+0)-12) . $close_sub . " PM";
		    } elseif ($close_hour == 12) {
			    $tim .= "12" . $close_sub . " PM";
		    } else {
			    $tim .= $close_hour . $close_sub . " AM";
		    }					    
					    
			return $tim;		    
	    }
    }

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

	    $ext = pathinfo($orig, PATHINFO_EXTENSION);

	    if ( ($ext == "jpg") || ($ext == "jpeg") ) {
		    
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
        
	    } else {
	    
	    	return $orig;
		    
	    }
        
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

	public function addFavButton($id, $type, $isFav) {
		$caption = __('Add Favorite');
		if($isFav) {
			$caption = __('Remove Favorite');
		}
		$caption = sprintf('<i class="icon-heart icon-white"></i> <span>%s</span>', $caption);

		return $this->Form->button($caption, array('type' => 'button', 'class' => 'btn btn-custom toggle_favorite', 'data-id' => $id, 'data-type' => $type));
	}

	public function pullButton($id, $hasPull) {
		$caption = __('Pull List');
		$more_css = "";
		if($hasPull) {
			$caption = __('Remove Pull');
			$more_css = "btn btn-mini pull_list_btn btn-on";
			$icon_color = "black";
		} else {
			$more_css = "btn btn-mini pull_list_btn btn-off";
			$icon_color = "white";
		}
		$caption = sprintf('<i class="icon-shopping-cart icon-' . $icon_color .'"></i> <span>%s</span>', $caption);

		return $this->Form->button($caption, array('type' => 'button', 'class' => $more_css, 'data-id' => $id));
	}

	public function favRemoveButton($favId) {
		$caption = sprintf('<i class="icon-heart icon-white"></i> <span>%s</span>', __('Remove'));

		##return $this->Form->button($caption, array('type' => 'button', 'class' => 'btn btn-custom', 'data-id' => $favId));
		return $this->Html->link($caption, '/favorites/remove/' . $favId, array('class' => 'btn btn-custom my-favorite-remove', 'escape' => false, 'data-id' => $favId));
	}

	public function libraryRemoveButton($itemId) {
		$caption = sprintf('<i class="icon-shopping-cart icon-white"></i> <span>%s</span>', __('Remove'));

		return $this->Html->link($caption, '/users/libraryRemove/' . $itemId, array('class' => 'btn btn-custom library-remove', 'escape' => false, 'data-id' => $itemId));
	}
}