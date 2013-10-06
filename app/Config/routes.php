<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'campaigns', 'action' => 'index'));
	// Campaigns
	Router::connect('/campaigns/user_process/*', array('controller' => 'campaigns', 'action' => 'user_process', 'admin' => false));
	Router::connect('/campaigns/register/*', array('controller' => 'campaigns', 'action' => 'register', 'admin' => false));
	Router::connect('/campaigns/user_shared_liked/*', array('controller' => 'campaigns', 'action' => 'user_shared_liked', 'admin' => false));
	Router::connect('/campaigns/user/*', array('controller' => 'campaigns', 'action' => 'user', 'admin' => false));
	Router::connect('/campaigns/faq', array('controller' => 'campaigns', 'action' => 'faq', 'admin' => false));
	Router::connect('/campaigns/*', array('controller' => 'campaigns', 'action' => 'index', 'admin' => false));
	// Campaign User
	Router::connect('/campaignUsers/view/*', array('controller' => 'campaignUsers', 'action' => 'view', 'admin' => false));
	Router::connect('/campaignUsers/*', array('controller' => 'campaignUsers', 'action' => 'index', 'admin' => false));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	// Users plugin
	Router::connect('/users', array('plugin' => 'users', 'controller' => 'users'));
	Router::connect('/users/index/*', array('plugin' => 'users', 'controller' => 'users'));
	Router::connect('/users/:action/*', array('plugin' => 'users', 'controller' => 'users'));
	Router::connect('/users/users/:action/*', array('plugin' => 'users', 'controller' => 'users'));
	Router::connect('/admin', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
	Router::connect('/admin/login', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
	Router::connect('/admin/users/login', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
	Router::connect('/backend', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
	Router::connect('/login', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
	Router::connect('/admin/logout', array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout'));
	Router::connect('/register', array('plugin' => 'users', 'controller' => 'users', 'action' => 'add'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
