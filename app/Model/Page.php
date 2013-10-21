<?php
App::uses('AppModel', 'Model');
/**
 * Page Model
 *
 * @property Page $Page
 */
class Page extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'This field cannot be left blank.'
		)
	);

	// Do before save
	function beforeSave($options = array()) {
		$this->data['Page']['slug'] = Inflector::slug($this->data['Page']['title']);
	}

}
