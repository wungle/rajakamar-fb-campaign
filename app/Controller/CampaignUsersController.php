<?php
App::uses('AppController', 'Controller');
/**
 * CampaignUsers Controller
 *
 * @property CampaignUser $CampaignUser
 */
class CampaignUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CampaignUser->recursive = 0;
		$this->set('campaignUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CampaignUser->exists($id)) {
			throw new NotFoundException(__('Invalid campaign user'));
		}
		$options = array('conditions' => array('CampaignUser.' . $this->CampaignUser->primaryKey => $id));
		$this->set('campaignUser', $this->CampaignUser->find('first', $options));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($id = null) {
		if (!$this->CampaignUser->exists($id)) {
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
