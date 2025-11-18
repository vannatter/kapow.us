<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 * @property Publisher $Publisher
 * @property Creator $Creator
 * @property Series $Series
 */
class SearchController extends AppController {
	public $name = 'Search';
	public $uses = array('Item', 'Publisher', 'Creator', 'Series');

	public function index() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->sanitizeData($this->request->data);

			if (isset($data['Search']['terms']) && isset($data['Search']['type'])) {
				$terms = $data['Search']['terms'];
				$type = $data['Search']['type'];

				if (empty($terms)) {
					$this->redirect('/search');
				}

				$this->redirect(sprintf('/search?terms=%s&type=%s', $terms, $type));
			}
		}

		if (isset($this->request->query['terms']) && isset($this->request->query['type'])) {
			$terms = $this->request->query['terms'];
			$type = $this->request->query['type'];

			$results = array();

			switch($type) {
				case 1:   ## ITEMS
					$this->paginate = array(
						'Item' => array(
							'order' => array(
								'Publisher.weight' => 'DESC',
								'Item.item_date' => 'DESC',
								'Item.item_name' => 'ASC'
							),
							'limit' => 50
						)
					);
					$results = $this->paginate('Item', array(
						'OR' => array(
							'Item.item_name LIKE' => '%' . $terms . '%',
							'Item.description LIKE' => '%' . $terms . '%'
						)
					));
					break;
					
				case 2:   ## PUBLISHERS
					$this->paginate = array(
						'Publisher' => array(
							'order' => array(
								'Publisher.publisher_bio' => 'DESC',
								'Publisher.publisher_name' => 'ASC'
							),
							'limit' => 50
						)
					);
					$results = $this->paginate('Publisher', array(
						'OR' => array(
							'Publisher.publisher_name LIKE' => '%' . $terms . '%',
							'Publisher.publisher_bio LIKE' => '%' . $terms . '%'
						)
					));
					break;

				case 3:   ## CREATORS
					$this->paginate = array(
						'Creator' => array(
							'order' => array(
								'Creator.creator_bio' => 'DESC',
								'Creator.creator_name' => 'ASC'
							),
							'limit' => 50
						)
					);
					$results = $this->paginate('Creator', array(
						'OR' => array(
							'Creator.creator_name LIKE' => '%' . $terms . '%',
							'Creator.creator_bio LIKE' => '%' . $terms . '%'
						)
					));
					break;

				case 4:   ## SERIES
					$this->Series->bindModel(array('hasMany' => array('Item' => array('foreignKey' => 'series_id', 'order' => 'Item.item_date DESC', 'limit' => 1))));
					$this->paginate = array(
			            'Item' => array(
			                'fields' => array(
			                    'Item.img_fullpath',
			                    'Item.description'
			                )
			            ),
						'Series' => array(
							'order' => array(
								'Series.total_items' => 'DESC',
								'Series.series_name' => 'ASC'
							),
							'limit' => 50
						)
					);
					$results = $this->paginate('Series', array(
						'Series.series_name LIKE' => '%' . $terms . '%'
					));
					break;
			}

			$this->set('terms', $terms);
			$this->set('type', $type);
			$this->set('results', $results);
		}

		$this->set('types', array(
			'1' => __('Item'),
			'2' => __('Publisher'),
			'3' => __('Creator'),
			'4' => __('Series')
		));
	}
}