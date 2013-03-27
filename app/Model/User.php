<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid',
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Already Used'
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Required',
			),
		),
		'clear_password' => array(
			'empty' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Password is required',
			),
			'length' => array(
				'rule' => array('minLength', 6),
				'allowEmpty' => false,
				'message' => 'At least 6 characters',
			),
		),
		'confirm_password' => array(
			'empty_create' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Please confirm the passwords',
			),
			'empty_update' => array(
				'rule' => 'validateConfirmPasswordEmptyUpdate',
				'allowEmpty' => false,
				'on' => 'update',
				'message' => 'Please confirm the passwords',
			),
			'match' => array(
				'rule' => 'validateConfirmPasswordMatch',
				'allowEmpty' => true,
				'message' => 'The passwords do not match',
			),
		)
	);

	public function validateConfirmPasswordEmptyUpdate() {
		if(isset($this->data[$this->alias]['clear_password']) && isset($this->data[$this->alias]['confirm_password'])) {
			return !empty($this->data[$this->alias]['clear_password']) && !empty($this->data[$this->alias]['confirm_password']);
		}

		return true;
	}

	public function validateConfirmPasswordMatch() {
		return $this->data[$this->alias]['clear_password'] == $this->data[$this->alias]['confirm_password'];
	}

	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['clear_password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['clear_password']);
		}

		return true;
	}
}
