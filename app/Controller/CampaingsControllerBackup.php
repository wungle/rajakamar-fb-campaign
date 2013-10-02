<?php
App::uses('AppController', 'Controller');
/**
 * Campaigns Controller
 *
 * @property Campaign $Campaign
 */
class CampaignsController extends AppController {

	public $helpers = array('Facebook.Facebook');
	public $components = array('Facebook.Connect');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('index', 'user_process', 'register', 'user');

		$this->dateNow = date('Ymd');
	}

	// function beforeFacebookLogin($user){
	// 	echo 'Before login';
	// 	// exit;
	// }

	// function afterFacebookLogin(){
	// 	echo 'After login';
	// 	// exit;
	//     // $this->redirect('/custom_facebook_redirect');
	// }

	// function beforeFacebookSave(){
	//     $this->Connect->authUser['CampaignUser']['name'] = $this->Connect->user('name');
	//     $this->Connect->authUser['CampaignUser']['email'] = $this->Connect->user('email');
	//     return true; //Must return true or will not save.
	// }

/**
 * admin_index method
 *
 * @return void
 */
	public function index($campaignSlug = null) {
		debug(FB::api('/me'));
		$campaignData = $this->_check_campaign($campaignSlug);

		$this->set('campaignSlug', $campaignData['Campaign']['slug']);
	}

	public function user_process($campaignSlug = null) {
		if(isset($this->params->query['signed_request']) && !empty($this->params->query['signed_request'])) {
			App::uses('FB', 'Facebook.Lib');

			$this->loadModel('CampaignUser');
		
			$this->set('campaignSlug', $campaignSlug);

			$fbUser = FB::api('/me');
			if($fbUser != null) {
				$fbId = $this->CampaignUser->find('first', array(
						'conditions' => array(
							'CampaignUser.facebook_id' => $fbUser['id']
						)
					)
				);
				if(empty($fbId)) {
					$this->set('fbName', $fbUser['name']);
					$this->set('fbEmail', $fbUser['email']);

					$this->render('/Campaigns/register');
				} else {
					$isFan = $this->_check_fb_like(100001998388948, Configure::read('FB_RAJAKAMAR'));
					if($isFan == null) {
						$this->render('/Campaigns/register');
					} else {
						$this->redirect('/campaigns/user/' . $campaignSlug);
					}
				}
			} else {
				$this->redirect('/campaigns/' . $campaignSlug);
			}
		} else {
			$this->redirect('/campaigns/' . $campaignSlug);
		}
	}

	public function register($campaignSlug = null) {
		App::uses('FB', 'Facebook.Lib');

		$this->loadModel('CampaignUser');

		$fbUser = FB::api('/me');
		if($fbUser == null) {
			$this->redirect('/campaigns/' . $campaignSlug);
		}

		$fbId = $this->CampaignUser->read(null, $fbUser['id']);
		if ($this->request->is('post')) {
			if (!$this->CampaignUser->exists($fbId)) {
				$this->CampaignUser->create();

				$campaignData = $this->Campaign->find('first', array(
						'conditions' => array(
							'Campaign.slug' => $campaignSlug,
							'Campaign.published' => true,
							'Campaign.status' => true
						)
					)
				);

				$this->request->data['CampaignUser']['campaign_id'] = $campaignData['Campaign']['id'];
				$this->request->data['CampaignUser']['facebook_id'] = $fbUser['id'];
				$this->request->data['CampaignUser']['fb_name'] = $fbUser['username'];
				$this->request->data['CampaignUser']['first_name'] = $fbUser['first_name'];
				$this->request->data['CampaignUser']['last_name'] = $fbUser['last_name'];
				$this->request->data['CampaignUser']['fb_email'] = $fbUser['email'];
				$this->request->data['CampaignUser']['address'] = $fbUser['location']['name'];

				if ($this->CampaignUser->save($this->request->data)) {
					$this->Session->write('CampaignUser.facebook_id', $fbUser['id']);
					$this->Session->write('CampaignUser.name', $fbUser['name']);
					$this->Session->write('CampaignUser.email', $fbUser['email']);
					$this->Session->setFlash(__('The campaign has been saved'), 'flash_success');
					$this->redirect(array('action' => 'user_process', $campaignSlug));
				} else {
					$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'flash_error');
				}
			}
		}

		$this->set('fbName', $fbUser['name']);
		$this->set('fbEmail', $fbUser['email']);

		$this->set('campaignSlug', $campaignSlug);
	}

	public function user($campaignSlug = null) {
		exit;
	}

	private function _check_fb_like($fbId = null, $pageId = null) {
		$isFan = FB::api(array(
			  	'method' => 'fql.query',
	     		'query' => 'SELECT uid FROM page_fan WHERE uid = ' . $fbId . ' AND page_id = ' . $pageId
			)
		);

		return ($isFan != null && isset($isFan[0]) ? $isFan[0]['uid'] : null);
	}

	private function _check_campaign($campaignSlug) {
		$campaignData = $this->Campaign->find('first',
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true,
					'Campaign.status' => true
				)
			)
		);

		if(empty($campaignData)) {
			$campaignData = $this->Campaign->find('first', array(
					'conditions' => array(
						'Campaign.published' => true,
						'Campaign.status' => true
					),
					'order' => array(
						'Campaign.publish_date >= ' . $this->dateNow
					)
				)
			);
		}

		return $campaignData;
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Campaign->recursive = 0;
		$this->paginate = array(
			'limit' => PAGINATION_LIMIT
		);

		$this->set('campaigns', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Campaign->exists($id)) {
			throw new NotFoundException(__('Invalid campaign'), 'flash_error');
		}
		$options = array('conditions' => array('Campaign.' . $this->Campaign->primaryKey => $id));
		$this->set('campaign', $this->Campaign->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Campaign->create();
			if ($this->Campaign->save($this->request->data)) {
				$this->Session->setFlash(__('The campaign has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'flash_error');
			}
		}

		$this->render('/Campaigns/admin_form');
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Campaign->exists($id)) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Campaign->save($this->request->data)) {
				$this->Session->setFlash(__('The campaign has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'flash_error');
			}
		} else {
			$options = array('conditions' => array('Campaign.' . $this->Campaign->primaryKey => $id));
			$this->request->data = $this->Campaign->find('first', $options);
		}
		
		$this->render('/Campaigns/admin_form');
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'), 'flash_error');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Campaign->delete()) {
			$this->Session->setFlash(__('Campaign deleted'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Campaign was not deleted'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
