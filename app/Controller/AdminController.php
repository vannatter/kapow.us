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
 * @property StorePhoto $StorePhoto
 * @property Blog $Blog
 * @property Flag $Flag
 * @property UserActivity $UserActivity
 * @property Improvement $Improvement
 */
class AdminController extends AppController {
	public $name = 'Admin';
	public $uses = array('Item', 'Creator', 'Publisher', 'Series', 'Store', 'User', 'Category', 'CreatorType', 'Section', 'Report', 'StorePhoto', 'Blog', 'Flag', 'UserActivity', 'Improvement');
	public $helpers = array('States', 'TinyMCE.TinyMCE', 'Admin');
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
		),
		'Blog' => array(
			'limit' => 25,
			'order' => array('Blog.modified' => 'DESC')
		),
		'Flag' => array(
			'limit' => 25,
			'order' => array('Flag.id' => 'asc')
		),
		'Improvement' => array(
			'limit' => 25,
			'order' => array('Improvement.id' => 'ASC')
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		parent::hasAdminSession();

		$this->layout = 'admin';

		## some stat stuff
		$this->set('photoQueueTotal', $this->Store->StorePhoto->find('count', array('conditions' => array('StorePhoto.active' => 0))));
		$this->set('creatorQueueTotal', $this->Creator->find('count', array('conditions' => array('Creator.status' => 0))));
		$this->set('newStoreTotal', $this->Store->find('count', array('conditions' => array('Store.status_id' => 2))));
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
		$this->paginate['Creator']['order'] = array('Creator.status' => 'ASC', 'Creator.creator_name' => 'ASC');

		$this->Creator->bindModel(array('belongsTo' => array('LockUser' => array('className' => 'User', 'foreignKey' => 'locked_by_user_id'))));
		$this->Creator->unbindModel(array('hasMany' => array('ItemCreator')));

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
				$data['Creator']['locked_by_user_id'] = 0;   ## unlock creator

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

			if($creator['Creator']['locked_by_user_id'] != 0 && $creator['Creator']['locked_by_user_id'] != $this->Auth->user('id')) {
				$this->Session->setFlash(__('Creator locked other user'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				));
				$this->redirect('/admin/creators');
			}
			$this->request->data = $creator;

			## lock the creator
			$this->Creator->saveField('locked_by_user_id', $this->Auth->user('id'));
		}
	}

	public function creatorsUnlock($id) {
		$this->Creator->id = $id;
		if(!$this->Creator->exists()) {
			$this->Session->setFlash(__('Invalid Creator'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/admin/creators');
		}

		$this->Creator->recursive = -1;
		$creator = $this->Creator->read();

		if($creator['Creator']['locked_by_user_id'] == $this->Auth->user('id')) {
			$this->Creator->saveField('locked_by_user_id', 0);

			$this->Session->setFlash(__('Creator Unlocked'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-success'
			));
		} else {
			$this->Session->setFlash(__('You don\'t have creator locked'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
		}

		$this->redirect('/admin/creators');
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

	public function storesPhotoQueue() {
		$this->paginate = array(
			'StorePhoto' => array(
				'limit' => 25
			)
		);

		$this->StorePhoto->recursive = 0;
		$photos = $this->paginate('StorePhoto', array('StorePhoto.active' => 0));

		$this->set('photos', $photos);
	}

	public function storesPhotoAllow($id) {
		$this->Store->StorePhoto->id = $id;
		if(!$this->Store->StorePhoto->exists()) {
			$this->Session->setFlash(__('Invalid Photo'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/admin/stores/photoQueue');
		}

		$this->Store->StorePhoto->saveField('active', 1);

		$this->Session->setFlash(__('Photo Allowed'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-success'
		));

		$this->redirect('/admin/stores/photoQueue');
	}

	public function storesPhotoDelete($id) {
		if($this->Store->StorePhoto->remove($id)) {
			$this->Session->setFlash(__('Photo Removed'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-success'
			));
		} else {
			$this->Session->setFlash(__('Error Deleting Photo'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
		}

		$this->redirect('/admin/stores/photoQueue');
	}

	public function storesNew() {
		$this->Store->bindModel(array('belongsTo' => array('User')));
		$this->Store->recursive = 0;
		$this->set('stores', $this->paginate('Store', array('Store.status_id' => 2)));
	}

	public function storesNewView($storeId=null) {
		$this->Store->id = $storeId;
		if(!$this->Store->exists()) {
			$this->Session->setFlash(__('Invalid Store'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/admin/stores/new');
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('escape' => false, 'encode' => false));

			$data['Store']['admin_user_id'] = $this->Auth->user('id');
			$data['Store']['id'] = $storeId;

			if($this->Store->save($data)) {
				$this->Session->setFlash(__('Store Saved'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect('/admin/stores/new');
			}
		} else {
			$this->request->data = $this->Store->read();
		}
	}

	public function storesNewSet($statusId=null) {
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

		$this->Report->bindModel(array('belongsTo' => array(
			'Item' => array('foreignKey' => 'report_item_id', 'conditions' => array('item_type' => 1)),
			'Series' => array('foreignKey' => 'report_item_id', 'conditions' => array('item_type' => '2')),
			'Creator' => array('foreignKey' => 'report_item_id', 'conditions' => array('item_type' => '3')),
			'Publisher' => array('foreignKey' => 'report_item_id', 'conditions' => array('item_type' => '4')),
			'Store' => array('foreignKey' => 'report_item_id', 'conditions' => array('item_type' => '5'))
		)));

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

		if($report['Report']['status'] == 1 && $report['Report']['admin_user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Report open by another user'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/reports');
		}

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
		$this->set('report', $this->Report->read());

		$this->Report->updateAll(array(
			'Report.admin_user_id' => $this->Auth->user('id'),
			'Report.status' => 1
		), array(
			'Report.id' => $report['Report']['id']
		));
	}

	public function reportsCancel($reportId=null) {
		$this->Report->id = $reportId;
		if(!$this->Report->exists()) {
			$this->Session->setFlash(__('Report Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/reports');
		}

		$report = $this->Report->read();

		## make sure report is opened by user
		if($report['Report']['admin_user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Report open by another user'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/reports');
		}

		$this->Report->updateAll(array(
			'Report.admin_user_id' => 0,
			'Report.status' => 0
		), array(
			'Report.id' => $report['Report']['id']
		));

		$this->redirect('/admin/reports');
	}

	public function reportsClose($reportId=null) {
		$this->Report->id = $reportId;
		if(!$this->Report->exists()) {
			$this->Session->setFlash(__('Report Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/reports');
		}

		$report = $this->Report->read();

		## make sure report is opened by user
		if($report['Report']['admin_user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Report open by another user'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/reports');
		}

		$this->Report->updateAll(array(
			'Report.admin_user_id' => $this->Auth->user('id'),
			'Report.status' => 99
		), array(
			'Report.id' => $report['Report']['id']
		));

		$this->Session->setFlash(__('Report Closed'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-success'
		));

		$this->redirect('/admin/reports');
	}

	##### FLAGS
	public function flags() {
		$this->Flag->recursive = 0;

		$this->Flag->bindModel(array('belongsTo' => array(
			'Item' => array('foreignKey' => 'flag_item_id', 'conditions' => array('item_type' => 1)),
			'Series' => array('foreignKey' => 'flag_item_id', 'conditions' => array('item_type' => '2')),
			'Creator' => array('foreignKey' => 'flag_item_id', 'conditions' => array('item_type' => '3')),
			'Publisher' => array('foreignKey' => 'flag_item_id', 'conditions' => array('item_type' => '4')),
			'Store' => array('foreignKey' => 'flag_item_id', 'conditions' => array('item_type' => '5'))
		)));

		$this->set('flags', $this->paginate('Flag'));
	}

	public function flagsView($id) {
		$this->Flag->id = $id;
		if(!$this->Flag->exists()) {
			$this->Session->setFlash(__('Flagged Item Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/flags');
		}

		$flag = $this->Flag->read();

		if($flag['Flag']['status'] == 1 && $flag['Flag']['admin_user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Flag open by another user'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/flags');
		}

		## 1=item, 2=series, 3=creator, 4=publisher, 5=store
		switch($flag['Flag']['item_type']) {
			case 1:
				$this->Flag->bindModel(array('belongsTo' => array('Item' => array('foreignKey' => 'flag_item_id'))));
				break;
			case 2:
				$this->Flag->bindModel(array('belongsTo' => array('Series' => array('foreignKey' => 'flag_item_id'))));
				break;
			case 3:
				$this->Flag->bindModel(array('belongsTo' => array('Creator' => array('foreignKey' => 'flag_item_id'))));
				break;
			case 4:
				$this->Flag->bindModel(array('belongsTo' => array('Publisher' => array('foreignKey' => 'flag_item_id'))));
				break;
			case 5:
				$this->Flag->bindModel(array('belongsTo' => array('Store' => array('foreignKey' => 'flag_item_id'))));
				break;
		}
		$this->Flag->recursive = 0;
		$this->set('flag', $this->Flag->read());

		$this->Flag->updateAll(array(
			'Flag.admin_user_id' => $this->Auth->user('id'),
			'Flag.status' => 1
		), array(
			'Flag.id' => $flag['Flag']['id']
		));
	}

	public function flagsCancel($reportId=null) {
		$this->Flag->id = $reportId;
		if(!$this->Flag->exists()) {
			$this->Session->setFlash(__('Flag Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/flags');
		}

		$flag = $this->Flag->read();

		## make sure flag is opened by user
		if($flag['Flag']['admin_user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Flag open by another user'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/flags');
		}

		$this->Flag->updateAll(array(
			'Flag.admin_user_id' => 0,
			'Flag.status' => 0
		), array(
			'Flag.id' => $flag['Flag']['id']
		));

		$this->redirect('/admin/flags');
	}

	public function flagsClose($reportId=null) {
		$this->Flag->id = $reportId;
		if(!$this->Flag->exists()) {
			$this->Session->setFlash(__('Flag Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/flags');
		}

		$flag = $this->Flag->read();

		## make sure flag is opened by user
		if($flag['Flag']['admin_user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Flag open by another user'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));

			$this->redirect('/admin/flags');
		}

		$this->Flag->updateAll(array(
			'Flag.admin_user_id' => $this->Auth->user('id'),
			'Flag.status' => 99
		), array(
			'Flag.id' => $flag['Flag']['id']
		));

		$this->Session->setFlash(__('Flag Closed'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-success'
		));

		$this->redirect('/admin/flags');
	}

	##### BLOGS
	public function blogs() {
		$this->Blog->recursive = 0;
		$this->set('blogs', $this->paginate('Blog'));
	}

	public function blogsAdd() {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('escape' => false, 'encode' => false));

			$data['Blog']['user_id'] = $this->Auth->user('id');
			$data['Blog']['status'] = 1;   ## VISIBLE/PUBLIC

			$this->Blog->create($data);
			if($this->Blog->save($data)) {
				$this->Session->setFlash(__('Blog Entry Saved'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect('/admin/blogs');
			}
		}
	}

	public function blogsEdit($id) {
		$this->Blog->id = $id;
		if(!$this->Blog->exists()) {
			$this->Session->setFlash(__('Invalid Blog Entry'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/admin/blogs');
		}

		if($this->request->is('post') || $this->request->is('put')) {
			$data = Sanitize::clean($this->request->data, array('escape' => false, 'encode' => false));

			$data['Blog']['user_id'] = $this->Auth->user('id');
			$data['Blog']['id'] = $id;

			if($this->Blog->save($data)) {
				$this->Session->setFlash(__('Blog Entry Saved'), 'alert', array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				));

				$this->redirect('/admin/blogs');
			}
		} else {
			$this->request->data = $this->Blog->read();
		}

		$this->render('blogs_add');
	}

	public function blogsDelete($id) {
		$this->Blog->id = $id;
		if(!$this->Blog->exists()) {
			$this->Session->setFlash(__('Invalid Blog Entry'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/admin/blogs');
		}

		$this->Blog->delete($id);

		$this->Session->setFlash(__('Blog Deleted'), 'alert', array(
			'plugin' => 'TwitterBootstrap',
			'class' => 'alert-success'
		));

		$this->redirect('/admin/blogs');
	}

	public function blogsImageUpload() {
		$upload = Sanitize::clean($this->params['form']['userfile']);

		$uploadPath = APP . 'webroot' . DS . 'img' . DS . 'admin' . DS;

		$result = array('resultCode' => 'failed');
		if($msg = $this->Upload->image($upload, $uploadPath)) {
			$result['msg'] = $msg;
		} else {
			$result['resultCode'] = '';
			$result['filename'] = '/img/admin/' . $upload['name'];
		}

		Configure::write('debug', 0);
		$this->layout = 'blank';
		$this->set('result', $result);
	}

	public function userActivity() {
		parent::hasAdminSession();

		$this->User->bindModel(array('hasMany' => array('UserActivity')));
		$users = $this->User->UserActivity->query("
		SELECT UserActivity.*, User.*
			FROM user_activities AS UserActivity
			JOIN (
				SELECT MAX(t.created) AS created, t.user_id
				FROM user_activities AS t
				GROUP BY t.user_id
			) AS x USING (created,user_id)
			JOIN users AS User ON User.id = UserActivity.user_id
			WHERE UserActivity.created >= NOW() - INTERVAL 6 MONTH
			GROUP BY UserActivity.user_id
			ORDER BY UserActivity.created DESC
		");

		$this->set('users', $users);
	}

	public function userActivityDetails($userId=null) {
		parent::hasAdminSession();

		$this->paginate = array(
			'UserActivity' => array(
				'limit' => 25,
				'order' => array(
					'UserActivity.created' => 'DESC'
				)
			)
		);

		$this->set('details', $this->paginate('UserActivity', array('user_id' => $userId)));
	}

	public function userActivityRowDetail($userId, $detailId) {
		parent::hasAdminSession();

		$this->UserActivity->id = $detailId;
		if(!$this->UserActivity->exists()) {
			$this->Session->setFlash(__('Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect($this->referer());
		}

		$this->set('details', $this->UserActivity->read());
	}

	public function improvements() {
		$this->Improvement->recursive = 0;
		$this->set('improvements', $this->paginate('Improvement'));
	}

	public function improvementsView($id=null) {
		$this->Improvement->id = $id;
		if(!$this->Improvement->exists()) {
			$this->Session->setFlash(__('Not Found'), 'alert', array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			));
			$this->redirect('/admin/improvements');
		}

		$this->set('improve', $this->Improvement->read());
		$this->set('sections', $this->Item->Section->find('list', array('fields' => array('id', 'section_name'))));
		$this->set('publishers', $this->Item->Publisher->find('list', array('fields' => array('id', 'publisher_name'))));
		$this->set('series', $this->Item->Series->find('list', array('fields' => array('id', 'series_name'))));
	}

	public function improvementsAccept() {
		if($this->request->is('ajax')) {
			$result = array('error' => true, 'message' => '');

			if(isset($this->params->query)) {
				$data = $this->params->query;

				if(isset($data['itemId']) && isset($data['type']) && isset($data['field'])) {
					switch($data['type']) {
						case 1:   ### ITEM
							$id = $data['itemId'];
							$field = $data['field'];

							$this->Improvement->ImproveItem->id = $id;
							if(!$this->Improvement->ImproveItem->exists()) {
								$result['message'] = __('Invalid Item');
							} else {
								$item = $this->Improvement->ImproveItem->read();

								$this->Item->id = $item['ImproveItem']['item_id'];
								$this->Item->saveField($field, $item['ImproveItem'][$field . '_new']);

								$this->log(sprintf('%s accepted change for item %s on field %s new value %s', $this->Auth->user('username'), $item['ImproveItem']['item_id'], $field, $item['ImproveItem'][$field . '_new']), 'admin');

								$this->Improvement->ImproveItem->updateall(array(
									'ImproveItem.' . $field => '""',
									'ImproveItem.' . $field . '_new' => '""'
								), array(
									'ImproveItem.id' => $id
								));

								$result['error'] = false;
							}
							break;
					}
				} else {
					$result['message'] = __('Invalid Request');
				}
			} else {
				$result['message'] = __('Invalid Request');
			}
			return new CakeResponse(array('body' => json_encode($result)));
		} else {
			echo 'javascript disabled';
			exit;
		}
	}
}