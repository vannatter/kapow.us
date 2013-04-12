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
App::uses('Sanitize', 'Utility');

class AppController extends Controller {
	public $theme = "Kapow";
	public $components = array(
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email')
				)
			),
			'authorize' => 'Controller'
		),
		'Facebook.Connect' => array('model' => 'User'),
		'Session',
		'DebugKit.Toolbar'
	);
	public $helpers = array(
		'Common',
		'Session',
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
		'Facebook.Facebook'
	);

	public function beforeFilter() {
		$this->Auth->allow('*');
	}

	public function hasAdminSession() {
		if(!$this->Auth->user() || (int)$this->Auth->user('access_level') !== 99) {
			$this->Session->setFlash(__('Invalid Access'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/');
			exit;
		}
	}

	public function hasSession() {
		if(!$this->Auth->user()) {
			$this->Session->setFlash(__('Invalid Access'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/');
			exit;
		}
	}

	public function seoize($id, $string) {
		return $id . "--" . strtolower(Inflector::slug($string, '-'));
	}

	## this is a callback for the Facebook plugin
	public function afterFacebookLogin() {
	}

	## this is a callback for the Facebook plugin
	public function beforeFacebookSave() {
		$this->Connect->authUser['User']['email'] = $this->Connect->user('email');
		return true; //Must return true or will not save.
	}

	## this is a callback for the Facebook plugin
	public function afterFacebookSave($memberId=null) {
	}
}

?>