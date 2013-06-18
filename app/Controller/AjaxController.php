<?php

App::uses('AppController', 'Controller');

class AjaxController extends AppController {

	public $name = 'Ajax';
	public $uses = array('Item','Section','Publisher','Series','Creator','CreatorType','ItemCreator', 'Store','Tag','ItemTag','StorePhoto');
	public $components = array('Curl');
	public $helpers = array('Common');
	
	public function random_item() {
		

		
		exit;
	}
	
}