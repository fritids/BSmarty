<?php

/**
 * Xpay Response class
 * @package xpay\atos
 */
class Xpay_Response extends Model{

	/* Attributes */
	public $table = 'drw'; // Database work
	public $primaryKey = 'id_drw';
	private $checkout = array();
	public $pathfile = '';
	public $path_bin = '';
	private $log = '';
	public $domain = 'domain.com';
	public $merchant_id = 'XXXXXXXXXXXXXXX';
	public $merchant_name = 'Merchant Name';
	

	/**
	 * Constructor
	 * Set variables and call the bin exec
	 */
	public function __construct(){
		
		/* Grab the DATA var form the server */
		$message = "message=".escapeshellcmd($_POST['DATA']);
		//$message = escapeshellcmd("message=2020363730603028502c2360562d5360532d2360522e3360502c4361sasq0502c3334502c332c502d2330582d5338552c3324512c33242a2c2360532c2360502d2324582c23602a2c2360552c2360502d4324572c3324512e3048512c2334502c2360523054282a2c2360562c2360512d2328502c3328512c4360552c3338512c3324595c224324502c5360502c2338512d5324512c53602a2c3360542c2360502e2328502c3328512c4360555c224324502c3360502c2328502c6048512c2328502c2324502c332c552d233c522c5340592c6048512c2360502c2360562d5328532e2344505c224360522e2360502c2329463c4048502c4344502c2360523947282a2c2360582c2360502c5344572e6048512c2338502c2360572d2344572d5c2258502c6048512c3330502c2360562c4360512d4360515c224360502e3360502c2329463c4048502c4330502c4330583635314f2d245d4e3d27212f3a4424573857494f3e44554a3b5645393b34345436453d323a245d273237492e3526514c3636492e3a2455243b26413a3525255a333329293e3455373133252f3524494933353d393a345c523a53392d3527315a3356494b2d44454b3e24293635445934345534553425392332333d4135265d5933532d2d2d445534303339293a5549593d53394c3a573c563b274541355455493353294b2d44555a3d27492f3a462c56323649252d3455343637452e352545493353294b2d4459243d27492f3a463c56323649253d55255a3233312e35252452323649543c245d4a35333d433e465c50335645293e245d2430373d293a473150335649392d562d5a3b53312f3a3445583334352d3e345d243533212e3a3444573835314f2c545c533333392d35243456323655583d46292530472d422c473d55363328593d24454a3d23442a2c232c502c2360512c36514f3b24214c3b56504e38565d4d5c224360512d4360502c232d333454502a2c2360572c2360502c4360525c224360532d5360502c3334522c333c4e2c3360582b4328532d3258512c333c2a2c232c582c2360522e332450305328582d3330563754512135352d333234592f35255d263c4c2e49392c2e493c4645435c224360542c2360502c333121353531283355293f3054253035253532313048502c5344502c2360512c6048512c2344502c2360522d24302a2c3324502c2360502c33242a2c3324512c2360502c4360505c224324522c4360502c2324595c224324522c5360502c2324505c22406060b5012fffd19d0fd3");

		/* Path files construction */
		$this->pathfile = 'pathfile=/var/www/vhosts/'.$this->domain.'/httpdocs/bsmarty/vendors/xpay/atos/pathfile';
		$this->path_bin = '/var/www/vhosts/'.$this->domain.'/cgi-bin/response';
		$this->log = '/var/www/vhosts/'.$this->domain.'/httpdocs/bsmarty/vendors/xpay/atos/log/log_'.date('Ymd').'.txt';


		/* All steps for execution */
		$this->exec($message); // Calling the binary and fill the $checkout array
		if($this->log()){ // Creating log entries and check for errors
			// No errors
			$this->mail(); // Sending email to the customer
			$this->update_db(); // Update the database with infos
		}

	}

	/**
	 * Exec
	 * Execute the binary and fill the $checkout array
	 * @param string $message Contain post data from the server
	 */
	public function exec($message){
		// debug('Request.php - Render method - Before binaries execution.'); die();
		$result = exec($this->path_bin.' '.$this->pathfile.' '.$message);

		/* Explode the fields */
		$tab = explode ("!", $result);

		$this->checkout['code']                = $tab[1];
		$this->checkout['error']               = $tab[2];
		$this->checkout['merchant_id']         = $tab[3];
		$this->checkout['merchant_country']    = $tab[4];
		$this->checkout['amount']              = $tab[5];
		$this->checkout['transaction_id']      = $tab[6];
		$this->checkout['payment_means']       = $tab[7];
		$this->checkout['transmission_date']   = $tab[8];
		$this->checkout['payment_time']        = $tab[9];
		$this->checkout['payment_date']        = $tab[10];
		$this->checkout['response_code']       = $tab[11];
		$this->checkout['payment_certificate'] = $tab[12];
		$this->checkout['authorisation_id']    = $tab[13];
		$this->checkout['currency_code']       = $tab[14];
		$this->checkout['card_number']         = $tab[15];
		$this->checkout['cvv_flag']            = $tab[16];
		$this->checkout['cvv_response_code']   = $tab[17];
		$this->checkout['bank_response_code']  = $tab[18];
		$this->checkout['complementary_code']  = $tab[19];
		$this->checkout['complementary_info']  = $tab[20];
		$this->checkout['return_context']      = $tab[21];
		$this->checkout['caddie']              = $tab[22];
		$this->checkout['receipt_complement']  = $tab[23];
		$this->checkout['merchant_language']   = $tab[24];
		$this->checkout['language']            = $tab[25];
		$this->checkout['customer_id']         = $tab[26];
		$this->checkout['order_id']            = $tab[27];
		$this->checkout['customer_email']      = $tab[28];
		$this->checkout['customer_ip_address'] = $tab[29];
		$this->checkout['capture_day']         = $tab[30];
		$this->checkout['capture_mode']        = $tab[31];
		$this->checkout['data']                = $tab[32];
		$this->checkout['arrayCaddie']         = $this->unserializer($this->checkout['caddie']);
	}

