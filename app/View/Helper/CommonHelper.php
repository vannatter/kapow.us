<?php

App::uses('Helper', 'View');

class CommonHelper extends Helper {

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
	
}

?>