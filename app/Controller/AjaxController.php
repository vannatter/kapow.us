<?php

App::uses('AppController', 'Controller');

class AjaxController extends AppController {

	public $name = 'Ajax';
	public $uses = array(
		'Item','Section','Publisher','Series','Creator', 'CreatorType',
		'ItemCreator', 'Store','Tag','ItemTag','StorePhoto', 'UserItem', 'Pull',
		'UserSeries'
	);
	public $components = array('Curl');
	public $helpers = array('Common');
	
	public function random_item() {

		$ticker = null;
		$tapeTypes = array('item', 'creator');

		switch($tapeTypes[array_rand($tapeTypes)]) {
			case 'item':
				$ticker = $this->Item->getRandom();
				break;
			case 'creator':
				$ticker = $this->Creator->getRandom();
				break;
		}
		
		$output = json_encode($ticker);
		echo $output;
		exit;
	}
	
	public function toggle_library($id=null) {
		$result = array('error' => true, 'message' => __('Invalid'));
		$id = @$this->request->query['id'];

		## make sure user id logged in
		if ($this->Auth->user()) {
			## make sure item is valid
			if ($item = $this->Item->findById($id)) {
				$result['type'] = $this->UserItem->toggle($id, $this->Auth->user('id'));
				$result['error'] = false;
				
				if ($result['type'] == 1) {
					## remove the item from the users pull list, since its in their library now
					if ($pull = $this->Pull->findByItemIdAndUserId($id, $this->Auth->user('id'))) {
						$this->Pull->delete($pull['Pull']['id']);
					}
					
					## add the series id to the user_series table so we can track series for each user
					$this->Item->id = $id;
					$series_id = $this->Item->field('series_id');
					if ($series_id) {
						$this->UserSeries->add($this->Auth->user('id'), $series_id);
					}
				} else {
					$this->Item->id = $id;
					$series_id = $this->Item->field('series_id');
					if ($series_id) {
						$this->UserSeries->remove($this->Auth->user('id'), $series_id);
					}
				}
			} else {
				$result['message'] = __('Item Not Found');
			}
		} else {
			$result['message'] = __('Not logged in; %s or %s', '<a href="/users/login">login</a>', '<a href="/users/register">create an account</a>');
		}

		return new CakeResponse(array('body' => json_encode($result)));
		exit;
	}
	
	public function itemHotness() {
		$result = $this->_startResponse();
		
		if (isset($this->request->query['itemId']) && isset($this->request->query['value'])) {
			$itemId = $this->request->query['itemId'];
			$value = $this->request->query['value'];
			
			## make sure the item is valid
			if ($item = $this->Item->findById($itemId)) {
				$this->Item->id = $itemId;
				$this->Item->saveField('hot', $value);
			} else {
				$result['status']['message'] = __('Invalid Item');
			}
		} else {
			$result['status']['message'] = __('Invalid Item');
		}
		
		return $this->_sendResponse($result);
	}
	
	private function _startResponse() {
		return array('error' => false, 'status' => array('status_code' => 204, 'status_message' => ''));
	}
	
	private function _sendResponse($result=null) {
		return new CakeResponse(array('body' => json_encode($result)));
	}
	
	public function publisherWeight() {
		$result = $this->_startResponse();
		
		if (isset($this->request->query['publisherId']) && isset($this->request->query['value'])) {
			$publisherId = $this->request->query['publisherId'];
			$value = $this->request->query['value'];
			
			## make sure the publisher is valid
			if ($publisher = $this->Publisher->findById($publisherId)) {
				$this->Publisher->id = $publisherId;
				$this->Publisher->saveField('weight', $value);
			} else {
				$result['status']['message'] = __('Invalid Publisher');
			}
		} else {
			$result['status']['message'] = __('Invalid Publisher');
		}
		
		return $this->_sendResponse($result);
	}
}