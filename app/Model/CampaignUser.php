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
		),
		'ParentCampaignUser' => array(
			'className' => 'CampaignUser',
			'foreignKey' => 'refferal',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildCampaignUser' => array(
			'className' => 'CampaignUser',
			'foreignKey' => 'refferal',
			'dependent' => false,
			'conditions' => array('DATE_FORMAT(ChildCampaignUser.created, "%y-%m") = DATE_FORMAT("2013-11-25", "%y-%m")'),
			'fields' => array('DAY(ChildCampaignUser.created) AS day'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
