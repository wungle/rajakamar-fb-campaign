<?php
App::uses('AppModel', 'Model');
/**
 * CampaignUser Model
 *
 * @property Facebook $Facebook
 * @property Campaign $Campaign
 */
class CampaignUser extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public $validate = array(
		'keyword' => array(
			'rule' => 'notEmpty',
			'message' => 'This field cannot be left blank.'
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Campaign' => array(
			'className' => 'Campaign',
			'foreignKey' => 'campaign_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
