<?php

/**
 * Donwload file class
 * Manage all process of downloading files.
 * @package bsmarty\model
 */
class Download_file extends Model {
	
	/* Attributes */
	public $allowed_types = array(
		'image'        => array('image/png', 'image/jpeg', 'image/gif', 'x-png'),
		'pdf'          => array('application/pdf'),
		'archive'      => array('application/zip'),
		'text'         => array('text/plain'),
		'video'        => array('video/x-msvideo', 'video/quicktime', 'video/mpeg'),
		'csv'          => array('text/comma-separated-values'),
		'word'         => array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword'),
		'presentation' => array('application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint')
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
