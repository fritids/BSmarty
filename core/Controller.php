<?php

/**
 * Controller class
 * @package bsmarty\core
 */
class Controller {
	
	/* Attributes */
	public $request;	// Objet Request
	private $vars = array();	// Variables to pass for the view
	public $layout = 'default';	// Layout to render the view
	private $rendered = false;	// If the view already rendered

	
	/**
	 * Constructor
	 * @param $request Objet
	 */
	public function __construct($request=NULL) {

		/* Class instanciation */
		$this->Session = new Session();
		$this->Form = new Form($this);
		$this->Flash = new Flash();
		$this->Config = new Config();


		if($request){
			$this->request = $request;	// Stock request in instance
			require_once ROOT.DS.'config'.DS.'hook.php';
		}

		$this->siteInfo();
	}

	/**
	 * Site Info
	 * Store web site informations in server's sessions
	 */
	public function siteInfo(){
		$this->loadModel('Config');
		$siteInfo = $this->Config->find(array(
			'conditions' => array('category' => 'admin_general')
		));
		foreach($siteInfo as $k){
			$data['layoutInformations'][$k->slug] = $k;	
		}
		$this->set($data);
	}
	

	/**
	 * Render
	 * Render the view
	 * @param $view File to render (path from the view or view name)
	 */
	public function render($view) {
		if($this->rendered) { return FALSE;}
		extract($this->vars);
		if(strpos($view, '/')===0) {
			$view = ROOT.DS.'view'.$view.'.php';
		}else{
			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';	
		}
		ob_start();
		require_once(strtolower($view));
		$content_for_layout = ob_get_clean();
		require_once ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		$this->rentered = TRUE;
	}

	/**
	 * Set
	 * Pass variables
	 * @param string|array $key Vairable name or array of variables
	 * @param mixed $value 
	 */
	public function set($key, $value=NULL) {
		if(is_array($key)) {
			$this->vars += $key;
		}else{
			$this->vars[$key] = $value;
		}
	}

	/**
	 * Load Model
	 * Charge a model in the controller
	 * @param string|array $name Vairable name or array of variables
	 */
	public function loadModel($name) {
		if(is_array($name)){
			foreach ($name as $k) {
				if(!isset($this->$k)){
					$file = ROOT.DS.'model'.DS.$k.'.php';
					require_once($file);
					$this->$k = new $k();
					if(isset($this->Form)){
						$this->$k->Form = $this->Form;	
					}
				}	
			}
		}else{
			if(!isset($this->$name)){
				$file = ROOT.DS.'model'.DS.$name.'.php';
				require_once($file);
				$this->$name = new $name();
				if(isset($this->Form)){
					$this->$name->Form = $this->Form;	
				}
			}	
		}

	}

	/**
	 * E404
	 * Handle 404 error
	 * @param string $message
	 */
	function e404($message) {
		header("HTTP/1.0 404 Not Found");
		$this->set('message', $message);
		$this->render('/errors/404');
		die();
	}

	/**
	 * Request
	 * Call a controller from a view
	 * @param $controller
	 * @param $action
	 */
	function request($controller, $action){
		$controller .= 'Controller';
		require_once ROOT.DS.'controller'.DS.$controller.'.php';
		$c = new $controller();
		return $c->$action();
	}

	/**
	 * Redirect
	 * Handle redirection
	 * @param string $url
	 * @param boolean $code
	 */
	function redirect($url, $code=NULL) {
		if($code == 301){
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location: ".Router::url($url));
	}

}