	/**
	 * Log
	 * Create the log entries
	 */
	public function log(){
		/* Open the file */
		$logfile = fopen($this->log, "a");

		$check = false;
		/* Check if errors exists */
		if(($this->checkout['code'] == "") AND ($this->checkout['error'] == "")){
			fwrite($logfile, "#======= ".date("d/m/Y H:i:s")." ========#\n");
			fwrite($logfile, "ERROR calling response\n");
			fwrite($logfile, "Exec \"response\" not found : $this->path_bin\n");
			fwrite($logfile, "-------------------------------------------\n");
		}elseif($this->checkout['code'] != 0){
			fwrite($logfile, "#======= ".date("d/m/Y H:i:s")." ========#\n");
			fwrite($logfile, "ERROR calling paiement API.\n");
			fwrite($logfile, "Message : ".$this->checkout['error']."\n");
			fwrite($logfile, "-------------------------------------------\n");
		}else{ // No errors
			$check = true; // Check is good

			fwrite($logfile, "#======================== ".date("d/m/Y H:i:s")." ====================#\n");
			fwrite($logfile, "merchant_id : ".$this->checkout['merchant_id']."\n");
			fwrite($logfile, "merchant_country : ".$this->checkout['merchant_country']."\n");
			fwrite($logfile, "amount : ".$this->checkout['amount']."\n");
			fwrite($logfile, "transaction_id : ".$checkout['transaction_id']."\n");
			fwrite($logfile, "transmission_date: ".$this->checkout['transmission_date']."\n");
			fwrite($logfile, "payment_means: ".$this->checkout['payment_means']."\n");
			fwrite($logfile, "payment_time : ".$this->checkout['payment_time']."\n");
			fwrite($logfile, "payment_date : ".$this->checkout['payment_date']."\n");
			fwrite($logfile, "response_code : ".$this->checkout['response_code']."\n");
			fwrite($logfile, "payment_certificate : ".$this->checkout['payment_certificate']."\n");
			fwrite($logfile, "authorisation_id : ".$this->checkout['authorisation_id']."\n");
			fwrite($logfile, "currency_code : ".$this->checkout['currency_code']."\n");
			fwrite($logfile, "card_number : ".$this->checkout['card_number']."\n");
			fwrite($logfile, "cvv_flag: ".$this->checkout['cvv_flag']."\n");
			fwrite($logfile, "cvv_response_code: ".$this->checkout['cvv_response_code']."\n");
			fwrite($logfile, "bank_response_code: ".$this->checkout['bank_response_code']."\n");
			fwrite($logfile, "complementary_code: ".$this->checkout['complementary_code']."\n");
			fwrite($logfile, "complementary_info: ".$this->checkout['complementary_info']."\n");
			fwrite($logfile, "return_context: ".$this->checkout['return_context']."\n");
			
			//ici on dépiote le caddie
			fwrite($logfile, "caddie : \n");
			fwrite($logfile, "----------- \n");

			for($i = 0 ; $i < count($this->checkout['arrayCaddie']); $i++){
				fwrite($logfile, $this->checkout['arrayCaddie'][$i]."\n");
			}
			fwrite($logfile, "-------------------------------- \n");

			fwrite($logfile, "receipt_complement: ".$this->checkout['receipt_complement']."\n");
			fwrite($logfile, "merchant_language: ".$this->checkout['merchant_language']."\n");
			fwrite($logfile, "language: ".$this->checkout['language']."\n");
			fwrite($logfile, "customer_id: ".$this->checkout['customer_id']."\n");
			fwrite($logfile, "order_id: ".$this->checkout['order_id']."\n");
			fwrite($logfile, "customer_email: ".$this->checkout['customer_email']."\n");
			fwrite($logfile, "customer_ip_address: ".$this->checkout['customer_ip_address']."\n");
			fwrite($logfile, "capture_day: ".$this->checkout['capture_day']."\n");
			fwrite($logfile, "capture_mode: ".$this->checkout['capture_mode']."\n");
			fwrite($logfile, "data: ".$this->checkout['data']."\n");
			fwrite($logfile, "---------------------------------------------------------\n\n");

		}

		/* Close de file */
		fclose($logfile);

		return $check;
	}

