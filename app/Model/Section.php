<?php
App::uses('AppModel', 'Model');
class Section extends AppModel {

	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	
	
	public function getsetSection($section_name) {

		$section = $this->find('first', array('conditions' => array('Section.section_name' => $section_name), 'limit' => 1, 'recursive' => -1));
		if ($section) {
			return $section['Section']['id'];
		} else {
			$save_section = array();
			$save_section['section_name'] = $section_name;
			$this->create();
			$this->save($save_section);
			return $this->id;
		}
		
	}

}