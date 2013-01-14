<?php
/**
 * Send Mail
 * This class sends email, it uses the PHPMailer class
 * https://github.com/Synchro/PHPMailer
 * @package bsmarty\core
 */
class SendMail extends Model {

	/**
	 * Attributes
	 */
	public $mail;
	public $body;
	public $emailTo;
	public $emailFrom;
	public $bs_title;



	/**
	 * Constructor
	 */
	function __construct(){

		parent::__construct(); // Refresh the PDO connection

		/** Get data from db **/
		$this->emailTo = $this->findFirst(array(
			'conditions' => array('slug' => 'emailto'),
			'from' => 'configs'
			))->value;
		$this->emailFrom = $this->findFirst(array(
			'conditions' => array('slug' => 'emailfrom'),
			'from' => 'configs'
			))->value;
		$this->bs_title = $this->findFirst(array(
			'conditions' => array('slug' => 'title'),
			'from' => 'configs'
			))->value;

		/** PHPMailer configuration **/
		$this->mail = new PHPMailer();
		$this->mail->AddReplyTo($this->emailTo, $this->bs_title);
		$this->mail->SetFrom($this->emailFrom, $this->bs_title);
		$this->mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //optional, comment out and test

	}

	/**
	 * Send
	 * Prepare and send the email
	 *
	 * method send(string $message, string $email, string $subject, array attachment)
	 *
	 * @param string $message
	 * @param string $email
	 * @param string $subject
	 * @param array $attachment
	 * @return mixed
	 */
	function send($message, $email, $name, $subject, $attachment=false){
		$this->mail->AddAddress($email, $name);
		$this->mail->Subject = $subject;
		$this->mail->Body    = $message;

		if($attachment){
			foreach($attachment as $file){
				$this->mail->AddAttachment($file);      //attachment	
			}
		}

		/* Sending */
		if(!$this->mail->Send()){
	  		return $this->mail->ErrorInfo;
		}else{
			return true;
		}
		
	}

}