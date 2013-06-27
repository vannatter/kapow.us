<?php
App::uses('Helper', 'View');

class AdminHelper extends Helper {
	public $helpers = array('Html', 'Form', 'Time');

	public function getReportStatus($statusId) {
		switch($statusId) {
			case 0:
				return __('Unread');
				break;
			case 1:
				return __('Open');
				break;
			case 99:
				return __('Closed');
				break;
		}

		return __('Unknown');
	}

	public function getReportType($typeId) {
		switch($typeId) {
			case 1:
				return __('Item');
				break;
			case 2:
				return __('Series');
				break;
			case 3:
				return __('Creator');
				break;
			case 4:
				return __('Publisher');
				break;
			case 5:
				return __('Shop');
				break;
		}

		return __('Unknown');
	}

	public function cleanDate($datetime, $wrap=false) {
		if(substr($datetime, 0, 10) == '0000-00-00') {
			$clean = '';
		} else {
			$clean = $this->Time->format('m/d/Y', $datetime);
		}

		$clean = sprintf('<span title="%s" class="help">%s</span>', $this->Time->format('h:i:s A', $datetime), $clean);

		return $clean;
	}
}