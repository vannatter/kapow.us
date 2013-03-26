<?php
App::uses('AppModel', 'Model');
/**
 * ItemTag Model
 *
 */
class ItemTag extends AppModel {

	public $belongsTo = array(
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);		
	
	
}
