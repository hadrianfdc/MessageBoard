<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	// app/Config/routes.php
	Router::connect('/login', array('controller' => 'logins', 'action' => 'login'));
	Router::connect('/register', array('controller' => 'registers', 'action' => 'new_user'));
	Router::connect('/logout', array('controller' => 'logins', 'action' => 'logout'));
	Router::connect('/user-profile', array('controller' => 'Userprofiles', 'action' => 'user_profile'));
	Router::connect('/newsfeed', array('controller' => 'Userprofiles', 'action' => 'newsfeed'));
	Router::connect('/update_background_img', array('controller' => 'Posts', 'action' => 'background_img'));
	Router::connect('/upload_profile_picture', array('controller' => 'Posts', 'action' => 'index'));
	Router::connect('/togglePin', ['controller' => 'UserProfiles', 'action' => 'togglePin']);
	Router::connect('/toggleArchieve', ['controller' => 'UserProfiles', 'action' => 'toggleArchieve']);
	Router::connect('/toggleTrash', ['controller' => 'UserProfiles', 'action' => 'toggleTrash']);	
	Router::connect('/user-profiles-of/*', ['controller' => 'UserProfiles', 'action' => 'user_profile_by_others']);	



	// Router::connect('/Registers/new_user', array('controller' => 'Registers', 'action' => 'new_user'));
	// Load the HtmlHelper
	// Router::connect('/posts', array('controller' => 'posts', 'action' => 'index'));
	Router::connect('/messages/view_conversation/:user_id', array('controller' => 'messages', 'action' => 'viewConversation'), array('pass' => array('user_id')));

	
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
