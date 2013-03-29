<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 */
class Tag extends AppModel {
	public $actsAs = array('Containable');
	public $hasMany = array('ItemTag');
}
