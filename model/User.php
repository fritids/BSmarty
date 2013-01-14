<?php

/**
 * User
 * This class manage users.
 * @package bsmarty\model
 */
class User extends Model {

	/**
	 * Add some rules to the user's register form
	 * This is an array composed of two argument:
	 * - rule    : accepts 'noEmpty' and regex
	 * - message : accepts HTML content
	 */
	var $validates = array(
		'login' => array(
			'rule' => 'notEmpty',
			'message' => 'Login can not be empty'
		),
		'email' => array(
			'rule' => '(^[a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$',
			'message' => "Email has to be a valid email"
		),
		'password' => array(
			'rule' => '^[a-zA-Z0-9_-]{6,18}$',
			'message' => 'Your password has to be composed of 6 or 18 letters and/or digits'
		),
		'password_confirm' => array(
			'rule' => '^[a-zA-Z0-9_-]{6,18}$',
			'message' => 'Your password has to be composed of 6 or 18 letters and/or digits'
		)
	);

	/**
	 * Is Admin
	 * Check is the current logged user is an admin or not.
	 * Return TRUE is the user is an admin, FALSE if not.
	 * This function use the User bject stored in $_SESSION
	 * @return boolean
	 */
	static function is_admin(){
		if($_SESSION['User']->role == 'admin'){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	/**
	 * Send Mail
	 * Format the mail, construct the message and return html and send it
	 */
	public function sendMail($user, $subject, $site_url, $template="new_user"){
		/* Get data from db */
		$bs_to = $this->findFirst(array(
			'conditions' => array('slug' => 'emailto'),
			'from' => 'configs'
			))->value;
		$bs_from = $this->findFirst(array(
			'conditions' => array('slug' => 'emailfrom'),
			'from' => 'configs'
			))->value;
		$bs_title = $this->findFirst(array(
			'conditions' => array('slug' => 'title'),
			'from' => 'configs'
			))->value;

		/* Setting vars */
		$email['keys']['date'] = date("d/m/Y : H:i:s");
		$email['keys']['firstname'] = $user->firstname;
		$email['keys']['lastname'] = $user->name;
		$email['keys']['filename'] = $filename;
		$email['keys']['site_url'] = $site_url;

		/* Loading the temaplate */
		$email['template'] = file_get_contents(ROOT.DS.'vendors'.DS.'email_templates'.DS.$template.'.php');

		$email['body'] = $email['template'];
		/* Template variables injection */
		foreach($email['keys'] as $key=>$val){
			$email['body'] = str_replace('{{'.$key.'}}', $val, $email['body']);
		}

		/* Build the headers */
		$email['headers']   = array();
		$email['headers'][] = "MIME-Version: 1.0";
		$email['headers'][] = "Content-type: text/html; charset=utf-8";
		$email['headers'][] = "From: ".$bs_title." <".$bs_from.">";
		$email['headers'][] = "Reply-To: ".$bs_title." <".$bs_from.">";
		$email['headers'][] = "Subject: ".$subject;
		$email['headers'][] = "X-Mailer: PHP/".phpversion();



		return mail($bs_to, $subject, $email['body'], implode("\r\n", $email['headers']));
	}

}