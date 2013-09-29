<?php
App::uses('AppController', 'Controller');
/**
 * Dashboards Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->layout = 'admin';
	}

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->loadModel('Campaign');
		$this->loadModel('CampaignUser');

		$campaigns = $this->Campaign->find('all', array(
				'limit' => 5
			)
		);
		$campaignUsers = $this->CampaignUser->find('all', array(
				'limit' => 5
			)
		);

		$this->set('campaigns', $campaigns);
		$this->set('campaignUsers', $campaignUsers);
	}

}
