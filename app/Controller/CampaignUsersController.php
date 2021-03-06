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

		$this->Auth->allow('index', 'view', 'share_score');
	}

/**
 * index method
 *
 * @return void
 */
	public function index($campaignSlug = null) {
		$this->layout = 'user_score';

		$this->loadModel('Campaign');

		$this->Campaign->recursive = 0;
		$campaign = $this->Campaign->find('first', 
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true,
				)
			)
		);

		if(empty($campaign)) {
			$this->redirect(Configure::read('SITE_RAJAKAMAR'));
		}

		$keyword = '';
		if($this->request->is('post') && isset($this->request->data['CampaignUser']['keyword'])) {
			$keyword = $this->request->data['CampaignUser']['keyword'];
		}

		$this->CampaignUser->unBindModel(array('belongsTo' => array('Campaign')));

		// Ranking		
		$this->CampaignUser->query("SET @i = 0");
		$ranking = "(SELECT position
			FROM (
			    SELECT id, facebook_id, (select count(cUser.refferal) from campaign_users as cUser where cUser.refferal = ti.id) as refferalCount, @i:=@i+1 AS position
				    FROM campaign_users ti order by ti.score desc, refferalCount desc, ti.created desc
				)
			campUser WHERE campUser.facebook_id = CampaignUser.facebook_id) as position";

		$this->paginate = array(
			'fields' => array($ranking, 'CampaignUser.*', '(select count(cUser.refferal) from campaign_users as cUser where cUser.refferal = CampaignUser.id) as refferal'),
			'conditions' => array(
				'CampaignUser.campaign_id' => $campaign['Campaign']['id'],
				'OR' => array(
					'CampaignUser.name LIKE' => '%' . $keyword . '%',
					'CampaignUser.fb_name LIKE' => '%' . $keyword . '%',
					'CampaignUser.score LIKE' => '%' . $keyword . '%',
					'CampaignUser.refferal LIKE' => '%' . $keyword . '%',
				)
			),
			'limit' => 15,
			'order' => 'CampaignUser.score desc, refferal desc, CampaignUser.created desc'
		);

		$shareTime = null;
		$refferalId = null;
		$campaignShared = true;
		$loginFirst = true;

		$user = FB::getUser();
		$userFb = FB::api('/' . $user);
		if(!empty($userFb)) {
			$this->CampaignUser->unBindModel(array('belongsTo' => array('Campaign')));
			$userData = $this->CampaignUser->find('first', array(
					'conditions' => array(
						'CampaignUser.campaign_id' => $campaign['Campaign']['id'],
						'CampaignUser.facebook_id' => $user
					)
				)
			);

			if($this->_check_last_shared($user, $campaignSlug) == false) {
				$diff = strtotime('now') - strtotime($userData['CampaignUser']['last_shared']);
				$shareTime = date('H:i:s', strtotime('06:00:00') - $diff);
			}

			$refferalId = $campaignSlug . '?refferal=' . $userData['CampaignUser']['id'];
			$campaignShared = $this->_check_last_shared($user, $campaignSlug);
			$loginFirst = false;
		}

		$this->set('shareTime', $shareTime);
		$this->set('refferalId', $refferalId);
		$this->set('loginFirst', $loginFirst);
		$this->set('campaignClosed', $this->_check_campaign_closed($campaignSlug));
		$this->set('campaignShared', $campaignShared);
		$this->set('campaignSlug', $campaignSlug);
		$this->set('campaignUsers', $this->paginate());
		$this->set('campaignTitle', $campaign['Campaign']['title']);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($campaignSlug = null) {
		$this->layout = 'view_score';

		App::uses('FB', 'Facebook.Lib');

		$user = FB::getUser();
		if(!$user) {
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		$this->loadModel('Campaign');

		$campaignId = $this->Campaign->find('first', array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true,
				)
			)
		);

		if(empty($campaignId)) {
			$this->redirect(Configure::read('SITE_RAJAKAMAR'));
		}

		if($this->_check_user_register($user, $campaignSlug) == false) {
			$this->Session->setFlash(__("Sorry, You are not registered."));
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		if($this->_check_user_shared_liked($user, $campaignSlug) == false) {
			$this->Session->setFlash(__('Sorry, You are register not complete yet.'));
			$this->redirect('/campaignUsers/' . $campaignSlug);
		}

		$fbUser = FB::api('/' . $user);

		$this->CampaignUser->unBindModel(array('belongsTo' => array('Campaign')));
		$userData = $this->CampaignUser->find('first', array(
				'conditions' => array(
					'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
					'CampaignUser.facebook_id' => $user
				)
			)
		);

		// Ranking		
		$this->CampaignUser->query("SET @i = 0");
		$ranking = $this->CampaignUser->query("SELECT position, facebook_id 
			FROM (
			    SELECT id, facebook_id, @i:=@i+1 AS position
				    FROM campaign_users ti order by ti.score desc, ti.refferal desc, ti.created desc
				)
			CampaignUser WHERE facebook_id = " . $userData['CampaignUser']['facebook_id']
		);

		$refferal = $this->CampaignUser->find('count', array(
				'conditions' => array(
					'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
					'CampaignUser.refferal' => $userData['CampaignUser']['id']
				)
			)
		);

		if($this->_check_last_shared($user, $campaignSlug) == false) {
			$diff = strtotime('now') - strtotime($userData['CampaignUser']['last_shared']);
			$this->set('shareTime', date('H:i:s', strtotime('06:00:00') - $diff));
		}

		$this->set('fbId', $user);
		$this->set('fbName', $fbUser['name']);
		$this->set('ranking', isset($ranking[0]) ? $ranking[0]['CampaignUser']['position'] : '');
		$this->set('score', $userData['CampaignUser']['score']);
		$this->set('refferal', $refferal);
		$this->set('refferalId', $campaignSlug . '?refferal=' . $userData['CampaignUser']['id']);
		$this->set('campaignClosed', $this->_check_campaign_closed($campaignSlug));
		$this->set('campaignShared', $this->_check_last_shared($user, $campaignSlug));
		$this->set('campaignSlug', $campaignSlug);
		$this->set('campaignTitle', $campaignId['Campaign']['title']);
	}

	public function share_score($campaignSlug = null) {
		if($this->_check_campaign_closed($campaignSlug) == true) {
			$this->Session->setFlash(__('Sorry, the campaign is closed'));
			$this->redirect('campaignUsers/view/' . $campaignSlug);
		}

		$user = FB::getUser();
		if($user) {
			$this->loadModel('Campaign');

			$campaignId = $this->Campaign->find('first', array(
					'conditions' => array(
						'Campaign.slug' => $campaignSlug
					)
				)
			);

			$campaignUser = $this->CampaignUser->find('first', array(
					'conditions' => array(
						'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
						'CampaignUser.facebook_id' => $user
					)
				)
			);

			if($this->_check_last_shared($user, $campaignSlug) == true) {
				$campaign['CampaignUser']['id'] = $campaignUser['CampaignUser']['id'];
				$campaign['CampaignUser']['score'] = $campaignUser['CampaignUser']['score'] + $campaignId['Campaign']['score'];
				$campaign['CampaignUser']['last_shared'] = date('Y-m-d H:i:s');

				$this->CampaignUser->save($campaign);
			}
		}

		$this->redirect('/campaignUsers/view/' . $campaignSlug);
	}

	private function _check_last_shared($fbUserId = null, $campaignSlug = null) {
		$this->loadModel('Campaign');

		$campaignId = $this->Campaign->find('first', array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug
				)
			)
		);

		$campaignUser = $this->CampaignUser->find('first', array(
				'conditions' => array(
					'CampaignUser.campaign_id' => $campaignId['Campaign']['id'],
					'CampaignUser.facebook_id' => $fbUserId
				)
			)
		);

		return strtotime($campaignUser['CampaignUser']['last_shared']) < strtotime('-6 hour') ? true : false;
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

	private function _check_campaign_closed($campaignSlug = null) {
		$this->loadModel('Campaign');

		$campaignData = $this->Campaign->find('first',
			array(
				'conditions' => array(
					'Campaign.slug' => $campaignSlug,
					'Campaign.published' => true
				)
			)
		);

		return !empty($campaignData) && $campaignData['Campaign']['is_closed'] == 0 ? false : true;
	}

	private function _check_user_shared_liked($fbUserId = null, $campaignSlug = null) {
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
					'CampaignUser.facebook_id' => $fbUserId,
					'CampaignUser.liked' => 1,
					'CampaignUser.shared' => 1
				)
			)
		);

		return (empty($fbId) ? false : true);
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
				'CampaignUser.campaign_id' => $id
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
		// $this->CampaignUser->id = $id;
		// if (!$this->CampaignUser->exists()) {
		// 	throw new NotFoundException(__('Invalid campaign user'));
		// }
		// $this->request->onlyAllow('post', 'delete');
		// if ($this->CampaignUser->delete()) {
		// 	$this->Session->setFlash(__('Campaign user deleted'));
		// 	$this->redirect(array('action' => 'index'));
		// }
		// $this->Session->setFlash(__('Campaign user was not deleted'));
		$this->Session->setFlash(__('Campaign user delete is disabled'));
		$this->redirect(array('action' => 'index'));
	}

	public function admin_referrals($id = null) {
		// Ranking
		$this->CampaignUser->query("SET @i = 0");
		$ranking = "(SELECT position
			FROM (
			    SELECT id, facebook_id, (select count(cUser.refferal) from campaign_users as cUser where cUser.refferal = ti.id) as refferalCount, @i:=@i+1 AS position
				    FROM campaign_users ti order by ti.score desc, refferalCount desc, ti.created desc
				)
			campUser WHERE campUser.facebook_id = CampaignUser.facebook_id) as position";

		$this->CampaignUser->recursive = 1;
		$refferal = $this->CampaignUser->find('all', array(
				'fields' => array($ranking, '(select count(countRef.refferal) FROM campaign_users as countRef where countRef.refferal = CampaignUser.id AND DATE_FORMAT(countRef.created, "%y-%m") = DATE_FORMAT("2013-11-25", "%y-%m")) as count', 'CampaignUser.*'),
				'conditions' => array(
					'CampaignUser.campaign_id' => $id
				),
				'order' => '(select count(countRef.refferal) FROM campaign_users as countRef where countRef.refferal = CampaignUser.id AND DATE_FORMAT(countRef.created, "%y-%m") = DATE_FORMAT("2013-11-25", "%y-%m")) desc',
				'limit' => 10
			)
		);

		$day = null;
		$days = null;
		$dayCount = 0;
		$colorChart = array('rgb(237,194,64)', 'rgb(203,75,75)', 'rgb(77,167,77)', 'rgb(118,51,189)', 'rgb(255, 20, 147)', 'rgb(47, 79, 79)', 'rgb(255, 215, 0)', 'rgb(124, 252, 0)', 'rgb(32, 178, 170)', 'rgb(255, 69, 0)');
		$dataSet = '{';
		foreach($refferal as $key => $campaignUser) {
			$dataSet .= '"' . $campaignUser['CampaignUser']['name'] . '": {color: "' . $colorChart[$key] . '", label: "' . $campaignUser['CampaignUser']['name'] . '", data: [';
			foreach($campaignUser['ChildCampaignUser'] as $key => $childCampaignUser) {
				$days = $childCampaignUser['ChildCampaignUser'][0]['day'];
				// if($day == $day) {
					++$dayCount;
				// }
				if(isset($campaignUser['ChildCampaignUser'][$key + 1]['ChildCampaignUser']) && $campaignUser['ChildCampaignUser'][$key + 1]['ChildCampaignUser'][0]['day'] != $days) {
					$dataSet .= '[' . $days . ', ' . $dayCount . '], ';
					$dayCount = 0;
				}
				 else if(!isset($campaignUser['ChildCampaignUser'][$key + 1]['ChildCampaignUser'])) {
					$dataSet .= '[' . $days . ', ' . $dayCount . '], ';
					$dayCount = 0;
				}

				// $day = $childCampaignUser['ChildCampaignUser'][0]['day'];
			}
			$dataSet .= ']}, ';
		}
		$dataSet .= '}';
		// debug($refferal);

		$this->set('campaignUsers', $refferal);
		$this->set('dataSet', $dataSet);
	}

}
