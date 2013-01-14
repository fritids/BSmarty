<?php
	$debut = microtime(TRUE);

	define('WEBROOT', dirname(__FILE__));
	define('ROOT', dirname(WEBROOT));
	define('DS', DIRECTORY_SEPARATOR);
	define('CORE', ROOT . DS . 'core');
	define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
	// define('BASE_URL', '');

	/**
	 * Call the CMS cors files
	 */
	require CORE . DS . 'includes.php';

	new Dispatcher();
?>
	<div style="position:fixed; bottom:0; background:#FF3333; color:#FFFFFF; line-height:20px; height:20px; left:0; right:0; padding-left:10px; font-size: 11px;">
		<?php
			echo 'Generated ' . round(microtime(TRUE)-$debut, 5) . ' seconds';
		?>
	</div>