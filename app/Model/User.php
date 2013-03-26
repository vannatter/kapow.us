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
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Password is required',
			),
			'length' => array(
				'rule' => array('minLength', 6),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'At least 6 characters',
			),
		),
		'confirm_password' => array(
			'empty_create' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Please confirm the passwords',
			),
			'empty_update' => array(
				'rule' => 'validateConfirmPasswordEmptyUpdate',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'update',
				'message' => 'Please confirm the passwords',
			),
			'match' => array(
				'rule' => 'validateConfirmPasswordMatch',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'The passwords do not match',
			),
		)
	);

	public function validateConfirmPasswordEmptyUpdate() {
		return !empty($this->data[$this->alias]['clear_password']) && !empty($this->data[$this->alias]['confirm_password']);
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