	/**
	 * Mail
	 * Send confirmation email to the customer
	 */
	public function mail(){

		// Check if payment is successfull
		if($this->checkout['bank_response_code'] == "00"){

			//Date (ymd) / Heure (His) de paiement en français
			$DatePay = substr($this->checkout['payment_date'], 6, 2)."/".substr($this->checkout['payment_date'], 4, 2)."/".substr($this->checkout['payment_date'], 0, 4) ;

			$HeurePay = substr($this->checkout['payment_time'], 0, 2)."h ".substr($this->checkout['payment_time'], 2, 2).":".substr($this->checkout['payment_time'], 4, 2) ;

			//Le reçu de la transaction que nous allons envoyer pour confirmation
			$subject = "Online paiement confirmation [".$this->domain."]";
			
			$body = "Hi,\n\n";

			$body .= "Your paiment is accepted! Thank you!.\n\n";
			
			$body .= "The paiement refer to ".$this->merchant_name." (Merchant ID : ".$this->merchant_id.").\n\n";
			
			$body .= "Transaction ID          : ".$this->checkout['arrayCaddie'][4]."\n";
			$body .= "Transaction amount      : ".substr($this->checkout['amount'],0,-2).",".substr($this->checkout['amount'] ,-2)."EUR\n";
			$body .= "Transaction date        : ".$DatePay." à ".$HeurePay."\n";
			$body .= "Credit card number      : ".$this->checkout['card_number']."\n";
			$body .= "Authorization number    : ".$this->checkout['authorisation_id']."\n";
			$body .= "Transaction certificate : ".$this->checkout['payment_certificate']."\n";
			$body .= "Terminal ID             : XXXXXXXXXXXXXXX\n";
			$body .= "Email                   : ".$this->checkout['arrayCaddie'][7]. "\n\n";
			
			$body .= "If you have some questions, please contact ".$this->merchant_name.".\n\n";
			
			$body .= "Thank you for your confidence,\n\n";
			
			$body .= "L'Equipe de ".$this->merchant_name.".\n\n";
			
			$body .= "***************************************************\n";
			$body .= "ATTENTION !\n";
			$body .= "This email was sent from an address that can not receive response.\n";
			$body .= "Thanks to using facturation@".$this->domain." to communicate.\n";
			$body .= "***************************************************\n\n\n";
			
			$body .= "***********************************************************************************************\n";
			$body .= "This message and any attachments are confidential and intended for the named addressee(s) only.\n";
			$body .= "If you have received this message in error, please notify immediately the sender, then delete\n";
			$body .= "the message. Any unauthorized modification, edition, use or dissemination is prohibited.\n";
			$body .= "The sender shall not be liable for this message if it has been modified, altered, falsified, infected\n";
			$body .= "by a virus or even edited or disseminated without authorization.\n";
			$body .= "***********************************************************************************************";


			//Envoi du message au client
			mail($this->checkout['arrayCaddie'][7], $subject, $body, 'From: facturation@'.$this->domain);

			//On en profite pour s'envoyer également le reçu
			//mail('flaussinot@groupeforum.net' , $subject, $body, 'From: contact@pathonevers.com');
		}
	}

	/**
	 * Update DB
	 * Update the database
	 */
	public function update_db(){
		$identfacture = $this->checkout['arrayCaddie'][4];

		$this->table = 'drw'; // Work on the drw table
			parent::__construct(); // Refresh the PDO connection

		/* First: retrieve the ID */
		$drw = $this->findFirst(array(
			'conditions' => array('identfacture' => $identfacture)
			));

		debug($drw);

		/* Second: Update good data */
		$drw->email = $this->checkout['arrayCaddie'][7];
		$drw->mttransaction = $this->checkout['amount'];
		$drw->dattransaction = $this->checkout['payment_date'];
		$drw->heuretransaction = $this->checkout['payment_time'];
		$drw->reftransaction = $this->checkout['transaction_id'];
		$drw->certiftransaction = $this->checkout['payment_certificate'];

		debug($drw);

		$this->save($drw);

		/* Third: insert into backup table */
		$this->table = 'drw_bak'; // Work on the drw table
			parent::__construct(); // Refresh the PDO connection

		$check_entry = $this->findCount(array('identfacture' => $identfacture));
		debug($check_entry);
		if($check_entry == '0'){ // If the entry doesn't exist 
			$drw->id_drw = ''; // It's not an update so ID doesn't exist
			$this->save($drw);
		}


	}

	/**
	 * Unserializer
	 * Unserialize and encode with base64, the var given
	 */
	public function unserializer($var){
		return unserialize(base64_decode($var));
	}
}
