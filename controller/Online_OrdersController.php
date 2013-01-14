<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class Online_ordersController extends Controller{

	/**
	 * Index
	 * Enable the index view
	 */
	public function index(){
		if($this->Session->isLogged()){ // Is the visitor is logged ?
			$this->loadModel('Online_Orders');

			/* Grab all categories */
			$d['categories'] = $this->Online_Orders->category->find();

			/* Construct the rows */
			$d['rows'] = new StdClass;
			$i = 0;
			foreach ($d['categories'] as $category) {
				$d['rows']->$i           = new StdClass;
				$d['rows']->$i->category = new StdClass;
				$d['rows']->$i->items    = new StdClass;
				$d['rows']->$i->category = $category;
				$d['rows']->$i->items    = $this->Online_Orders->item->find(array(
					'conditions' => array('category_id' => $category->id)));
				$i++;
			}

			/* Set quantity select */
			$d['quatity'] = new StdClass;
			for($i=0;$i<11;$i++){
				$d['quatity']->$i = new StdClass;
				$d['quatity']->$i->id = $i;
				$d['quatity']->$i->name = $i;
			}

			$this->set($d);
			
		}else{
			$this->Flash->create('Vous devez vous connecter avant d\'accéder à cette page', 'alert');
			$this->redirect('users/login');
		}

	}

	/**
	 * Proceed
	 */
	public function proceed(){
		if($this->Session->isLogged()){ // Is the visitor is logged ?
			if($this->request->data){ // If there is data ?
				$this->loadModel('Online_Orders');			
				
				if(!empty($this->request->data->other)){
					$d['other'] = $this->request->data->other;
				}

				$d['items'] = $this->Online_Orders->formatOrders($this->request->data);

				$d['shipping'] = array(
					array('id'=> 'office', 'name' => 'Bureau'),
					array('id'=> 'clinic', 'name' => 'Clinique'),
					array('id'=> 'hospital', 'name' => 'Hôpital')
					);
				$d['shipping'] = array_to_object($d['shipping']);
				
				$this->set($d);
			}else{
				$this->Flash->create('You have to fill the form', 'alert');
				$this->redirect('Online_Orders');
			}
		}else{
			$this->Flash->create('Vous devez vous connecter avant d\'accéder à cette page', 'alert');
			$this->redirect('users/login');
		}
	}

	/**
	 * Checkout
	 */
	public function checkout(){
		if($this->Session->isLogged()){ // Is the visitor is logged ?
			if($this->request->data){ // If there is data ?
				$this->loadModel('Online_Orders');			
				
				$items = unserialize($this->request->data->items);
				$shipping = $this->request->data->shipping;
				$other = '';
				if(!empty($this->request->data->other)){
					$other = $this->request->data->other;
				}

				if($this->Online_Orders->sendOrder($_SESSION['User'], 'Nouvelle commande de matériels', 'http://www.atalante-pathologie.com', $items, $shipping, $other, 'online_orders')){
					$this->Flash->create('Votre commande a été transmise');
					$this->redirect('');
				}else{
					$this->Session->create('Une erreur est survenue lors du tranfert.<br />Merci de réessayer plus tard.', 'alert');
					$this->redirect('');
				}

				
			}else{
				$this->Flash->create('You have to fill the form', 'alert');
				$this->redirect('Online_Orders');
			}
		}else{
			$this->Flash->create('Vous devez vous connecter avant d\'accéder à cette page', 'alert');
			$this->redirect('users/login');
		}
	}

	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 */
	public function admin_index(){
		$this->loadModel('Online_Orders');

		/* Grab all categories */
		$d['categories'] = $this->Online_Orders->category->find();
		$d['items']      = $this->Online_Orders->item->find();
		
		/* Construct the rows */
		$d['rows'] = new StdClass;
		$i = 0;
		foreach ($d['categories'] as $category) {
			$d['rows']->$i           = new StdClass;
			$d['rows']->$i->category = new StdClass;
			$d['rows']->$i->items    = new StdClass;
			$d['rows']->$i->category = $category;
			$d['rows']->$i->items    = $this->Online_Orders->item->find(array(
				'conditions' => array('category_id' => $category->id)));
			$i++;
		}

		$this->set($d);
	}

	/**
	 * Admin Edit
	 */
	public function admin_edit($type){
		$this->loadModel('Online_Orders');

		if($type == 'category'){ // Work with categories
			if($this->Online_Orders->category->validates($this->request->data)){
				$this->request->data->slug = $this->Online_Orders->makeSlug($this->request->data->name); // Slug construction
				$this->Online_Orders->category->save($this->request->data);
				$this->Flash->create('Category saved');
				$this->redirect('admin/Online_Orders/');
			}else{
				$this->Flash->create('You have some mistakes', 'alert');
				$this->redirect('admin/Online_Orders/');
			}
		}elseif($type == 'item'){ // Work with items
			if($this->Online_Orders->item->validates($this->request->data)){
				if(empty($this->request->data->image)){
					unset($this->request->data->image);
				}
				$this->request->data->slug = $this->Online_Orders->makeSlug($this->request->data->name); // Slug construction
				$this->Online_Orders->item->save($this->request->data);
				$this->Flash->create('Item saved');
				$this->redirect('admin/Online_Orders/');
			}else{
				$this->Flash->create('You have some mistakes', 'alert');
				$this->redirect('admin/Online_Orders/');
			}
		}else{
			$this->Flash->create('Unknown type');
			$this->redirect('admin/Online_Orders/');
		}
	}

	/**
	 * Admin delete
	 */
	public function admin_delete($type, $id){
		$this->loadModel('Online_Orders');

		if($type == 'category'){ // Work with categories
			$items = $this->Online_Orders->item->find(array( // Get all items to delete
				'conditions' => array('category_id' => $id)
				));

			/* Deleting loop */
			foreach($items as $item){
				$this->Online_Orders->item->delete($item->id);
			}

			$this->Online_Orders->category->delete($id);
			$this->Flash->create('The category and all items have been deleted');
			$this->redirect('admin/Online_Orders/');
		}elseif($type == 'item'){ // Work with items
			$this->Online_Orders->item->delete($id);
			$this->Flash->create('The item has been deleted');
			$this->redirect('admin/Online_Orders/');
		}else{
			$this->Flash->create('Unknown type');
			$this->redirect('admin/Online_Orders/');
		}
	}

}