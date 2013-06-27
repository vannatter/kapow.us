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
		'Facebook.Facebook',
		'AssetCompress.AssetCompress'
	);

	public function beforeFilter() {
		$this->Auth->allow('*');

		$this->recordActivity();

		if($this->Auth->user()) {
			if(!in_array(strtolower($this->request->action), array('setusername', 'logout', 'login'))) {
				$username = $this->Auth->user('username');
				if(empty($username)) {
					$this->redirect('/users/setUsername');
				}
			}
		}
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

	function recordActivity() {
		if($this->Auth->user('id')) {
			$skip = array();
			$check = sprintf('%s/%s', strtolower($this->name), strtolower($this->action));

			if(!in_array($check, $skip) && strtolower($this->name) != 'admin') {
				$data = array(
					'UserActivity' => array(
						'user_id' => $this->Auth->user('id'),
						'ip_address' => $_SERVER['REMOTE_ADDR'],
						'browser' => $_SERVER['HTTP_USER_AGENT'],
						'controller' => $this->name,
						'action' => $this->action,
						'request' => serialize($this->request)
					)
				);

				$this->UserActivity = ClassRegistry::init('UserActivity');
				$this->UserActivity->save($data);
				unset($data);
			}
		}
	}
}

?>