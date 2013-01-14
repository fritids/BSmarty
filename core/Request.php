<?php

/**
 * Request class
 * This class handle the POST data forms and requests.
 * @package bsmarty\core
 */
class Request {
	
	public $url;	// URL called by user
	public $page = 1;
	public $prefix = FALSE;
	public $data = FALSE;

	/**
	 * Contructor
	 * Grab the data and build an object
	 */
	public function __construct() {
		$this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
		if(isset($_GET['page'])){
			if(is_numeric($_GET['page'])){
				if($_GET['page']>0){
					$this->page = round($_GET['page']);	
				}

			}
		}
		if(!empty($_POST)){
			$this->data = new stdClass();
			foreach($_POST as $k=>$v){
				$this->data->$k = $v;
			}
		}
	}
}