<?php

/**
 * Media class
 * Manage all process of media stuff.
 * @package bsmarty\model
 */
class Media extends Model {

	/* Attributes */
	var $allowed_types = array(
		'image'   => array('image/pjpeg', 'image/jpeg', 'image/gif', 'x-png'),
		'pdf'     => array('application/pdf'),
		'archive' => array('application/zip'),
		'text'    => array('text/plain'),
		'video'   => array('video/x-msvideo', 'video/quicktime', 'video/mpeg'),
		'csv'     => array('text/comma-separated-values'),
		'word'    => array('vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword')
	);

	/**
	 * File Check
	 * Check the file if it is allowed for upload
	 * @param string
	 * @return string|boolean
	 */
	public function fileCheck($mime){
		foreach($this->allowed_types as $key=>$val){
			foreach($val as $allowed){
				if($allowed === $mime) return $key;
			}
		}

		return FALSE;
	}

}
