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
		'AssetCompress.AssetCompress',
		'MinifyHtml.MinifyHtml'
	);

	public function beforeFilter() {
		$this->Auth->allow();
		$this->recordActivity();

		if ($this->Auth->user()) {
			if (!in_array(strtolower($this->request->action), array('setusername', 'logout', 'login'))) {
				$username = $this->Auth->user('username');
				if (empty($username)) {
					$this->redirect('/users/setUsername');
				}
			}
		}
	}

	public function hasAdminSession() {
		if (!$this->Auth->user() || (int)$this->Auth->user('access_level') !== 99) {
			$this->Session->setFlash(__('Invalid Access!'), 'flash_neg');
			$this->redirect('/');
			exit;
		}
	}

	public function hasSession() {
		if (!$this->Auth->user()) {
			$this->Session->setFlash(__('You are not logged in!'), 'flash_neg');
			$this->redirect('/');
			exit;
		}
	}

	public function seoize($id, $string) {
		$clean = str_replace("'", "", $string);
		return $id . "--" . strtolower(Inflector::slug($clean, '-'));
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

	public function recordActivity() {
		if ($this->Auth->user('id')) {
			$skip = array();
			$check = sprintf('%s/%s', strtolower($this->name), strtolower($this->action));

			if (!in_array($check, $skip) && strtolower($this->name) != 'admin') {
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
	
	public function _getReleaseDate($type='this_week') {
		$first_day = date("N", strtotime("today"));
		$release_date = date("Y-m-d", strtotime("today"));

		switch(strtolower($type)) {
			case 'this_week':
				if ($first_day < 3) {
					$release_date = date("Y-m-d", strtotime("this wednesday"));
				}
				if ($first_day == 3) {
					$release_date = date("Y-m-d", strtotime("today"));
				}
				if ($first_day == 4) {
					$release_date = date("Y-m-d", strtotime("yesterday"));
				}
				if ($first_day > 4) {
					$release_date = date("Y-m-d", strtotime("last wednesday") );
				}
				break;
			case 'next_week':
				$release_date = date("Y-m-d", strtotime("+1 week"));

				if ($first_day < 3) {
					$release_date = date("Y-m-d", strtotime("+2 wednesdays"));
				}
				if ($first_day == 3) {
					$release_date = date("Y-m-d", strtotime("+1 week"));
				}
				if ($first_day == 4) {
					$release_date = date("Y-m-d", strtotime("+6 days"));
				}
				if ($first_day > 4) {
					$release_date = date("Y-m-d", strtotime("this wednesday"));
				}
				break;
		}
		return $release_date;
	}
		
}

?>