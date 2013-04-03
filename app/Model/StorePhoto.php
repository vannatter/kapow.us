<?php
App::uses('AppModel', 'Model');
class StorePhoto extends AppModel {

	public $belongsTo = array(
		'Store' => array(
			'className' => 'Store',
			'foreignKey' => 'store_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);		
	
	
}