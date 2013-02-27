<?php
App::uses('AppModel', 'Model');
class ItemCategory extends AppModel {
	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
}