<?php

App::uses('AppController', 'Controller');

/**
 * @property Item $Item
 * @property Creator $Creator
 * @property CreatorType $CreatorType
 * @property Publisher $Publisher
 * @property Series $Series
 * @property Store $Store
 * @property User $User
 * @property Category $Category
 * @property Section $Section
 * @property Report $Report
 */
class AdminController extends AppController {
	public $name = 'Admin';
	public $uses = array('Item', 'Creator', 'Publisher', 'Series', 'Store', 'User', 'Category', 'CreatorType', 'Section', 'Report');
	public $helpers = array('States');
	public $components = array('Upload');
	public $paginate = array(
		'Item' => array(
			'limit' => 25,
			'order' => array('Item.id' => 'asc')
		),
		'Creator' => array(
			'limit' => 25,
			'order' => array('Creator.id' => 'asc')
		),
		'Publisher' => array(
			'limit' => 25,
			'order' => array('Publisher.id' => 'asc')
		),
		'Series' => array(
			'limit' => 25,
			'order' => array('Seriesid' => 'asc')
		),
		'Store' => array(
			'limit' => 25,
			'order' => array('Store.id' => 'asc')
		),
		'User' => array(
			'limit' => 25,
			'order' => array('User.id' => 'asc')
		),
		'Category' => array(
			'limit' => 25,
			'order' => array('Category.id' => 'asc')
		),
		'Section' => array(
			'limit' => 25,
			'order' => array('Section.id' => 'asc')
		),
		'Report' => array(
			'limit' => 25,
			'order' => array('Report.id' => 'asc')
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		parent::hasAdminSession();

		$this->layout = 'admin';
	}

	public function index() {
	}

	##### ITEMS
	public function items() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate('Item'));
	}

	public function itemsEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Item']['id'] = $id;

			if($this->Item->save($data)) {
				$this->Session->setFlash(__('Item Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect('/admin/items');
			}
		} else {
			$this->Item->id = $id;
			if(!$this->Item->exists()) {
				$this->Session->setFlash(__('Item Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/items');
			}

			$item = $this->Item->read();
			$this->request->data = $item;
		}

		$this->set('sections', $this->Item->Section->find('list', array('fields' => array('id', 'section_name'))));
		$this->set('publishers', $this->Publisher->find('list', array('fields' => array('id', 'publisher_name'))));
		$this->set('series', $this->Series->find('list', array('fields' => array('id', 'series_name'))));
	}

	public function creators() {
		$this->Creator->recursive = 0;
		$this->set('creators', $this->paginate('Creator'));
	}

	public function creatorsEdit($id) {
		if($this->request->is('put') || $this->request->is('post')) {
			$data = Sanitize::clean($this->request->data);

			$skip = false;
			if(isset($data['Creator']['photo_upload']['name']) && !empty($data['Creator']['photo_upload']['name'])) {
				$uploadPath = Configure::read('Settings.creator_img_path');
				$uploadPath .= '/' . $id . '/';

				## process the upload, make sure its valid
				$upload = $data['Creator']['photo_upload'];

				if($msg = $this->Upload->image($upload, $uploadPath)) {
					$this->Creator->validationErrors['creator_photo'] = $msg;
					$skip = true;
				} else {
					$data['Creator']['creator_photo'] = Configure::read('Settings.creator_img_web_path') . '/' . $id . '/' . $upload['name'];
				}
			}

			if(!$skip) {
				$data['Creator']['id'] = $id;

				if($this->Creator->save($data)) {
					$this->Session->setFlash(__('Creator Saved!'), 'alert', array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					));
					$this->redirect('/admin/creators');
				}
			}
		} else {
			$this->Creator->id = $id;
			if(!$this->Creator->exists()) {
				$this->Session->setFlash(__('Creator Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/creators');
			}

			$creator = $this->Creator->read();
			$this->request->data = $creator;
		}
	}

	public function creatorTypes() {
		$this->CreatorType->recursive = 0;
		$this->set('creatorTypes', $this->paginate('CreatorType'));
	}

	public function creatorTypesEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['CreatorType']['id'] = $id;

			if($this->CreatorType->save($data)) {
				$this->Session->setFlash(__('Creator Type Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/creatorTypes');
			}
		} else {
			$this->CreatorType->id = $id;
			if(!$this->CreatorType->exists()) {
				$this->Session->setFlash(__('Creator Type Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/creatorTypes');
			}

			$creatorType = $this->CreatorType->read();
			$this->request->data = $creatorType;
		}
	}

	public function publishers() {
		$this->Publisher->recursive = 0;
		$this->set('publishers', $this->paginate('Publisher'));
	}

	public function publishersEdit($id) {
		if ($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$skip = false;
			if (isset($data['Publisher']['photo_upload']['name'])) {
				$uploadPath = Configure::read('Settings.publisher_img_path');
				$uploadPath .= '/' . $id . '/';

				## process the upload, make sure its valid
				$upload = $data['Publisher']['photo_upload'];

				if ((isset($upload['error']) && $upload['error'] == 0) || (!empty($upload['tmp_name']) && $upload['tmp_name'] != 'none')) {
					$name = $upload['name'];

					$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
					$allowedTypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
					$extension = end(explode(".", $name));

					if (!in_array($upload['type'], $allowedTypes) || !in_array($extension, $allowedExts)) {
						$this->Publisher->validationErrors['publisher_photo'] = array('Invalid Type');
						$skip = true;
					} else {
						if (!file_exists($uploadPath)) {
							mkdir($uploadPath);
							//copy(Configure::read('Settings.Paths.Raw.media') . 'index.php', $uploadPath . 'index.php');
						}

						move_uploaded_file($upload['tmp_name'], $uploadPath . $name);
						@unlink($upload['tmp_name']);
						$data['Publisher']['publisher_photo'] = Configure::read('Settings.publisher_img_web_path') . '/' . $id . '/' . $name;
					}
				}
			}

			if(!$skip) {
				$data['Publisher']['id'] = $id;

				if ($this->Publisher->save($data)) {
					$this->Session->setFlash(__('Publisher Saved!'), 'alert', array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					));
					$this->redirect('/admin/publishers');
				}
			}
		} else {
			$this->Publisher->id = $id;
			if (!$this->Publisher->exists()) {
				$this->Session->setFlash(__('Publisher Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/publishers');
			}

			$publisher = $this->Publisher->read();
			$this->request->data = $publisher;
		}
	}

	public function series() {
		$this->Series->recursive = 0;
		$this->set('series', $this->paginate('Series'));
	}

	public function seriesEdit($id) {
		if ($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Series']['id'] = $id;

			if ($this->Series->save($data)) {
				$this->Session->setFlash(__('Series Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/series');
			}
		} else {
			$this->Series->id = $id;
			if (!$this->Series->exists()) {
				$this->Session->setFlash(__('Series Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/series');
			}

			$series = $this->Series->read();
			$this->request->data = $series;
		}
	}

	public function stores() {
		$this->Store->recursive = -1;
		$this->set('stores', $this->paginate('Store'));
	}

	public function storesEdit($id) {
		if ($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Store']['id'] = $id;

			if ($this->Store->save($data)) {
				$this->Session->setFlash(__('Store Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/stores');
			}
		} else {
			$this->Store->id = $id;
			if (!$this->Store->exists()) {
				$this->Session->setFlash(__('Store Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/stores');
			}

			$store = $this->Store->read();
			$this->request->data = $store;
		}
	}

	public function storesDeletePhoto($id) {
		$this->Store->StorePhoto->id = $id;
		if (!$this->Store->StorePhoto->exists()) {
			$this->Session->setFlash(__('Invalid Photo'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer() . '#photos');
		}

		if ($this->Store->StorePhoto->remove($id)) {
			$this->Session->setFlash(__('Deleted'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-success'
			));
		} else {
			$this->Session->setFlash(__('Error deleting photo; try again'), 'alert', array(
				'plugin' => 'TwitterBootstra',
				'class' => 'alert-error'
			));
		}

		$this->redirect($this->referer() . '#photos');
	}

	public function storesSetPrimaryPhoto() {
		$result = array('error' => true, 'message' => __('Invalid'));

		if (isset($this->request->query['photoId']) && isset($this->request->query['storeId'])) {
			$id = Sanitize::clean($this->request->query['photoId']);
			$storeId = Sanitize::clean($this->request->query['storeId']);

			$this->Store->StorePhoto->id = $id;
			if($this->Store->StorePhoto->exists()) {
				## make sure the photo belongs to the current store
				$photo = $this->Store->StorePhoto->read(array('id', 'store_id'));

				if($photo['StorePhoto']['store_id'] == $storeId) {
					## remove previous primary photo
					$this->Store->StorePhoto->updateAll(array('StorePhoto.primary' => false), array('StorePhoto.store_id' => $storeId));

					## set photo as primary
					$this->Store->StorePhoto->id = $id;
					$this->Store->StorePhoto->saveField('primary', true);

					$result['error'] = false;
				} else {
					$result['message'] = __('Invalid Photo; wrong shop');
				}
			} else {
				$result['message'] = __('Invalid Photo');
			}
		}
		return new CakeResponse(array('body' => json_encode($result)));
	}

	public function users() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate('User'));
	}

	public function usersEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['User']['id'] = $id;

			if($this->User->save($data)) {
				$this->Session->setFlash(__('User Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/users');
			}
		} else {
			$this->User->id = $id;
			if(!$this->User->exists()) {
				$this->Session->setFlash(__('User Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/users');
			}

			$user = $this->User->read();
			$this->request->data = $user;
		}
	}

	public function categories() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate('Category'));
	}

	public function categoriesEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Category']['id'] = $id;

			if($this->Category->save($data)) {
				$this->Session->setFlash(__('Category Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/categories');
			}
		} else {
			$this->Category->id = $id;
			if(!$this->Category->exists()) {
				$this->Session->setFlash(__('Category Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/categories');
			}

			$category = $this->Category->read();
			$this->request->data = $category;
		}
	}

	public function sections() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate('Section'));
	}

	public function sectionsEdit($id) {
		if($this->request->is('put')) {
			$data = Sanitize::clean($this->request->data);

			$data['Section']['id'] = $id;

			if($this->Section->save($data)) {
				$this->Session->setFlash(__('Section Saved!'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));
				$this->redirect('/admin/sections');
			}
		} else {
			$this->Section->id = $id;
			if(!$this->Section->exists()) {
				$this->Session->setFlash(__('Section Not Found'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/sections');
			}

			$section = $this->Section->read();
			$this->request->data = $section;
		}

		$this->set('categories', $this->Category->find('list', array('fields' => array('id', 'category_name'))));
	}

	public function reports() {
		$this->Report->recursive = 0;
		$this->set('reports', $this->paginate('Report'));
	}

	public function reportsView($id) {
		$this->Report->id = $id;
		if(!$this->Report->exists()) {
			$this->Session->setFlash(__('Report Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/reports');
		}

		$report = $this->Report->read();

		## 1=item, 2=series, 3=creator, 4=publisher, 5=store
		switch($report['Report']['item_type']) {
			case 1:
				$this->Report->bindModel(array('belongsTo' => array('Item' => array('foreignKey' => 'report_item_id'))));
				break;
			case 2:
				$this->Report->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'report_item_id'))));
				break;
			case 3:
				$this->Report->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'report_item_id'))));
				break;
			case 4:
				$this->Report->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'report_item_id'))));
				break;
			case 5:
				$this->Report->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'report_item_id'))));
				break;
		}
		$this->Report->recursive = 0;
		$this->request->data = $this->Report->read();
	}
}