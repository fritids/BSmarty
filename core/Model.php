<?php

/**
 * Model
 * This class is the first level of database interaction.
 * Each class who want to access to the database have to extend this class.
 * @package bsmarty\core
 */
class Model {

	static $connections = array();

	public $conf = 'default';
	public $table = false;
	public $db;
	public $primaryKey = 'id';
	public $id;
	public $errors = array();
	public $form;

	/**
	 * Constructor
	 * Establish the database connection
	 */
	public function __construct() {
		// Initialize some variables
		if($this->table===false) {
			// Confguration
			$this->table = $this->make_plural(strtolower(get_class($this)));
		}

		// Database connection
		$conf = Conf::$databases[$this->conf];
		if(isset(Model::$connections[$this->conf])){
			$this->db = Model::$connections[$this->conf];
			return true;
		}
		try{
			$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';', 
				$conf['login'], 
				$conf['password'], 
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;
		}catch(PDOException $e){
			if(Conf::$debug>=1) {
				die($e->getMessage());
			}else {
				die('Can not connect to the database');	
			}
		}
	}

	/**
	 * Find
	 * Find request in database and return the result if exists.
	 * @param array $req Contain elements of request
	 * @return obejct (result)
	 */
	public function find($req = array()) {
		$sql = 'SELECT ';
		
		if(isset($req['fields'])){
			if(is_array($req['fields'])){
				$sql .= implode(', ', $req['fields']);
			}else {
				$sql .= $req['fields'];
			}
		}else {
			$sql .= '*';
		}

		// Table constructor
		if(isset($req['from'])){
			$sql .= ' FROM '.$req['from'].' ';
		}else{
			$sql .= ' FROM '.$this->table.' as '.get_class($this).' ';	
		}

		// Condition contructor
		if(isset($req['conditions'])){
			$sql .= 'WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions'];
			}else {
				$cond = array();
				foreach($req['conditions'] as $k=>$v){
					
					if(!is_numeric($v)){
						// $v = '"'.mysql_real_escape_string($v).'"';
						$v = '"'.$v.'"';
					}
					$cond[] = "$k=$v";
				}
				$sql .= implode(' AND ', $cond);
			}
		}

		if(isset($req['orderBy'])){
			$sql .= ' ORDER BY '.$req['orderBy'];
		}

		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
		}
		

		// debug($sql);

		// if(!$this->db){ self::__construct(); } // Can refresh the PDO connection


		$pre = $this->db->prepare($sql);
		// debug($pre);
		$pre->execute();
		
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Find First
	 * Find the first element of the request
	 * @param array $req
	 * @return object (result)
	 */
	public function findFirst($req){
		return current($this->find($req));
	}

	/**
	 * Find Count
	 * Count all returned elements
	 * @param string $condition
	 * @return init
	 */
	public function findCount($conditions=NULL){
		if($conditions === NULL){
			$res = $this->findFirst(array(
				'fields' => 'COUNT('.$this->primaryKey.') as count'
			));
		}else {
			$res = $this->find(array(
				'fields' => 'COUNT('.$this->primaryKey.') as count',
				'conditions' => $conditions
			));
		}

		// Test for result cleaner
		if(isset($res->count)){
			return $res->count;	
		}else{
			return array_shift($res)->count;
		}
		
	}


	/**
	 * Delete
	 * Delete element in table, by id
	 * @param string $id
	 * @return void
	 */
	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
		$this->db->query($sql);
	}

	/**
	 * Save
	 * Save or Edit element in the table, by id
	 * @param array $data
	 * @param array $conditions
	 * @return void
	 */
	public function save($data, $conditions=NULL){
		$key = $this->primaryKey;

		$fields = array();
		$d = array();
		foreach($data as $k=>$v){
			if($k!=$this->primaryKey){
				$fields[] = "$k=:$k";
				$d[":$k"] = $v;	
			}elseif(!empty($v)){
				$d[":$k"] = $v;	
			}
		}

		if(isset($data->$key) && !empty($data->$key)){
			$sql = 'UPDATE '.$this->table.' SET '.implode(',', $fields).' WHERE '.$key.'=:'.$key;
			$this->id = $data->$key;
			$action = 'update';
		}else{
			$sql = 'INSERT INTO '.$this->table.' SET '.implode(',', $fields);
			$action = 'insert';
		}
		// debug($sql);
		// die();
		$pre = $this->db->prepare($sql);
		$pre->execute($d);
		if($action == 'insert'){
			$this->id = $this->db->lastInsertId();
		}
	}

	/**
	 * Validates
	 * Validation form with rules
	 * The rules are declared in models
	 * @param array $data
	 * @return boolean
	 */
	function validates($data){
		$errors = array();
		foreach($this->validates as $k=>$v){
			if(!isset($data->$k)){
				$errors[$k] = $v['message'];
			}else{
				if($v['rule'] == 'notEmpty'){
					if(empty($data->$k)){
						$errors[$k] = $v['message'];
					} 
				}elseif(!preg_match( '/^'.$v['rule'] .'$/', $data->$k)){
					$errors[$k] = $v['message'];
				}
			}
		}
		$this->errors = $errors;

		if(isset($this->Form)){
			$this->Form->errors = $errors;
		}
		if(empty($errors)){
			return true;
		}
		return false;
	}


	/**
	 * Free SQL
	 * Execute free sql requests
	 * @param string $request
	 * @return object (results)
	 */
	public function freeSQL($request){
		$pre = $this->db->prepare($request);
		$pre->execute();

		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Clone
	 * We make a clone for nobody con clone it.
	 */
	private function __clone(){
		
	}

	/**
	 * Make plural
	 * Make the plural of the string given
	 * @param string $string (single)
	 * @return string (plural)
	 */
	public function make_plural($string){
		$lastchar = $string[strlen($string) - 1];
		
		if($lastchar == 'y'){
			$cut = substr($string, 0, -1);
			$plural = $cut.'ies';
		}else{
			$plural = $string.'s';
		}
		
		return $plural;
	}
}