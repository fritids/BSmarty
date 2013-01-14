<?php

/**
 * Contact class
 * Manage contact form and page.
 * @package bsmarty\model
 */
class Contact extends Model {
	
	/** Attributes **/
	public $validates = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un nom'
		),
		'email' => array(
			'rule' => "([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})",
			'message' => "L'email n'est pas valide"
		),
		'subject' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un sujet'
		),
		'message' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un message'
		)
	);


	/**
	* Fonction réalisant l'envoi de l'email vers l'adresse email enregistrée dans le CMS.
	* @param array $informations
	* @param string $from
	* @param string $to
	* @return boelan
	**/
	public function send($informations, $from, $to){
		$mail = '<div style="font-family : arial; font-size : 12px;">Demande de contact : 
						<br /> 
						<p>Demande réalisée par : <strong>'.$informations->nom.'</strong>.
						<br />
						Contacter cette personne : <strong>'.$informations->mail.'</strong><br />';
		$mail .=  "Objet : <strong>".$informations->subject."</strong></p>";
		$mail .= '<div style="font-weight :bold; color : #003366; font-size : 14px;"><p>'.$informations->message.'</p></div>';
		
		$codehtml = "<html><body>".$mail."</body></html>";
		
		$headers  = "MIME-Version: 1.0\n";
		$headers .= "X-Sender: <".$from.">\n";
		$headers .= "Return-path: <".$from.">\n";
		$headers .= "X-MAILER: PHP\n";
		$headers .= "X-auth-smtp-user: ".$from."\n";
		$headers .= "X-abuse-contact: ".$from."\n";
		$headers .= "Reply-to: <".$from.">\n";
		$headers .= "From: <".$from.">\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "Content-Transfert-Encoding: 7bit\n";
		
		if(mail($to, 'Nouvelle demande de contact', $codehtml, $headers)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}