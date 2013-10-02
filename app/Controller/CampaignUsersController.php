<?php
App::uses('AppController', 'Controller');
/**
 * CampaignUsers Controller
 *
 * @property CampaignUser $CampaignUser
 */
class CampaignUsersController extends AppController {

	public $helpers = array('Facebook.Facebook');
	public $components = array('Facebook.Connect');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('index', 'view');
	}

/**
 * index method
 *
 * @return void
 */
	public function index($campaignSlug = null) {
		$this->loadModel('Campaign');

		$this->Campaign->recursive = 0;
		$campaign = $this->Campaign->find('first', array('conditions' => array('Campaign.slug' => $campaignSlug)));

		if(empty($campaign)) {
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		$this->CampaignUser->unBindModel(array('belongsTo' => array('Campaign')));
		$this->paginate = array(
			'conditions' => array(
				'CampaignUser.campaign_id' => $campaign['Campaign']['id']
			),
			'limit' => 10
		);

		$this->set('campaignClosed', $this->_check_campaign_status($campaignSlug));
		$this->set('campaignSlug', $campaignSlug);
		$this->set('campaignUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($campaignSlug = null) {
		App::uses('FB', 'Facebook.Lib');

		$user = FB::getUser();
		if(!$user) {
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		if($this->_check_user_register($user, $campaignSlug) == false) {
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		$fbUser = FB::api('/' . $user);

		$this->loadModel('Campaign');

		$campaignId = $this->Campaign->find('first', array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug
				)
			)
		);

		$this->CampaignUser->unBindModel(array('belongsTo' => array('Campaign')));
		$userData = $this->CampaignUser->find('first', array(
				'conditions' => array(
					'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
					'CampaignUser.facebook_id' => $user
				)
			)
		);

		$refferal = $this->CampaignUser->find('count', array(
			'conditions' => array(
					'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
					'CampaignUser.refferal' => $userData['CampaignUser']['id']
				)
			)
		);

		$this->set('fbId', $user);
		$this->set('fbName', $fbUser['name']);
		$this->set('score', $userData['CampaignUser']['score']);
		$this->set('refferal', $refferal);
		$this->set('refferalId', $campaignSlug . '?refferal=' . $userData['CampaignUser']['id']);
		$this->set('campaignClosed', $this->_check_campaign_status($campaignSlug));
	}

	private function _check_user_register($fbUserId = null, $campaignSlug = null) {
		$this->loadModel('Campaign');

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

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($id = null) {
		$this->loadModel('Campaign');

		if (!$this->Campaign->exists($id)) {
			throw new NotFoundException(__('Invalid campaign user'));
		}
		
		$this->CampaignUser->recursive = 0;
		$this->paginate = array(
			'conditions' => array(
				'campaign_id' => $id
			),
			'limit' => PAGINATION_LIMIT
		);

		$this->set('campaignUsers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->CampaignUser->exists($id)) {
			throw new NotFoundException(__('Invalid campaign user'));
		}
		$options = array('conditions' => array('CampaignUser.' . $this->CampaignUser->primaryKey => $id));
		$this->set('campaignUser', $this->CampaignUser->find('first', $options));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->CampaignUser->id = $id;
		if (!$this->CampaignUser->exists()) {
			throw new NotFoundException(__('Invalid campaign user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CampaignUser->delete()) {
			$this->Session->setFlash(__('Campaign user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Campaign user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
