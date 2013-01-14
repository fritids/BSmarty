<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class MediasController extends Controller{
	
	// img + pdf video zip rar 7zip

	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 * Load all medias files
	 */
	public function admin_index(){
		$this->loadModel('Media');
		if($this->request->data && !empty($_FILES['file']['name'])){
			// debug($_FILES['file']['type']); die();
			$check = $this->Media->fileCheck($_FILES['file']['type']);
			if($check){ // File type allowed
				$dir = WEBROOT.DS.'medias/'.$check.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777);
				move_uploaded_file($_FILES['file']['tmp_name'],$dir.DS.$_FILES['file']['name']);
				$this->Media->save(array(
					'name' => $this->request->data->name,
					'file' => date('Y-m') . '/' . $_FILES['file']['name'],
					'post_id' => '0',
					'type' => $check
				));
				$this->Flash->create("The file has been uploaded");
			}else{
				$this->Flash->create("The file has't been uploaded, check the extension file", "error");
			}
			
		}

		$perPage = 10;
		$this->layout = 'admin';
		$d['medias'] = $this->Media->find(array(
			'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			'orderBy' => 'id DESC'
		));
		$d['total'] = $this->Media->findCount();
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/**
	 * Admin Posts
	 * Upload the media files related to the current post
	 * Display the media files related to the current post
	 * Display ALL media files 
	 * @param int $id
	 */
	public function admin_posts($id){
		$this->loadModel('Media');
		if($this->request->data && !empty($_FILES['file']['name'])){
			$check = $this->Media->fileCheck($_FILES['file']['type']);
			if($check){ // File type allowed
				$dir = WEBROOT . DS . 'medias/'.$check.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777);
				move_uploaded_file($_FILES['file']['tmp_name'],$dir . DS . $_FILES['file']['name']);
				$this->Media->save(array(
					'name' => $this->request->data->name,
					'file' => date('Y-m') . '/' . $_FILES['file']['name'],
					'post_id' => $id,
					'type' => $check
				));
				$this->Flash->create("File uploaded");
			}else{
				$this->Form->errors['file'] = "File type not allowed";
			}
		}
		$this->layout = 'modal';
		$perPage = 10;

		/* Build variables for the explorer modal */
		$d['postMedias'] = $this->Media->find(array(
			'conditions' => array('post_id' => $id),
			// 'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			'orderBy' => 'id DESC'
		));


		$d['postMediasTotal'] = $this->Media->findCount(array('post_id' => $id ));
		$d['postMediasPage'] = ceil($d['postMediasTotal']/$perPage);
		$d['post_id'] = $id;


		$d['allMedias'] = $this->Media->find(array(
			// 'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			'orderBy' => 'id DESC'
		));
		$d['allMediasTotal'] = $this->Media->findCount();
		$d['allMediasPage'] = ceil($d['allMediasTotal']/$perPage);

		$this->set($d);
	}

	/**
	 * Admin Delete
	 * Delete a media file
	 * @param int $id
	 */
	public function admin_delete($id){
		$this->loadModel('Media');
		$media = $this->Media->findFirst(array(
			'conditions' => array('id' => $id)
		));
		unlink(WEBROOT . DS . 'img' . DS . $media->file);
		$this->Media->delete($id);
		$this->Flash->create("Media has been deleted");
		$this->redirect('admin/medias/index/' . $media->post_id);
	}

}
