<?php

/**
 * Controller class
 * This class handle flash messages to display informations
 * @package bsmarty\core
 */
class Flash {

	/**
	 * Create
	 * Create the flash message
	 * @param string $message
	 * @param string $type
	 * @return void
	 */
	public function create($message, $type='success'){
		$_SESSION['flash'] = array(
			'message' => $message,
			'type' => $type
		);
	}

	/**
	 * Display
	 * Display the message if needed
	 * @param void
	 * @return string HTML value of the message 
	 */
	public function display(){
		/**
		 * Use an offset to display the message even if there is a redirection
		 */

		if(isset($_SESSION['flash']['message'])){
			$html = '<div class="alert-box ' . $_SESSION['flash']['type'] . '">' . $_SESSION['flash']['message'] . '<a href="#" class="close">&times;</a></div>';

			$_SESSION['flash'] = array();

			return $html;
		}
	}

}