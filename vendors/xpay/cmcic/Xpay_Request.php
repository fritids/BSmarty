<?php

/**
 * Xpay Request class
 * @package xpay\cmcic
 */
class Xpay_Request extends Model{

	/* Attributes */
	private $caddie = array();
	private $config = array();
	private $path_bin = '';
	private $param = '';
	public $customer;
	public $domain = 'atalante-pathologie.com';
	public $merchant_id = '013044876511111';

	/**
	 * Constructor
	 * Grab caddie's data and set variables
	 */
	public function __construct(){

		/* Setters */
		$this->caddie['id'] = $_SESSION['CADDIE_ID'];
		$this->caddie['amount'] = $_SESSION['CADDIE_AMOUNT'];
		$this->caddie['currency'] = 'EUR'; // Currency : ISO 4217 compliant
		$this->caddie['ip'] = $_SESSION['REMOTE_ADDR'];
		$this->caddie['language'] = 'FR';
		$this->caddie['date'] = date("d/m/Y:H:i:s");
		$this->caddie['email'] = $_SESSION['USER_EMAIL'];

		/* Create custmer ids */
		$this->customer = $this->sanitizer($_SESSION['CADDIE_ID']."_".$_SESSION['CLE_PATIENT']."_".$_SESSION['USER_NOM']."_".$_SESSION['USER_PRENOM']."_".$_SERVER['REMOTE_ADDR']."_".$_SESSION['USER_EMAIL']);

		// between 2 and 4
		//$sNbrEch = "4";
		$this->caddie['NbrEch'] = "";

		// date echeance 1 - format dd/mm/yyyy
		//$sDateEcheance1 = date("d/m/Y");
		$this->caddie['DateEcheance1'] = "";

		// montant échéance 1 - format  "xxxxx.yy" (no spaces)
		//$sMontantEcheance1 = "0.26" . $sDevise;
		$this->caddie['MontantEcheance1'] = "";

		// date echeance 2 - format dd/mm/yyyy
		$this->caddie['DateEcheance2'] = "";

		// montant échéance 2 - format  "xxxxx.yy" (no spaces)
		//$sMontantEcheance2 = "0.25" . $sDevise;
		$this->caddie['MontantEcheance2'] = "";

		// date echeance 3 - format dd/mm/yyyy
		$this->caddie['DateEcheance3'] = "";

		// montant échéance 3 - format  "xxxxx.yy" (no spaces)
		//$sMontantEcheance3 = "0.25" . $sDevise;
		$this->caddie['MontantEcheance3'] = "";

		// date echeance 4 - format dd/mm/yyyy
		$this->caddie['DateEcheance4'] = "";

		// montant échéance 4 - format  "xxxxx.yy" (no spaces)
		//$sMontantEcheance4 = "0.25" . $sDevise;
		$this->caddie['MontantEcheance4'] = "";

	}

	/**
	 * Render
	 * Execute the binaries and build the html (or error message)
	 */
	public function render(){
		//debug('Request.php - Render method - Before binaries execution.'); die();
		$result = exec($this->path_bin.' '.$this->param);

		//On separe les differents champs et on les met dans un  tableau
		$tableau = explode ("!", $result);

		//Récupération des paramètres
		$code    = $tableau[1];
		$error   = $tableau[2];
		$message = $tableau[3];

		$html = '';
		// Check code if error exists
		if(($code == "") && ($error == "")){
			$html = "<center><h1>Erreur appel request</h1></center>";
			$html .= "<p>&nbsp;</p>";
			$html .= "Executable request non trouve : ".$this->path_bin;
		}elseif($code != 0){
			$html = "<center><h1>Erreur appel API de paiement.</h1></center>";
			$html .= "<p>&nbsp;</p>";
			$html .= "<p>Message erreur : $error </p>";
		}else{
			$html .= "$message";
		}

		return $html;
	}

	/**
	 * Sanitizer
	 * Sanitize the var given and crop it
	 */
	public function sanitizer($var){
		$forbidden = array("²","&","\"","'","(","è","é","ê","ë","ç","à",")","=","~","#","{","[","|","`","\\","^","@","]","}","+","°","%","¤","*","!",":",",",";","?","/","$","£","€","<",">"," ");
		$allowed = array("-","-","-","-","-","e","e","e","e","c","a","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","_");

		$sanitized = str_replace($forbidden,"_",$var);

		if(strlen($sanitized) >= 33) $sanitized = substr($sanitized,0,31);

		return 	$sanitized;
	}

}
