<?php
/**
 * Functions
 * Helpful functions
 * @package bsmarty\core
 */


/**
 * Debug
 * Debug function to display informations properly
 * @param mixed $var
 * @return echoes
 */
function debug($var){
	if(Conf::$debug>0){
		$debug = debug_backtrace();
		echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return FALSE;"><strong>' . $debug[0]['file'] . ' </strong> l.' . $debug[0]['line'] . '</a></p>';
		echo '<ol style="display:none;">';
		foreach($debug as $k=>$v){ if($k>0){
			echo '<li><strong>' . $v['file'] . ' </strong> l.' . $v['line'] . '</li>';
		}}
		echo '</ol>';
		echo '<pre>';
		print_r($var);
		echo '</pre>';	
	}
}

/**
 * Array to object
 * This function convert an array to an oject
 * @param array $tab
 * @return object
 */
function array_to_object($tab){
	$data = new stdClass ;
	if(is_array($tab) && !empty($tab)){
		foreach($tab as $key => $val){
			if(is_array($val))
				$data->$key = array_to_object($val);
			else
				$data->$key = $val ;
		}
	}
	return $data ;
}
