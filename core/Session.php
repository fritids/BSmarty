<?php

/**
 * Session class
 * This class handle the session var.
 * @package bsmarty\core
 */
class Session {

	/**
	 * Construct
	 */
	public function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
	}

	/**
	 * Write
	 * Write an information in session
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function write($key, $value){
		$_SESSION[$key] = $value;
	}


	/**
	 * Read
	 * Read an information in the session
	 * @param null|string $key
	 * @param array|string|boolean
	 */
	public function read($key=NULL){
		if($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			}else{
				return false;
			}
		}else{
			return $_SESSION;
		}
	}

	/**
	 * Is Logged
	 * Test if a user is logged
	 * @return boolean
	 */
	public function isLogged(){
		return isset($_SESSION['User']->role);
	}

	/**
	 * Is Admin
	 * Test if a user is an administrator
	 * @return boolean
	 */
	public function isAdmin(){
		if($_SESSION['User']->role == "admin"){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * User
	 * Get information from the logged user
	 * @param string $key
	 * @return string|boolean
	 */
	public function user($key){
		if($this->read('User')){
			if(isset($this->read('User')->$key)){
				return $this->read('User')->$key;
			}else{
				return false;
			}
		}
		return false;
	}
}