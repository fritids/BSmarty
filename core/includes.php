<?php

/**
 * Includes
 * This is the main file of the CMS
 * Called by the index.php in webroot directory
 * @package bsmarty\core
 */

/**
 * Includes vendors
 */
require_once ROOT.DS.'vendors'.DS.'phpmailer'.DS.'phpmailer.php';

/**
 * Includes core system files
 */
require_once 'Session.php';
require_once 'Form.php';
require_once 'functions.php';
require_once 'Router.php';

require_once ROOT.DS.'config'.DS.'conf.php';

require_once 'Request.php';
require_once 'Model.php';
require_once 'Config.php';
require_once 'SendMail.php';
require_once 'Flash.php';
require_once 'Controller.php';
require_once 'Dispatcher.php';

