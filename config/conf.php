<?php

/**
 * Config class
 * This class sets the configuration informations like database credentials, debug
 * @package bsmarty\config
 */
class Conf{
	
	static $debug = 1;

	static 	$databases = array(
				'default' => array(
					'host'     => 'localhost',
					'database' => 'bsmarty',
					'login'    => 'root',
					'password' => ''
					)
			);
}


Router::prefix('bs-admin', 'admin');

Router::connect('', 'posts/index'); // Choose the homepage
Router::connect('bs-admin', 'bs-admin/dashboard');
Router::connect('page/:slug-:id', 'pages/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('post/:slug-:id', 'posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');

Router::connect('blog/*', 'posts/*');
