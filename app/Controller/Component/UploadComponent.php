<?php
App::uses('Component', 'Controller');

class UploadComponent extends Component {
	public function image($upload, $uploadPath, $name=null) {
		if((isset($upload['error']) && $upload['error'] == 0) || (!empty($upload['tmp_name']) && $upload['tmp_name'] != 'none')) {

			if(!$name) {
				$name = $upload['name'];
			}

			$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
			$allowedTypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
			$extension = end(explode(".", $name));

			if(!in_array($upload['type'], $allowedTypes) || !in_array($extension, $allowedExts)) {
				return __('Invalid Type');
			} else {
				if(!file_exists($uploadPath)) {
					mkdir($uploadPath);
					//copy(Configure::read('Settings.Paths.Raw.media') . 'index.php', $uploadPath . 'index.php');
				}

				move_uploaded_file($upload['tmp_name'], $uploadPath . $name);

				return null;
			}
		}

		return __('Invalid Upload');
	}
}