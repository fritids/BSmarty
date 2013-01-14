<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class CategoriesController extends Controller{
	
	/**
	 * Index default
	 */
	public function index(){
		$perPage = $this->Config->general->posts_per_page;

		$this->loadModel('Category');
		$d['categories'] = $this->Category->find(array(
			'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			'conditions' => 'type="post" OR type="page"',
			'orderBy' => 'name DESC'
		));
		$d['total'] = $this->Category->findCount('type="post" OR type="page"');
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/**
	 * View
	 * Display Posts from current category
	 * @param int $id
	 * @param string $slug
	 */
	public function view($id, $slug) {
		$perPage = 5;
		$this->loadModel('Post');
		$this->loadModel('Category');
		$condition = array('online' => 1, 'type' => 'post', 'id_cat' => $id);
		
		$d['posts'] = $this->Post->find(array(
			'conditions' => $condition,
			'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			'orderBy' => 'created DESC'
		));
		$d['category'] = $this->Post->findFirst(array(
			'conditions' => array('id_cat' => $id)
		));

		$this->Post->excerpt($d['posts'], 550);
		$d['total'] = $this->Post->findCount($condition);
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 */
	public function admin_index($type=null){
		// $perPage = $this->Config->posts_per_page;
		$perPage = 10;
		$this->loadModel('Category');

		if($type=='posts'){
			$d['categories'] = $this->Category->find(array(
				'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
				'conditions' => 'type="post"',
				'orderBy' => 'name DESC'
			));
		}elseif($type=='pages'){
			$d['categories'] = $this->Category->find(array(
				'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
				'conditions' => 'type="page"',
				'orderBy' => 'name DESC'
			));
		}else{
			$d['categories'] = $this->Category->find(array(
				'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
				'conditions' => 'type="post" OR type="page"',
				'orderBy' => 'name DESC'
			));
		}

		
		$d['total'] = $this->Category->findCount();
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/**
	 * Admin Edit
	 * Edit an article
	 * @param int $id (NULL by default)
	 */
	public function admin_edit($id = NULL){
		$this->loadModel('Category');
		if($id === NULL){
			$categorie = $this->Category->findFirst(array(
				'conditions' => array('type' => 'unknown')
			));
			if(!empty($categorie)){
				$id = $categorie->id;
			}else{
				$this->Category->save(array(
					'type' => 'unknown'
				));
				$id = $this->Category->id;	
			}
		}
		$d['id'] = $id;
		if($this->request->data){
			$this->Category->save($this->request->data);
			$this->Flash->create('The category has been updated');
			$this->redirect('admin/categories/index');
		}else{
			$this->request->data = $this->Category->findFirst(array(
				'conditions' => array('id' => $id)
			));
		}
		$this->set($d);
	}

	/**
	 * Adminf Delete 
	 * Delete an article
	 * @param int $id
	 */
	public function admin_delete($id){
		$this->loadModel('Category');
		$this->Category->delete($id);
		$this->Flash->create('The category has been deleted');
		$this->redirect('admin/categories/index');
	}

}
