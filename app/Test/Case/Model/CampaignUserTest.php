<?php
App::uses('CampaignUser', 'Model');

/**
 * CampaignUser Test Case
 *
 */
class CampaignUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.campaign_user',
		'app.facebook',
		'app.campaign'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CampaignUser = ClassRegistry::init('CampaignUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CampaignUser);

		parent::tearDown();
	}

}
