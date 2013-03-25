<?php
/**
 * CakePHP Component & Model Code Completion
 * @author junichi11
 *
 * ==============================================
 * CakePHP Core Components
 * ==============================================
 * @property AuthComponent $Auth
 * @property AclComponent $Acl
 * @property CookieComponent $Cookie
 * @property EmailComponent $Email
 * @property RequestHandlerComponent $RequestHandler
 * @property SecurityComponent $Security
 * @property SessionComponent $Session
 */
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