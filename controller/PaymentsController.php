<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class PaymentsController extends Controller{

	/**
	 * Index
	 */
	public function index(){
		
		if ($this->Session->isLogged()) {
			
		} else {
			$this->Flash->create('Paiement en test. Merci de réessayer plus tard.');
			$this->redirect('');
		}

	}

	/**
	 * Form
	 */
	public function form(){
		$this->loadmodel('Payment');

		/* If the first form is completed, check it out */
		if($this->request->data){
			$folder_id = $this->request->data->folderid;
			$name      = $this->request->data->name;
			$email     = $this->request->data->email;

			/* Grab customer's data */
			$d['customer'] = $this->Payment->drw->findFirst(array(
				'conditions' => array('identfacture' => $folder_id, 'nom' => $name)
				));

			/* Date format */
			if(isset($d['customer']->datnaissance)){
				$d['customer']->datnaissance = $this->Payment->setDate($d['customer']->datnaissance, 'FR');	
			}

			/* Insurance key checking */

			

			/* If the customer exists */
			if($d['customer']){

				/* Check if the payment has already be paid */
				$has_paid = $this->Payment->drw_back->findCount(array('nom' => $name, 'identfacture' => $folder_id));

				/* The customer hasn't already paid */
				if($has_paid == '0'){
					/* Add the email */
					$d['customer']->email = $email;

					/* Call the method get_DepAndLabel to have all departments and labels */
					$DepAndLabels = $this->Payment->get_DepAndLabels();

					$d['insurances']['zipcodes'] = $DepAndLabels['zipcodes'];
					$d['insurances']['labels']   = $DepAndLabels['labels'];

					$this->set($d);
				}else{ // The customer has already paid
					$this->Flash->create('Votre paiement a déjà été effectué', 'alert');
					$this->redirect('payments');
				}

			}else{
				$this->Flash->create('Dossier inconnu', 'alert');
				$this->redirect('payments');
			}
		}else{
			$this->Flash->create('Vous devez remplir les champs obligatoires', 'alert');
			$this->redirect('payments');
		}

	}

	/**
	 * Checkout
	 * Checkout process with call request and call response
	 */
	public function checkout(){
		if($this->request->data){
			$this->loadmodel('Payment');
			/* Build variables SESSION */
			$_SESSION['CADDIE_AMOUNT'] = $this->Payment->bank_price($this->request->data->amount); // Use the methode bank_price() to format the price

			$_SESSION['CADDIE_ID']     = $this->request->data->folderid;
			$_SESSION['CLE_PATIENT']   = $this->request->data->customerkey;
			$_SESSION['USER_NOM']      = $this->request->data->name;
			$_SESSION['USER_PRENOM']   = $this->request->data->firstname;
			$_SESSION['USER_EMAIL']    = $this->request->data->email;
			$_SESSION['FOLDER_ID']     = $this->request->data->folderid;
			/* end of varaibles build */
			

			/* Make an update if the two radios buttons are checked and all data completed */
			if($this->request->data->fastpayment == '1' AND $this->request->data->health == '1'){ // Make the update
				if(
					!empty($this->request->data->folderid) AND !empty($this->request->data->birthday) AND 
					!empty($this->request->data->insuranceid) AND !empty($this->request->data->clesecuritesocial) AND
					!empty($this->request->data->insurancelabel) AND !empty($this->request->data->finvaliditedroits) AND 
					!empty($this->request->data->twinrow)
				){
					/* save infos in DB */
					$update = new StdClass;
					$update->identfacture = $this->request->data->folderid;
					$update->datnaissance = $this->Payment->setDate($this->request->data->birthday, "EN");
					$update->nusecu = $this->request->data->insuranceid;
					$update->clenusecu = $this->request->data->clesecuritesocial;
					$update->codecaisse = $this->request->data->insurancelabel;
					$update->datfinvaliditedroit = $this->request->data->finvaliditedroits;
					$update->ranggemelaire = $this->request->data->twinrow;

					$this->Payment->drw->primaryKey = "identfacture";
					$this->Payment->drw->save($update);
					/* end save infos in DB */
				}				
			}
			

			/* Call the request */
			$this->Payment->payment_system = 'atos';
			$this->Payment->load_request();
			$d['html'] = $this->Payment->Request->render();

			$this->set($d);
		}else{
			$this->Flash->create('You have to fill the form before', 'alert');
			$this->redirect('payments');
		}
	}

	/**
	 * Completed
	 * Response process called by the bank's server
	 */
	public function completed(){
		$this->Flash->create('Votre paiement a été accepté');
		$this->redirect('payments');
	}

	/**
	 * Failed
	 */
	public function failed(){
		$this->Flash->create('Votre paiement a été refusé', 'alert');
		$this->redirect('payments');
	}

	/**
	 * Response
	 * Response process called by the bank's server
	 */
	public function response(){
		$this->loadmodel('Payment');
		$this->Payment->payment_system = 'atos';
		// Calling of the Xpay response
		$this->Payment->load_response();

		die();
	}

	/**
	 * Get labels
	 * This is an AJAX call
	 * Get all label from the zipcode given by GET
	 */
	public function get_labels($zipcode){
		$this->loadmodel('Payment');
		$labels = $this->Payment->drw_caisse->find(array(
					'fields' => 'code, libelle',
					'conditions' => array('departement' => $zipcode)
					));

		$d['labels'] = $labels;

		/* This is an ajax call so we use the ajax layout */
		$this->layout = 'ajax';

		$this->set($d);

	}

}