<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class DownloadsController extends Controller {


	/**
	 * Index
	 * Get all downloadable files
	 */
	public function index(){
		if($this->Session->isLogged()){ // Is the visitor is logged ?
			$this->loadModel('Download_file');
			$perPage = 10;
			// Get all activated files 
			$d['files'] = $this->Download_file->find(array(
				'conditions' => array('status' => 'activated')
				));
			$d['total'] = $this->Download_file->findCount(array('status' => 'activated'));
			$d['page'] = ceil($d['total']/$perPage);
			$this->set($d);
			
		}else{
			$this->Flash->create('Yous have to login first to access to this page', 'alert');
			$this->redirect('');
		}
		
	}

	/**
	 * Download
	 * Log the user and give the file
	 */
	public function download($id){
		$this->loadModel('Download_log');
		$this->loadModel('Download_file');

		// Save the user actions
		$this->Download_log->save(array(
					'user_id'    => $_SESSION['User']->id,
					'file_id'    => $id,
					'ip'         => $_SERVER["REMOTE_ADDR"],
					'date'       => date("Y-m-d H:i:s") // MySQL date format
				));

		// Load file informations
		$file = $this->Download_file->findFirst(array(
			'conditions' => array('id' => $id)
			));

		// Send download confirmation email
		$email = $this->Download_log->sendMail($_SESSION['User'], $file->name, 'Confirmation de téléchargement', 'http://www.atalante-pathologie.com', 'download_confirmation');


		$extension = '.'.pathinfo(WEBROOT.DS.'downloads'.DS.$file->type.DS.$file->file, PATHINFO_EXTENSION);
		
		header('Content-Type: application/octet-stream');
		header('Content-disposition: attachment; filename='.$file->name.$extension);
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Expires: 0');
		readfile(WEBROOT.DS.'downloads'.DS.$file->type.DS.$file->file);
		exit();
	}


	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 * Load all downloadable files
	 */
	public function admin_index(){
		$this->loadModel('Download_file');
		$this->loadModel('Download_log');		

		$perPage = 10;
		$this->layout = 'admin';
		$d['downloads'] = $this->Download_file->find(array(
			'limit' => ($perPage*($this->request->page-1)).','.$perPage,
			'orderBy' => 'id DESC'
		));

		// Get the number of download of each files
		foreach ($d['downloads'] as $file) {
			$file->downloaded = $this->Download_log->findCount(array('file_id' => $file->id));
		}

		$d['total'] = $this->Download_file->findCount();
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/**
	 * Admin Edit
	 * Edit a file
	 * @param int $id (NULL by default)
	 */
	public function admin_edit($id=0){
		$this->loadModel('Download_file');
	
		if($this->request->data && !empty($_FILES['file']['name']) && $id==0){ // Create action
			// debug($_FILES['file']['type']); die();
			$check = $this->Download_file->fileCheck($_FILES['file']['type']);
			if($check){ // File type allowed
				$dir = WEBROOT.DS.'downloads/'.$check.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777);
				move_uploaded_file($_FILES['file']['tmp_name'],$dir.DS.$_FILES['file']['name']);
				$this->Download_file->save(array(
					'name'        => $this->request->data->name,
					'description' => $this->request->data->description,
					'file'        => date('Y-m').'/'.$_FILES['file']['name'],
					'type'        => $check,
					'status'      => $this->request->data->status,
					'created'     => date("Y-m-d H:i:s") // MySQL date format
				));
				$this->Flash->create("The file has been uploaded");
				$this->redirect('admin/downloads/index');
			}else{
				$this->Flash->create("The file hasn't be uploaded, check the extension", "error");
			}
			
		}else{ // Edit action
			if($this->request->data){

				if(!empty($_FILES['file']['name'])){ // If there is a file update
					// First, delete the old file
					$old_file = $this->Download_file->findFirst(array(
						'conditions' => array('id' => $id)
						));

					// Do the suppression
					unlink(WEBROOT.DS.'downloads'.DS.$old_file->type.DS.$old_file->file);

					$check = $this->Download_file->fileCheck($_FILES['file']['type']);
					if($check){ // File type allowed
						$dir = WEBROOT.DS.'downloads/'.$check.DS.date('Y-m');
						if(!file_exists($dir)) mkdir($dir,0777);
						move_uploaded_file($_FILES['file']['tmp_name'],$dir.DS.$_FILES['file']['name']);

						$this->request->data->file = date('Y-m').'/'.$_FILES['file']['name'];
						$this->request->data->type = $check;

						$this->Download_file->save($this->request->data);
						$this->Flash->create("The file has been updated");
						$this->redirect('admin/downloads/index');
					}else{
						$this->Flash->create("The file hasn't be uploaded, check the extension", "error");
					}
				}else{ // Save just the file informations
					$this->Download_file->save($this->request->data);
					$this->Flash->create("The file has been updated");
					$this->redirect('admin/downloads/index');
				}

			}else{ // Edit view
				$this->request->data = $this->Download_file->findFirst(array(
					'conditions' => array('id' => $id)
				));
			}
		}

		$d['id'] = $id;
		$this->set($d);
	}

	/**
	 * Admin Delete
	 * Delete the file and his log
	 */
	public function admin_delete($id){
		$this->loadModel('Download_file');
		$this->loadModel('Download_log');

		// First, we erease the file
		$file = $this->Download_file->findFirst(array(
			'conditions' => array('id' => $id)
		));
		unlink(WEBROOT.DS.'downloads'.DS.$file->type.DS.$file->file);
		$this->Download_file->delete($id);

		// Second, we erease the log
		$logs = $this->Download_log->find(array(
			'conditions' => array('file_id' => $id)
			));
		// Loop to delete them all
		foreach ($logs as $key) {
			$this->Download_log->delete($key->id);
		}

		$this->Flash->create("The file and his log have been deleted");
		$this->redirect('admin/Downloads/index');
	}

	/**
	 * Admin Log
	 * Show log on a file
	 */
	public function admin_log($id){
		$this->loadModel('Download_file');
		$this->loadModel('Download_log');
		$this->loadModel('User');

		// Grab some data
		$d['file'] = $this->Download_file->find(array(
			'conditions' => array('id'=> $id)
			));

		/* We use the FreeSQL method for joinning tables */
		$d['logs'] = $this->Download_log->freeSQL("SELECT * FROM download_logs AS logs INNER JOIN users ON logs.user_id = users.id AND logs.file_id = $id");

		$this->set($d);
	}

}