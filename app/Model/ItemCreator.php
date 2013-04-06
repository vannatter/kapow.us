<?php
App::uses('AppModel', 'Model');
class ItemCreator extends AppModel {

	public $actsAs = array('Containable');

	public $belongsTo = array(
		'Creator' => array(
			'className' => 'Creator',
			'foreignKey' => 'creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CreatorType' => array(
			'className' => 'CreatorType',
			'foreignKey' => 'creator_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item'
	);		
	
	
}