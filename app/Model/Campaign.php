<?php
App::uses('AppModel', 'Model');
/**
 * Campaign Model
 *
 * @property CampaignUser $CampaignUser
 */
class Campaign extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $validate = array(
		'publish_date' => array(
			'rule' => 'notEmpty',
			'message' => 'This field cannot be left blank.'
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Name already taken'
			)
		),
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'This field cannot be left blank.'
		),
		'max_score' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Please supply number only.'
			)
		),
		'score' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Please supply number only.'
			)
		),
		'refferal' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Please supply number only.'
			)
		)
	);

	function beforeValidate($options = array()) {
		$this->data['Campaign']['name'] = preg_replace('/\s+/', ' ', $this->data['Campaign']['name']);
	}

	// Do before save
	function beforeSave($options = array()) {
		$this->data['Campaign']['slug'] = Inflector::slug($this->data['Campaign']['name']);
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CampaignUser' => array(
			'className' => 'CampaignUser',
			'foreignKey' => 'campaign_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
