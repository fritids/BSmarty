<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class ContactController extends Controller{

	/**
	 * Index
	 */
	public function index(){
		if($this->request->data){
			$this->loadModel('Contact');
			if($this->Contact->validates($this->request->data) && isset($this->request->data->iQapTcha) && empty($this->request->data->iQapTcha) && isset($_SESSION['iQaptcha']) && $_SESSION['iQaptcha']){
				unset($_SESSION['iQaptcha']);
				$this->loadModel('Config');
				$from = $this->Config->findFirst(array(
						'fields' => 'value',
						'conditions' => array('slug' => 'emailfrom', 'category' => 'admin_general')
					))->value;
				$to = $this->Config->findFirst(array(
						'fields' => 'value',
						'conditions' => array('slug' => 'emailto', 'category' => 'admin_general')
					))->value;

				$this->Contact->send($this->request->data, $from, $to);
				$this->Flash->create('Email sent');
			}else{
				$this->Flash->create('Correct the informations please', 'alert');
				
			}
			
		}
	}

}