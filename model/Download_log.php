<?php

/**
 * Download log class
 * Manage all process of download logs.
 * @package bsmarty\model
 */
class Download_log extends Model {

	/**
	 * Send Mail
	 * Format the mail, construct the message and return html and send it
	 */
	public function sendMail($user, $filename, $subject, $site_url, $template="download_confirmation"){
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