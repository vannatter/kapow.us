<?php
App::uses('AppModel', 'Model');
class Series extends AppModel {
	public $name = "Series";
	public $actsAs = array('Containable');
	public $virtualFields = array(
		'total_items' => 'SELECT COUNT(*) AS icount FROM items WHERE items.series_id = series.id'
	);

	public function getsetSeries($series_name) {

		$series = $this->find('first', array('conditions' => array('Series.series_name' => $series_name), 'limit' => 1, 'recursive' => -1));
		if ($series) {
			return $series['Series']['id'];
		} else {
			$save_series = array();
			$save_series['series_name'] = $series_name;
			$this->create();
			$this->save($save_series);
			return $this->id;
		}
	}

}