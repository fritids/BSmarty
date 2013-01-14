<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class UsersController extends Controller {
	
	/**
	 * Register
	 */
	public function register(){
		if($this->Session->isLogged()){
			$this->Flash->create('Why would you register yourself again ?', 'secondary');
			$this->redirect('');
		}else{
			if($this->request->data){
				$this->loadModel('User');

				if($this->User->validates($this->request->data)){
					
					$user = $this->request->data;
					$user->id      = '';
					$user->role    = 'user';
					$user->status  = 'pending';
					$user->created = date("Y-m-d H:i:s"); // MySQL date format

					if($user->password !== $user->password_confirm){
						$this->Flash->create('Your passwords aren\'t the same.', 'alert');
					}else{
						unset($user->password_confirm); // Password confirmation is useless now
						$user->password = sha1($data->password); // Crypt the password

						$this->User->save($user);

						// Send new user confirmation email
						$email = $this->User ->sendMail($user, 'Nouveau membre', $this->Config->general->site_url, 'new_user');

						$this->Flash->create('Thank you for your registration.');
						$this->redirect('');
					}
					
				}else{
					$this->Flash->create('You have some mistakes', 'alert');
				}
			}
		}
	}

	/**
	 * Login
	 * Authentifiate a user
	 */
	public function login(){
		if($this->request->data){
			$data = $this->request->data;
			$data->password = sha1($data->password);
			$this->loadModel('User');
			$user = $this->User->findFirst(array(
				'conditions' => array('login' => $data->login, 'password' => $data->password
			)));
			if(!empty($user)){ // If the user exists
				if($user->status == 'refused'){ // Acount refused
					$this->Flash->create('Your account has been refused, you can\'t connect to the website.<br />Contact the system administrator for more informations.', 'alert');
					$this->redirect('users/login');
				}elseif($user->status == 'pending'){ // Account pending
					$this->Flash->create('Your account is awaiting activation. <br />Contact the system administrator for more informations.', 'secondary');
					$this->redirect('users/login');
				}elseif($user->status == 'activated'){ // Access Granted
					$this->Session->write('User', $user);
					$this->request->data->password = '';
					$this->Flash->create('Hello '.$data->login.' :)');

					if($this->Session->isAdmin()){
						$this->redirect('bs-admin');
					}else{
						$this->Flash->create('You are already connected.', 'secondary');
						$this->redirect('');
					}
				}else{
					$this->redirect('');
				}
			}else{ // If not
				$this->Flash->create('Your login / password are not valid, or the account doesn\'t exists.', 'alert');
				$this->redirect('users/login');
			}
			
		}elseif($this->Session->isLogged()){
			if($this->Session->user('role') == 'admin'){
				$this->redirect('bs-admin');
			}else{
				$this->Flash->create('You are already connected.', 'secondary');
				$this->redirect('');
			}
			
		}
	}

	/**
	 * Logout
	 * Disconnect a user
	 */
	public function logout(){
		unset($_SESSION['User']);
		$this->Flash->create('You are disconnected.');
		$this->redirect('');
	}

	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 * Show all user with pagination
	 */
	public function admin_index(){
		$perPage = 10;
		$this->loadModel('User');
		$d['categories'] = $this->User->find(array(
			'limit' => ($perPage*($this->request->page-1)) . ',' . $perPage,
			/*'conditions' => 'status!="unknown"',*/
			'orderBy' => 'id DESC'
		));
		$d['total'] = $this->User->findCount();
		$d['page'] = ceil($d['total']/$perPage);
		$this->set($d);
	}

	/**
	 * Admin Edit
	 * Edit or Create a user
	 *
	 * When a user is created, an email is sent with his personnal informations
	 * like login, password and a custome message.
	 *
	 * @param int ID
	 */
	public function admin_edit($id = NULL){
		$this->loadModel('User');
		if($id === NULL){
			$user = $this->User->findFirst(array(
				'conditions' => array('status' => 'unknown')
			));
			if(!empty($user)){
				$id = $user->id;
			}else{
				$this->User->save(array(
					'status' => 'unknown'
				));
				$id = $this->User->id;	
			}
		}
		$d['id'] = $id;
		if($this->request->data){
			if($this->User->validates($this->request->data)){
				$user = $this->request->data;
				unset($user->password_confirm); // Password confirmation is useless now
				$user->password = sha1($user->password); // Crypt the password

				$this->User->save($user);
				$this->Flash->create('The user has been modified.');
				$this->redirect('admin/users/index');
			}elseif(empty($this->request->data->password)){ // We don't change the password
				$user = $this->request->data;
				unset($user->password_confirm); // Password confirmation is useless now
				unset($user->password);

				$this->User->save($user);
				$this->Flash->create('The user has been modified.');
				$this->redirect('admin/users/index');
			}else{
				$this->Flash->create('You have some mistakes', 'alert');
			}

		}else{
			$this->request->data = $this->User->findFirst(array(
				'conditions' => array('id' => $id)
			));

			$d['role'] = $this->request->data->role;
			$d['status'] = $this->request->data->status;

			/* Form presets */
			$role_available = array(array('id' => 'user', 'name' => 'User'), array('id' => 'admin', 'name' => 'Admin'));
			$d['role_available'] = array_to_object($role_available);
			$status_available = array(array('id' => 'refused', 'name' => 'Refused'), array('id' => 'pending', 'name' => 'Pending'), array('id' => 'accepted', 'name' => 'Accepted'));
			$d['status_available'] = array_to_object($status_available);
		}
		$this->set($d);
	}

	/**
	 * Admin Delete
	 * Delete a user with his ID
	 * @param numeric ID
	 */
	public function admin_delete($id){
		$this->loadModel('User');
		$this->User->delete($id);
		$this->Flash->create('The user has been deleted');
		$this->redirect('admin/users/index');
	}

}