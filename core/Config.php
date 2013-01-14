<?php

/**
 * Config
 * This class handle all the website options for core
 */
class Config extends Model {

	/** ATRIBUTES **/
	public $general;

	/**
	 * Constructor
	 * Grab data form database
	 */
	public function __construct(){
		parent::__construct(); // Refresh the PDO connection

		//$options = $this->freeSQL("SELECT * FROM {$this->table} WHERE category='admin_general'");
		$options = $this->find(array(
			'fields' => 'slug, value',
			'conditions' => array('category' => 'admin_general')
			));

		foreach($options as $option){
			$general[$option->slug] = $option->value;
		}

		$this->general = array_to_object($general);
	}

}