<?php
/**
 * Dispatcher class
 * Load the controller in relation of the user request
 * @package bsmarty\core
 */
class Dispatcher {
	
	public $request;	// Object Request

	/**
	 * Constructor
	 * Load the controller with rooting
	 */
	function __construct() {
		$this->request = new Request();
		Router::parse($this->request->url, $this->request);
		$controller = $this->loadController();
		$action = $this->request->action;
		if($this->request->prefix){
			$action = $this->request->prefix . '_' . $action;
		}
		if(!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controller')))) {
			$this->error('The controller "' . $this->request->controller . '" has\'t any "' . $action . '" method.');
		}
		call_user_func_array(array($controller, $action), $this->request->params);
		$controller->render($action);
	}

	/**
	 * Error
	 * Generate an error message if there is a rooting problem
	 * @param string $message
	 */
	function error($message) {
		$controller = new Controller($this->request);
		$controller->e404($message);
	}

	/**
	 * Load Controller
	 * Load controller with the user request
	 */
	function loadController() {
		$name = ucfirst($this->request->controller) . 'Controller';
		$file = ROOT . DS . 'controller' . DS . $name . '.php';	
		if(!file_exists($file)){
			$this->error('The controller ' . $this->request->controller . ' doesn\'t exists.');
		}
		require_once $file;
		$controller = new $name($this->request);
		return $controller;

	}
}