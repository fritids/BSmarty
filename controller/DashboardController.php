<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class DashboardController extends Controller{

	/**
	 * Index
	 */
	public function index(){
		if(!$this->Session->isLogged()){ // Is the visitor logged ?
			$this->Flash->create('You have to login before', 'alert');
			$this->redirect('users/login');
		}else{ // It is a simple user
			// proceed...
		}
		
	}

	/**
	 * Admin index
	 */
	public function admin_index(){
		// proceed...

		// Exemple of use Menu method to display menus
		$this->loadmodel("Menu");
		$d['menu'] = $this->Menu->getMenu('Dashboard');

		$this->set($d);
	}

}