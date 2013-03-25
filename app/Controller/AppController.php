<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $theme = "Kapow";
	
    public $helpers = array(
      'Common',
			'Session',
			'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
			'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
			'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
    );
    	
}

?>