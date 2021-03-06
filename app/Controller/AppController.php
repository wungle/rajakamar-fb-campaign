<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Users.RememberMe',
		'Search.Prg',
		'Session',
		'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            // 'authorize' => 'Controller'
        )
    );
    
	public $presetVars = array(
	    array('field' => 'name', 'type' => 'value'),
	    array('field' => 'pr_status', 'type' => 'value'),
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->RememberMe->restoreLoginFromCookie();

		// Layout admin
		if($this->params->admin === true) {
			$this->layout = 'admin';

			$this->loadModel('Campaign');
			$campaignLists = $this->Campaign->find('all', array(
					'order' => array('Campaign.name' => 'asc')
				)
			);
			$this->set('campaignLists', $campaignLists);
		} else {
			if($this->params->controller == 'campaigns' && $this->params->action == 'index') {
				$this->loadModel('Page');

				$pageFaq = $this->Page->find('first', array(
						'conditions' => array(
							'Page.id' => PAGE_TYPE_FAQ,
							'Page.published' => true
						)
					)
				);

				$this->set('pageFaq', $pageFaq);
			}
		}
	}
	
	public function appError($error) {
    	// $this->redirect('/');
	}
}
