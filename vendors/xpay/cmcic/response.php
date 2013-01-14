<?php

class Response extends Model {

	/* Attributes */
	public $cgi2_fields;
	private $receipt;


	/**
	 * Construct
	 */
	public function __construct(){
		/**
		 * TPE Settings
		 * Warning !! CMCIC_Config contains the key, you have to protect this file with all the mechanism available in your development environment.
		 * You may for instance put this file in another directory and/or change its name. If so, don't forget to adapt the include path below.
		 */
		//require_once("./xpay/CMCIC_Config.php");
		require_once ROOT.DS.'vendors'.DS.'xpay'.DS.'cmcic'.DS.'CMCIC_Config.php';

		// PHP implementation of RFC2104 hmac sha1 ---
		//require_once("./xpay/CMCIC_Tpe.inc.php");
		require_once ROOT.DS.'vendors'.DS.'xpay'.DS.'cmcic'.DS.'CMCIC_Tpe.inc.php';

	}

	/**
	 * Make Log
	 * Generate the log
	 */
	public function makeLog(){

		/* Headers config for text logs */
		header("Pragma: no-cache");
		header("Content-type: text/plain");

		// Begin Main : Retrieve Variables posted by CMCIC Payment Server 
		$CMCIC_bruteVars = getMethode();

		// TPE init variables
		$oTpe = new CMCIC_Tpe();
		$oHmac = new CMCIC_Hmac($oTpe);

		// Message Authentication
		$this->cgi2_fields = sprintf(CMCIC_CGI2_FIELDS, $oTpe->sNumero,
							  $CMCIC_bruteVars["date"],
						      $CMCIC_bruteVars['montant'],
						      $CMCIC_bruteVars['reference'],
						      $CMCIC_bruteVars['texte-libre'],
						      $oTpe->sVersion,
						      $CMCIC_bruteVars['code-retour'],
							  $CMCIC_bruteVars['cvx'],
							  $CMCIC_bruteVars['vld'],
							  $CMCIC_bruteVars['brand'],
							  $CMCIC_bruteVars['status3ds'],
							  $CMCIC_bruteVars['numauto'],
							  $CMCIC_bruteVars['motifrefus'],
							  $CMCIC_bruteVars['originecb'],
							  $CMCIC_bruteVars['bincb'],
							  $CMCIC_bruteVars['hpancb'],
							  $CMCIC_bruteVars['ipclient'],
							  $CMCIC_bruteVars['originetr'],
							  $CMCIC_bruteVars['veres'],
							  $CMCIC_bruteVars['pares']
							);

		if ($oHmac->computeHmac($this->cgi2_fields) == strtolower($CMCIC_bruteVars['MAC'])){
			switch($CMCIC_bruteVars['code-retour']) {
				case "Annulation" :
					// Payment has been refused
					// put your code here (email sending / Database update)
					// Attention : an autorization may still be delivered for this payment
					break;

				case "payetest":
					// Payment has been accepeted on the test server
					// put your code here (email sending / Database update)
					
					// Recupere les donnees du texte libre
					list($identfacture,$cle_patient,$user_nom,$user_prenom,$user_ip,$user_email) = explode("_",$CMCIC_bruteVars['texte-libre']);
					$logfile = ROOT.DS.'vendors'.DS.'xpay'.DS.'cmcic'.DS.'log'.DS.'log_'.date(Ymd).".txt";

					$fp = fopen($logfile, "a");
					fwrite( $fp, "#======================== Le : " . date("d/m/Y H:i:s") . " ====================#\n");
					fwrite( $fp, "date : ".$CMCIC_bruteVars["date"]."\n");
					fwrite( $fp, "montant : ".$CMCIC_bruteVars['montant']."\n");
					fwrite( $fp, "reference : ".$CMCIC_bruteVars['reference']."\n");
					fwrite( $fp, "texte-libre : ".$CMCIC_bruteVars['texte-libre']."\n");
					fwrite( $fp, "Version : ".$oTpe->sVersion."\n");
					fwrite( $fp, "code-retour : ".$CMCIC_bruteVars['code-retour']."\n");
					fwrite( $fp, "cvx :".$CMCIC_bruteVars['cvx']."\n");
					fwrite( $fp, "vld : ".$CMCIC_bruteVars['vld']."\n");
					fwrite( $fp, "brand : ".$CMCIC_bruteVars['brand']."\n");
					fwrite( $fp, "status3ds : ".$CMCIC_bruteVars['status3ds']."\n");
					fwrite( $fp, "numauto : ".$CMCIC_bruteVars['numauto']."\n");
					fwrite( $fp, "motifrefus : ".$CMCIC_bruteVars['motifrefus']."\n");
					fwrite( $fp, "originecb : ".$CMCIC_bruteVars['originecb']."\n");
					fwrite( $fp, "bincb : ".$CMCIC_bruteVars['bincb']."\n");
					fwrite( $fp, "hpancb : ".$CMCIC_bruteVars['hpancb']."\n");
					//fwrite( $fp, "ipclient : ".$CMCIC_bruteVars['ipclient']."\n");
					fwrite( $fp, "ipclient : ".$user_ip."\n");
					fwrite( $fp, "originetr : ".$CMCIC_bruteVars['originetr']."\n");
					fwrite( $fp, "veres : ".$CMCIC_bruteVars['veres']."\n");
					fwrite( $fp, "pares : ".$CMCIC_bruteVars['pares']."\n");
					fclose($fp);
					
					$mttransaction = substr($CMCIC_bruteVars['montant'],0,-3);
					$dattransaction = substr($CMCIC_bruteVars["date"],6,4);
					$dattransaction .= substr($CMCIC_bruteVars["date"],3,2);
					$dattransaction .= substr($CMCIC_bruteVars["date"],0,2);
					
					$heuretransaction = substr($CMCIC_bruteVars["date"],-8);
					$heuretransaction = str_replace (":","",$heuretransaction);
					
					//$id_dossier = drwtow ($user_nom,$identfacture,$mttransaction,$dattransaction,$heuretransaction,$CMCIC_bruteVars['reference'],$CMCIC_bruteVars['reference'],$numerolabo);
					drwtow ($identfacture,$mttransaction,$dattransaction,$heuretransaction,$CMCIC_bruteVars['numauto'],$CMCIC_bruteVars['reference'],$numerolabo,$user_email);
					
					break;

				case "paiement":
					// Payment has been accepted on the productive server
					// put your code here (email sending / Database update)
					// Recupere les donnees du texte libre
					list($identfacture,$cle_patient,$user_nom,$user_prenom,$user_ip,$user_email) = explode("_",$CMCIC_bruteVars['texte-libre']);
					$logfile = $chemin_ori."xpay/log/log_".date(Ymd).".txt";

					$fp = fopen($logfile, "a");
					fwrite( $fp, "#======================== Le : " . date("d/m/Y H:i:s") . " ====================#\n");
					fwrite( $fp, "date : ".$CMCIC_bruteVars["date"]."\n");
					fwrite( $fp, "montant : ".$CMCIC_bruteVars['montant']."\n");
					fwrite( $fp, "reference : ".$CMCIC_bruteVars['reference']."\n");
					fwrite( $fp, "texte-libre : ".$CMCIC_bruteVars['texte-libre']."\n");
					fwrite( $fp, "Version : ".$oTpe->sVersion."\n");
					fwrite( $fp, "code-retour : ".$CMCIC_bruteVars['code-retour']."\n");
					fwrite( $fp, "cvx :".$CMCIC_bruteVars['cvx']."\n");
					fwrite( $fp, "vld : ".$CMCIC_bruteVars['vld']."\n");
					fwrite( $fp, "brand : ".$CMCIC_bruteVars['brand']."\n");
					fwrite( $fp, "status3ds : ".$CMCIC_bruteVars['status3ds']."\n");
					fwrite( $fp, "numauto : ".$CMCIC_bruteVars['numauto']."\n");
					fwrite( $fp, "motifrefus : ".$CMCIC_bruteVars['motifrefus']."\n");
					fwrite( $fp, "originecb : ".$CMCIC_bruteVars['originecb']."\n");
					fwrite( $fp, "bincb : ".$CMCIC_bruteVars['bincb']."\n");
					fwrite( $fp, "hpancb : ".$CMCIC_bruteVars['hpancb']."\n");
					//fwrite( $fp, "ipclient : ".$CMCIC_bruteVars['ipclient']."\n");
					fwrite( $fp, "ipclient : ".$user_ip."\n");
					fwrite( $fp, "originetr : ".$CMCIC_bruteVars['originetr']."\n");
					fwrite( $fp, "veres : ".$CMCIC_bruteVars['veres']."\n");
					fwrite( $fp, "pares : ".$CMCIC_bruteVars['pares']."\n");
					fclose($fp);
					
					$mttransaction = substr($CMCIC_bruteVars['montant'],0,-3);
					$dattransaction = substr($CMCIC_bruteVars["date"],6,4);
					$dattransaction .= substr($CMCIC_bruteVars["date"],3,2);
					$dattransaction .= substr($CMCIC_bruteVars["date"],0,2);
					
					$heuretransaction = substr($CMCIC_bruteVars["date"],-8);
					$heuretransaction = str_replace (":","",$heuretransaction);
					
					//drwtow ($user_nom,$identfacture,$mttransaction,$dattransaction,$heuretransaction,$CMCIC_bruteVars['numauto'],$CMCIC_bruteVars['reference'],$numerolabo);
					drwtow ($identfacture,$mttransaction,$dattransaction,$heuretransaction,$CMCIC_bruteVars['numauto'],$CMCIC_bruteVars['reference'],$numerolabo,$user_email);
				
					break;


				/*** ONLY FOR MULTIPART PAYMENT ***/
				case "paiement_pf2":
				case "paiement_pf3":
				case "paiement_pf4":
					// Payment has been accepted on the productive server for the part #N
					// return code is like paiement_pf[#N]
					// put your code here (email sending / Database update)
					// You have the amount of the payment part in $CMCIC_bruteVars['montantech']
					break;

				case "Annulation_pf2":
				case "Annulation_pf3":
				case "Annulation_pf4":
					// Payment has been refused on the productive server for the part #N
					// return code is like Annulation_pf[#N]
					// put your code here (email sending / Database update)
					// You have the amount of the payment part in $CMCIC_bruteVars['montantech']
					break;
					
			}

			$this->receipt = CMCIC_CGI2_MACOK;

		}else{
			// your code if the HMAC doesn't match
			$this->receipt = CMCIC_CGI2_MACNOTOK.$this->cgi2_fields;
		}


		//-----------------------------------------------------------------------------
		// Send receipt to CMCIC server
		//-----------------------------------------------------------------------------
		printf (CMCIC_CGI2_RECEIPT, $this->receipt);

		// Copyright (c) 2009 Euro-Information ( mailto:centrecom@e-i.com )
		// All rights reserved. ---


	}
}