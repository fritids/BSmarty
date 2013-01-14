<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class ConfigsController extends Controller {
	
	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 */
	public function admin_index(){
		
	}

	/**
	 * Admin General
	 * Manage general CMS options
	 */
	public function admin_general() {
		$this->loadModel('Config');
		if($this->request->data){
			$this->Config->save($this->request->data);
			$this->redirect('admin/configs/general');

		}
		$d['data']= $this->Config->find(array(
			'conditions' => array('category' => 'admin_general')
		));
		$this->set($d);
	}
}
