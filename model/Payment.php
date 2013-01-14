<?php

/**
 * Payment class
 * Manage all payment
 * @package bsmarty\model
 */
class Payment extends Model{

	/* Attributes */
	public $drw;
	public $drw_back;
	public $drw_caisse;
	public $drw_labo;
	public $payment_system = false;
	// public $xml_path = ROOT.DS.'XML_Infologic';
	public $laboratory_id = '010';

	/* Other models */
	public $Request;
	public $Response;

	/**
	 * Constructor
	 * Instanciation of all sub classes in attributes
	 */
	public function __construct(){
		$this->drw = new DRW;
		$this->drw_back = new DRW_back;
		$this->drw_caisse = new DRW_caisse;
		$this->drw_labo = new DRW_labo;

		$this->Request = null;
		$this->Response = null;
	}

	/**
	 * Get Dep And Labels
	 * Get all insurance department and name here with no duplicates
	 * @return array of objects $data 
	 */
	public function get_DepAndLabels(){
		$resultDepartments = $this->drw_caisse->freeSQL('SELECT DISTINCT departement FROM drw_caisse');
		$resultLabels      = $this->drw_caisse->find(array(
			'fields' => 'libelle'));

		/* Select transformation */
		$zipcodes = new Stdclass;
		$i = 0;
		foreach($resultDepartments as $key){
			$zipcodes->$i = new Stdclass;
			$zipcodes->$i->id = $key->departement;
			$zipcodes->$i->name = $key->departement;
			$i++;
		}

		$labels = new Stdclass;
		$i = 0;
		foreach($resultLabels as $key){
			$labels->$i = new Stdclass;
			$labels->$i->id = $key->libelle;
			$labels->$i->name = $key->libelle;
			$i++;
		}

		$data['zipcodes'] = $zipcodes;
		$data['labels']      = $labels;

		return $data;
	}

	/**
	 * Bank price
	 */
	public function bank_price($montant) {
	
		if(strpos($montant, ",")) { // les decimales sont séparées par une virgule
			$pos_decim = strpos($montant, ",");
			// On va maintenant découper puis rassembler les deux chaines
			$montant_partie_1 = substr($montant, 0, $pos_decim);
			$montant_partie_2 = substr($montant, $pos_decim+1,2);
			
			// On rajoute un zero si le client n a mis que la virgule
			if (substr($montant, $pos_decim+1) == "") {
				$montant_partie_2 .= 0;
			}
			// On rajoute un zero si le client n a pas mis 2 chiffres apres la virgule
			if (substr($montant, $pos_decim+2) == "") {
				$montant_partie_2 .= 0;
			}
				
			// Il suffit de rassembler les parties 
			$montant = $montant_partie_1 . $montant_partie_2;
				
		}elseif(strpos($montant, ".")) { // les decimales sont séparées par un point
			$pos_decim = strpos($montant, ".");
			// On va maintenant découper puis rassembler les deux chaines
			$montant_partie_1 = substr($montant, 0, $pos_decim);
			$montant_partie_2 = substr($montant, $pos_decim+1,2);
			
			// On rajoute un zero si le client n a mis que le point
			if (substr($montant, $pos_decim+1) == "") {
				$montant_partie_2 .= 0;
			}
			// On rajoute un zero si le client n a pas mis 2 chiffres apres le point
			if (substr($montant, $pos_decim+2) == "") {
				$montant_partie_2 .= 0;
			}
				
			// Il suffit de rassembler les parties 
			$montant = $montant_partie_1 . $montant_partie_2;

		} else {	// Il n'y a pas de virgule et donc pas de decimale
			// Il suffit de rajouter les 2 zeros
			$montant = $montant . "00";
		}
		return $montant;
	}

	/**
	 * Set Date
	 * Set the date given in good format (FR or EN)
	 * @param string $date 
	 * @param string $format (EN by default)
	 */
	public function setDate($date, $format='EN'){
		if($format === 'FR'){ // Set the date in french format
			return date("d/m/Y", strtotime($date));
		}else{ // Set the date in english format
			return date("Y/m/d", strtotime($date));
		}
	}

	/**
	 * Load request
	 * Method to load charge and load the request model
	 */
	public function load_request(){
		if(!$this->payment_system){
			die('The payment system is not setted. Please check the controller.');
		}else{ // The payment system is setted, process
			require_once ROOT.DS.'vendors'.DS.'xpay'.DS.$this->payment_system.DS.'Xpay_Request.php';
			$this->Request = new Xpay_Request;
		}
	}

	/**
	 * Load response
	 * Method to load charge and load the request model
	 */
	public function load_response(){
		if(!$this->payment_system){
			die('The payment system is not setted. Please check the controller.');
		}else{ // The payment system is setted, process
			require_once ROOT.DS.'vendors'.DS.'xpay'.DS.$this->payment_system.DS.'Xpay_Response.php';
			$this->Response = new Xpay_Response;
		}
	}


}



/* ----------------- Specific classes ----------------- */

/**
 * DRW table
 */
class DRW extends Model{

	/* Attributes */
	public $table = 'drw';
	public $primaryKey = 'id_drw';

}

/**
 * DRW_back table
 */
class DRW_back extends Model{

	/* Attributes */
	public $table = 'drw_bak';
	public $primaryKey = 'id_drw';
}

/**
 * DRW_caisse table
 */
class DRW_caisse extends Model{

	/* Attributes */
	public $table = 'drw_caisse';
}

/**
 * DRW_labo table
 */
class DRW_labo extends Model{

	/* Attributes */
	public $table = 'drw_labo';
}