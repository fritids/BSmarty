<?php

/**
 * Xpay Request class
 * @package xpay\atos
 */
class Xpay_Request extends Model{

	/* Attributes */
	private $caddie = array();
	private $config = array();
	private $path_bin = '';
	private $param = '';
	public $customer;
	public $domain = 'domain.com';
	public $merchant_id = 'XXXXXXXXXXXXXXX';

	/**
	 * Constructor
	 * Grab caddie's data and set variables
	 */
	public function __construct(){

		/* Setters */
		$this->caddie['informations'] = array();
		$this->caddie['informations'][] = session_id();
		$this->caddie['informations'][] = $_SESSION['USER_NOM'];
		$this->caddie['informations'][] = $_SESSION['USER_PRENOM'];
		$this->caddie['informations'][] = $_SESSION['CLE_PATIENT'];
		$this->caddie['informations'][] = $_SESSION['CADDIE_ID'];
		$this->caddie['informations'][] = $_SESSION['CADDIE_AMOUNT'];
		$this->caddie['informations'][] = $_SESSION['CADDIE_ID'];
		$this->caddie['informations'][] = $_SESSION['USER_EMAIL'];

		/* Create custmer ids */
		$this->customer = $this->sanitizer($_SESSION['CADDIE_ID']."_".$_SESSION['USER_NOM']."_".$_SESSION['USER_PRENOM']);

		/* Serialize the caddie */
		$this->caddie['serialised'] = $this->serializer($this->caddie['informations']);

		/* Set configuration */
		$this->config['merchant_id'] = $this->merchant_id;
		$this->config['pathfile'] = '/var/www/vhosts/'.$this->domain.'/httpdocs/bsmarty/vendors/xpay/atos/pathfile';
		$this->path_bin = '/var/www/vhosts/'.$this->domain.'/cgi-bin/request';
		$this->config['merchant_country'] = 'fr';
		$this->config['language'] = 'fr';
		$this->config['amount'] = $_SESSION['CADDIE_AMOUNT'];
		$this->config['currency_code'] = '978';
		$this->config['transaction_id'] = date("His");
		$this->config['order_id'] = $this->customer;
		$this->config['customer_email'] = $_SESSION['USER_EMAIL'];
		$this->config['customer_ip_address'] = $_SERVER['REMOTE_ADDR'];
		$this->config['caddie'] = $this->caddie['serialised'];

		$this->param = $this->build_param($this->config);

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
			$html = "<center><h1>ERROR calling request</h1></center>";
			$html .= "<p>&nbsp;</p>";
			$html .= "Exec \"request\" not found : ".$this->path_bin;
		}elseif($code != 0){
			$html = "<center><h1>ERROR calling paiement API.</h1></center>";
			$html .= "<p>&nbsp;</p>";
			$html .= "<p>Message : $error </p>";
		}else{
			$html .= "$message";
		}

		return $html;
	}

	/**
	 * Build param
	 * @param array $config 
	 */
	public function build_param($config){
		$end = count($config)-1;
		$i = 0;
		$data = '';
		while($param = current($config)){
			$data .= key($config).'='.$param;

			if($i!=$end){ $data .= ' '; }

			$i++;
			next($config);
		}

		return $data;
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

	/**
	 * Serializer
	 * Serialize and encode with base64, the var given
	 */
	public function serializer($var){
		return base64_encode(serialize($var));
	}

}
