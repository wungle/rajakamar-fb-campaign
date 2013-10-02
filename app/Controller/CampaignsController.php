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
		if($this->_check_campaign_status($campaignSlug) == false) {
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		$campaignData = $this->_check_campaign($campaignSlug);

		if(isset($this->params->query['refferal']) && !empty($this->params->query['refferal'])) {
			$this->Session->write('User.refferal', $this->params->query['refferal']);
		}

		$this->set('campaignSlug', $campaignData['Campaign']['slug']);
	}

	public function user_process($campaignSlug = null) {
		if(isset($this->params->query['signed_request']) && !empty($this->params->query['signed_request'])) {
			App::uses('FB', 'Facebook.Lib');

			$user = FB::getUser();
			if($user) {
				if($this->_check_user_register($user, $campaignSlug) == false || $this->_check_fb_like($user, Configure::read('FB_RAJAKAMAR')) == null) {
					$this->redirect('/campaigns/register/' . $campaignSlug . '?signed_request=' . $this->params->query['signed_request']);
				} else {
					$this->redirect('/campaignUsers/view/' . $campaignSlug);
				}
			}
		}

		$this->redirect('/campaigns/' . $campaignSlug);
	}

	public function register($campaignSlug = null) {
		App::uses('FB', 'Facebook.Lib');

		$this->loadModel('CampaignUser');

		$refferalId = null;
		$userName = null;
		$userEmail = null;
		$user = FB::getUser();
		if($user) {
			if($this->_check_user_register($user, $campaignSlug) == true) {
				$userData = $this->CampaignUser->find('first', array(
						'conditions' => array(
							'CampaignUser.facebook_id' => $user
						)
					)
				);
				$refferalId = $userData['CampaignUser']['id'];
				$userName = $userData['CampaignUser']['name'];
				$userEmail = $userData['CampaignUser']['email'];
			}

			$fbUser = FB::api('/' . $user);
			if ($this->request->is('post')) {
				if($this->_check_user_register($fbUser['id'], $campaignSlug) == false) {
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
					$this->request->data['CampaignUser']['address'] = isset($fbUser['hometown']) ? $fbUser['hometown']['name'] : '';
					$this->request->data['CampaignUser']['score'] = $campaignData['Campaign']['score'];
					$this->request->data['CampaignUser']['refferal'] = $this->Session->read('User.refferal') == null ? 0 : $this->Session->read('User.refferal');

					if ($this->CampaignUser->save($this->request->data)) {
						$refferalId = $this->CampaignUser->getInsertID();
						// Add user refferal score
						$this->_user_refferal($campaignData['Campaign']['refferal']);
						// $this->Session->write('CampaignUser.facebook_id', $fbUser['id']);
						// $this->Session->write('CampaignUser.name', $fbUser['name']);
						// $this->Session->write('CampaignUser.email', $fbUser['email']);
						$this->Session->setFlash(__('The campaign has been saved'), 'flash_success');
						$this->redirect('/campaigns/user_process/' . $campaignSlug . '?signed_request=' . $this->params->query['signed_request']);
					} else {
						$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'), 'flash_error');
					}
				}
			}
		} else {
			$this->redirect('/campaigns/' . $campaignSlug);
		}

		$this->set('fbName', $userName == null ? $fbUser['name'] : $userName);
		$this->set('fbEmail', $userEmail == null ? $fbUser['email'] : $userEmail);

		$this->set('refferalId', $campaignSlug . '?refferal=' . $refferalId);
		$this->set('registered', $this->_check_user_register($fbUser['id'], $campaignSlug) == true ? true : false);
		$this->set('campaignSlug', $campaignSlug . '?signed_request=' . $this->params->query['signed_request']);
	}

	private function _check_user_register($fbUserId = null, $campaignSlug = null) {
		$this->loadModel('CampaignUser');

		$campaignId = $this->Campaign->find('first', array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug
				)
			)
		);

		$fbId = $this->CampaignUser->find('first', array(
				'conditions' => array(
					'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
					'CampaignUser.facebook_id' => $fbUserId
				)
			)
		);

		return (empty($fbId) ? false : true);
	}

	private function _user_refferal($refScore = null) {
		$this->loadModel('CampaignUser');

		if($this->Session->read('User.refferal')) {
			$user = $this->CampaignUser->find('first', array(
					'conditions' => array(
						'CampaignUser.id' => $this->Session->read('User.refferal')
					)
				)
			);

			$fbId = FB::getUser();
			$fbFriend = FB::api('/' . $fbId . '/friends/' . $user['CampaignUser']['facebook_id']);
			if(!empty($user) && (isset($fbFriend['data'][0]) && !empty($fbFriend['data'][0]['id']))) {
				$data['CampaignUser']['id'] = $this->Session->read('User.refferal');
				$data['CampaignUser']['score'] = $user['CampaignUser']['score'] + $refScore;

				if($this->CampaignUser->save($data)) {
					// Check campaign closed

					if($data['CampaignUser']['score'] >= $user['Campaign']['max_score']) {
						$campaign['Campaign']['id'] = $user['Campaign']['id'];
						$campaign['Campaign']['name'] = $user['Campaign']['name'];
						$campaign['Campaign']['status'] = 0;

						$this->Campaign->save($campaign);
					}
				}
			}
		}
	}

	private function _check_fb_like($fbId = null, $pageId = null) {
		$isFan = FB::api(array(
			  	'method' => 'fql.query',
	     		'query' => 'SELECT uid FROM page_fan WHERE uid = ' . $fbId . ' AND page_id = ' . $pageId
			)
		);

		return ($isFan != null && isset($isFan[0]) ? $isFan[0]['uid'] : null);
	}

	private function _check_campaign_status($campaignSlug = null) {
		$campaignData = $this->Campaign->find('first',
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true
				)
			)
		);

		return $campaignData['Campaign']['status'] == 0 ? false : true;
	}

	private function _check_campaign($campaignSlug = null) {
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
			$this->request->data['Campaign']['status'] = 1;
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
