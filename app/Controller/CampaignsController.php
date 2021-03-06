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

		$this->Auth->allow('index', 'fb_landing_page', 'user_process', 'register', 'user', 'user_shared_liked', 'faq');

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
		$this->layout = 'landing_page';

		$campaignData = $this->_check_campaign($campaignSlug);

		if(empty($campaignData['Campaign']['slug']) || $this->_set_campaign_closed($campaignData['Campaign']['slug']) == true) {
			$this->redirect(Configure::read('SITE_RAJAKAMAR'));
		}

		if(isset($this->params->query['refferal']) && !empty($this->params->query['refferal'])) {
			$this->Session->write('User.refferal', $this->params->query['refferal']);
		}

		$this->set('campaignSlug', $campaignData['Campaign']['slug']);
	}

	public function fb_landing_page($campaignSlug = null) {
		$this->layout = 'landing_page';

		$campaignData = $this->_check_campaign($campaignSlug);

		if(empty($campaignData['Campaign']['slug']) || $this->_set_campaign_closed($campaignData['Campaign']['slug']) == true) {
			$this->redirect(Configure::read('SITE_RAJAKAMAR'));
		}
		
		$this->set('campaignSlug', $campaignData['Campaign']['slug']);

		$this->render('/Campaigns/fb_landing_page');
	}

	public function user_process($campaignSlug = null) {
		if(isset($this->params->query['signed_request']) && !empty($this->params->query['signed_request'])) {
			App::uses('FB', 'Facebook.Lib');

			$user = FB::getUser();
			if($user) {
				$refferalId = null;
				if($this->_check_user_register($user, $campaignSlug) == false || $this->_check_fb_like($user, Configure::read('FB_RAJAKAMAR')) == null || $this->_check_user_shared($user, $campaignSlug) == false) {
					$userData = $this->CampaignUser->find('first', array(
							'conditions' => array(
								'CampaignUser.facebook_id' => $user
							)
						)
					);
					if(!empty($userData)) {
						$refferalId = 'refferal=' . $userData['CampaignUser']['id'] . '&caption=' . $userData['Campaign']['title'] . '&';
					}
					$this->redirect('/campaigns/register/' . $campaignSlug . '?' . $refferalId . 'signed_request=' . $this->params->query['signed_request']);
				} else {
					// $this->redirect('/campaigns/register/' . $campaignSlug . '?' . $refferalId . 'signed_request=' . $this->params->query['signed_request']);
					$this->redirect('/campaignUsers/view/' . $campaignSlug);
				}
			}
		}

		$this->redirect('/campaigns/' . $campaignSlug);
	}

	public function register($campaignSlug = null) {
		$this->layout = 'register_new';
		
		if(isset($this->params->query['signed_request']) && !empty($this->params->query['signed_request']) && $this->_check_campaign_closed($campaignSlug) == false) {
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
					$refferalId = 'refferal=' . $userData['CampaignUser']['id'] . '&';
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
									'Campaign.is_closed' => false
								)
							)
						);

						$this->request->data['CampaignUser']['campaign_id'] = $campaignData['Campaign']['id'];
						$this->request->data['CampaignUser']['facebook_id'] = $fbUser['id'];
						$this->request->data['CampaignUser']['fb_name'] = $fbUser['username'];
						$this->request->data['CampaignUser']['first_name'] = $fbUser['first_name'];
						$this->request->data['CampaignUser']['last_name'] = $fbUser['last_name'];
						$this->request->data['CampaignUser']['fb_email'] = $fbUser['email'];
						$this->request->data['CampaignUser']['phone'] = isset($fbUser['phone']) ? $fbUser['phone'] : '';
						$this->request->data['CampaignUser']['age'] = isset($fbUser['birthday']) ? $fbUser['birthday'] : '';
						if(isset($fbUser['hometown'])) {
							$this->request->data['CampaignUser']['address'] = $fbUser['hometown']['name'];
						} else {
							if(isset($fbUser['location'])) {
								$this->request->data['CampaignUser']['address'] = $fbUser['location']['name'];
							}
						}
						$this->request->data['CampaignUser']['score'] = $this->_check_fb_like($user, Configure::read('FB_RAJAKAMAR')) != null ? $campaignData['Campaign']['score'] + $campaignData['Campaign']['score'] : $campaignData['Campaign']['score'];
						$this->request->data['CampaignUser']['refferal'] = $this->Session->read('User.refferal') == null ? 0 : $this->Session->read('User.refferal');
						$this->request->data['CampaignUser']['liked'] = $this->_check_fb_like($user, Configure::read('FB_RAJAKAMAR')) == null ? 0 : 1;
						$this->request->data['CampaignUser']['shared'] = 0;

						if ($this->CampaignUser->save($this->request->data)) {
							$refferalId = $this->CampaignUser->getInsertID();
							// Add user refferal score
							$this->_user_refferal($campaignData['Campaign']['refferal']);
							// $this->Session->write('CampaignUser.facebook_id', $fbUser['id']);
							// $this->Session->write('CampaignUser.name', $fbUser['name']);
							// $this->Session->write('CampaignUser.email', $fbUser['email']);
							$this->Session->setFlash(__('The user has been saved'), 'flash_success');
							$this->redirect('/campaigns/user_process/' . $campaignSlug . '?refferal=' . $refferalId . '&signed_request=' . $this->params->query['signed_request']);
						} else {
							$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_error');
						}
					}
				}
			} else {
				$this->redirect('/campaigns/' . $campaignSlug);
			}
		} else {
			$this->redirect('/campaigns/' . $campaignSlug);
		}

		$this->set('fbName', $userName == null ? $fbUser['name'] : $userName);
		$this->set('fbEmail', $userEmail == null ? $fbUser['email'] : $userEmail);

		$this->set('campaignShared', $this->_check_user_shared($user, $campaignSlug));
		$this->set('registered', $this->_check_user_register($user, $campaignSlug) == true ? true : false);
		$this->set('campaignSlug', $campaignSlug . '?' . $refferalId . 'signed_request=' . $this->params->query['signed_request']);

		$this->render('/Campaigns/register_new');
	}

	public function faq() {
		$this->layout = 'faq';
	}

	public function user_shared_liked($campaignSlug = null) {
		$this->loadModel('CampaignUser');

		if(isset($this->params->query['signed_request']) && !empty($this->params->query['signed_request'])) {
			if(isset($this->params->query['user_shared']) || isset($this->params->query['user_liked'])) {
				$user = FB::getUser();
				if($user) {
					$campaignId = $this->Campaign->find('first', array(
							'conditions' => array(
								'Campaign.slug' => $campaignSlug
							)
						)
					);

					$user = $this->CampaignUser->find('first', array(
							'conditions' => array(
								'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
								'CampaignUser.facebook_id' => $user
							)
						)
					);

					if(!empty($user)) {
						$campaign['CampaignUser']['id'] = $user['CampaignUser']['id'];
						if(isset($this->params->query['user_liked']) && $this->params->query['user_liked'] == 1 && $user['CampaignUser']['liked'] == 0) {
							$campaign['CampaignUser']['liked'] = true;
							$campaign['CampaignUser']['score'] = $user['CampaignUser']['score'] + $campaignId['Campaign']['score'];
							
							$this->CampaignUser->save($campaign);
						}
						if(isset($this->params->query['user_shared']) && $this->params->query['user_shared'] == 1 && $user['CampaignUser']['shared'] == 0) {
							$campaign['CampaignUser']['shared'] = true;
							$campaign['CampaignUser']['score'] = $user['CampaignUser']['score'] + $campaignId['Campaign']['score'];
							$campaign['CampaignUser']['last_shared'] = date('Y-m-d H:i:s');

							$this->CampaignUser->save($campaign);
						}

						$this->redirect('/campaigns/user_process/' . $campaignSlug . '?signed_request=' . $this->params->query['signed_request']);
					} else {
						$this->Session->setFlash(__('Sorry, You are not registered.'));
						$this->redirect('/campaigns/register/' . $campaignSlug . '?signed_request=' . $this->params->query['signed_request']);
					}
				}
			}
		}

		$this->redirect('/campaigns/' . $campaignSlug);
	}

	private function _check_user_shared($fbUserId = null, $campaignSlug = null) {
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
					'CampaignUser.facebook_id' => $fbUserId,
					'CampaignUser.shared' => 1
				)
			)
		);

		return (empty($fbId) ? false : true);
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

				$this->CampaignUser->save($data);
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

	private function _set_campaign_closed($campaignSlug = null) {
		$is_closed = false;

		$campaignData = $this->Campaign->find('first',
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.is_closed' => false
				)
			)
		);

		if(!empty($campaignData)) {
			$pageLike = FB::api(array(
				  	'method' => 'fql.query',
		     		'query' => 'SELECT fan_count FROM page WHERE page_id = ' . Configure::read('FB_RAJAKAMAR')
				)
			);

			if(isset($pageLike[0]) && !empty($pageLike[0]['fan_count'])) {
				if($pageLike[0]['fan_count'] >= $campaignData['Campaign']['max_score']) {
				// if($data['CampaignUser']['score'] >= $campaignData['Campaign']['max_score']) {
					$campaign['Campaign']['id'] = $campaignData['Campaign']['id'];
					$campaign['Campaign']['name'] = $campaignData['Campaign']['name'];
					$campaign['Campaign']['is_closed'] = true;

					if($this->Campaign->save($campaign)) {
						$is_closed = true;
					}
				}
			}
		}

		return $is_closed;
	}

	private function _check_campaign_closed($campaignSlug = null) {
		$campaignData = $this->Campaign->find('first',
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true,
					'Campaign.is_closed' => false
				)
			)
		);

		return !empty($campaignData) && $campaignData['Campaign']['is_closed'] == 0 ? false : true;
	}

	private function _check_campaign($campaignSlug = null) {
		$campaignData = $this->Campaign->find('first',
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true,
					'Campaign.is_closed' => false
				)
			)
		);

		if(empty($campaignData)) {
			$campaignData = $this->Campaign->find('first', array(
					'conditions' => array(
						'Campaign.published' => true,
						'Campaign.is_closed' => false,
						'Campaign.is_default' => true
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
			$this->request->data['Campaign']['is_closed'] = false;
			if($this->request->data['Campaign']['is_default'] == true) {
				$this->Campaign->updateAll(array('Campaign.is_default' => false));
			}

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
			if($this->request->data['Campaign']['is_default'] == true) {
				$this->Campaign->updateAll(array('Campaign.is_default' => false));
			}

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
