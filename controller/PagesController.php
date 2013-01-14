<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class PagesController extends Controller {
	
	/**
	 * Index
	 * Display the home page
	 * @param int $id
	 */
	public function index($id){
		$this->loadModel('Post');
		$d['page'] = $this->Post->findFirst(array(
			'conditions' => array('online' => 1, 'id' => $id, 'type'=>'page')
		));

		if(empty($d['page'])){
			$this->e404('Page introuvable');
		}

		/**
		 * Shortcodes making
		 */
		$this->loadModel(array('Shortcode', 'ThemeShortcode'));
		$this->ThemeShortcode->add_shortcode('tabs', 'tabulars');
		$this->ThemeShortcode->add_shortcode('tab', 'tab');
		$this->ThemeShortcode->add_shortcode('accordion', 'accordion');
		$this->ThemeShortcode->add_shortcode('pane', 'accordion_panel');
		$this->ThemeShortcode->add_shortcode('slider', 'slider');
		$this->ThemeShortcode->add_shortcode('slide', 'slide');
		$this->ThemeShortcode->add_shortcode('table', 'table');
		$this->ThemeShortcode->add_shortcode('line', 'line');
		$this->ThemeShortcode->add_shortcode('col', 'col');

		$d['page']->content = $this->ThemeShortcode->do_shortcode($d['page']->content);
		/**
		 * End of shortcode making
		 */

		$this->set($d);	
	}

	/** 
	 * View
	 * Display page content
	 * @param int $id
	 * @param string $slug (NULL by default)
	 */
	public function view($id, $slug=NULL) {
		$this->loadModel('Post');
		$d['page'] = $this->Post->findFirst(array(
			'conditions' => array('online' => 1, 'id' => $id, 'type'=>'page')
		));
		if(empty($d['page'])){
			$this->e404('Page introuvable');
		}

		// Redirection problem
		if($slug AND $slug != $d['page']->slug){
			$this->redirect("page/view/id:$id/slug:" . $d['post']->slug, 301);
		}

		/**
		 * Shortcodes making
		 */
		$this->loadModel(array('Shortcode', 'ThemeShortcode'));
		$this->ThemeShortcode->add_shortcode('tabs', 'tabulars');
		$this->ThemeShortcode->add_shortcode('tab', 'tab');
		$this->ThemeShortcode->add_shortcode('accordion', 'accordion');
		$this->ThemeShortcode->add_shortcode('pane', 'accordion_panel');
		$this->ThemeShortcode->add_shortcode('slider', 'slider');
		$this->ThemeShortcode->add_shortcode('slide', 'slide');
		$this->ThemeShortcode->add_shortcode('table', 'table');
		$this->ThemeShortcode->add_shortcode('line', 'line');
		$this->ThemeShortcode->add_shortcode('col', 'col');

		$d['page']->content = $this->ThemeShortcode->do_shortcode($d['page']->content);
		/**
		 * End of shortcode making
		 */

		$this->set($d);	
	}

	/**
	 * Get Menu
	 * Get all pages to display in menu
	 */
	public function getMenu(){
		$this->loadModel('Post');
		return $this->Post->find(array(
			'conditions' => array('online' => 1, 'type' => 'page')
		));
	}

	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 */
	public function admin_index(){
		$perPage = 10;
		$this->loadModel('Post');
		$condition = array('type' => 'page');
		$d['posts'] = $this->Post->find(array(
			'fields' => 'id,id_cat,name,created,online',
			'conditions' => $condition,
			'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			'orderBy' => 'created DESC'
		));

		$this->loadmodel('Category');
		foreach($d['posts'] as $k){
			$condition_categorie = array('fields' => 'id, name', 'conditions' => array('id' => $k->id_cat));
			$k->cat_name = $this->Category->findFirst($condition_categorie)->name;
		}

		$d['total'] = $this->Post->findCount($condition);
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/**
	 * Admin Edit
	 * Edit a page
	 * @param int $id (NULL by default)
	 */
	public function admin_edit($id = NULL){
		$this->loadModel('Post');
		if($id === NULL){
			$post = $this->Post->findFirst(array(
				'conditions' => array('online' => -1)
			));
			if(!empty($post)){
				$id = $post->id;
			}else{
				$this->Post->save(array(
					'online' => -1
				));
				$id = $this->Post->id;	
			}
		}
		$d['id'] = $id;
		if($this->request->data){
			if($this->Post->validates($this->request->data)){
				$this->request->data->type = 'page';
				if(empty($this->request->data->created)){
					$this->request->data->created = date("Y-m-d H:i:s"); // MySQL date format
				}else{
					$this->request->data->created = date($this->request->data->created . ' h:i:s');
				}

				/* Check if the slug already exists */
				if(!$this->Post->checkSlug($this->request->data->slug, $id)){
					$this->Post->save($this->request->data);
					$this->Flash->create('The page is saved');
					$this->redirect('admin/posts/index');
				}else{
					$this->Flash->create('There another slug with this name, slug has to be unique.', 'alert');
				}
				
			}else{
				$this->Flash->create('You have some mistakes', 'alert');
			}

		}else{
			$this->request->data = $this->Post->findFirst(array(
				'conditions' => array('id' => $id)
			));
		}
		$this->loadmodel('Category');
		$d['categories']['list'] = $this->Category->find(array(
			'conditions' => array('type' => 'page')
		));

		/* Load the editor output */
		$d['the_editor'] = $this->Post->the_editor();

		$this->set($d);
	}

	/**
	 * Admin Delete
	 * Delete a page
	 * @param int $id
	 */
	public function admin_delete($id){
		$this->loadModel('Post');
		$this->Post->delete($id);
		$this->Flash->create('The page has been deleted');
		$this->redirect('admin/pages/index');
	}

	/**
	 * Admin Tinymce
	 * List all pages available
	 */
	public function admin_tinymce(){
		$this->loadModel('Post');
		$this->layout = 'modal';
		$d['posts'] = $this->Post->find();
		$this->set($d);
	}
}
