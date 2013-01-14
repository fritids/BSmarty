<?php

/**
 * Post class
 * Manage all posts
 * @package bsmarty\model
 */
class Post extends Model {
	
	/**
	 * Add some rules to the user's register form
	 * This is an array composed of two argument:
	 * - rule    : accepts 'noEmpty' and regex
	 * - message : accepts HTML content
	 */
	var $validates = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have to give a title'
		),
		'slug' => array(
			'rule' => '([a-z0-9\-]+)',
			'message' => "The slug isn't valid"
		)
	);


	/**
	 * @todo Complete the function
	 */
	function excerpt($posts, $length=250, $trailing="...") {
		
		$length -= mb_strlen($trailing);

		foreach($posts as $k){

			/* Search a [MORE] tag first, if not then cut the text */
			if(preg_match('<!--more-->', $k->content)){
				$k->excerpt = explode('<!--more-->', $k->content)[0];
			}else{
				if(mb_strlen($k->content)> $length){
					// string exceeded length, truncate and add trailing dots
					$k->excerpt = mb_substr($k->content,0,$length).$trailing;
				}else{
					$k->excerpt = $k->content;
				}
			}
		}

		return ;
	}

	/**
	 * Check Slug
	 * Check in the databse if the slug guiven already exists
	 * @param string $slug
	 * @return int 
	 */
	public function checkSlug($slug, $id=false){
		if($id){
			$end_condition = ' AND id!="'.$id.'"';
		}else{
			$end_condition = '';
		}
		return $this->findCount('slug="'.$slug.'"'.$end_condition);
	}

	/**
	 * The editor
	 * Initialize the TinyMCE editor correctly
	 * @return mixed HTML/JS
	 */
	public function the_editor(){

		/* Generating the output */
		$output = '<script type="text/javascript" src="'.Router::webroot('js/tinymce/tiny_mce.js').'"></script>';
		$output .= '<script type="text/javascript">';
			// TinyMCE init
			$output .= 'tinyMCE.init({
				';
				// General options
				$output .= 'mode : "specific_textareas",
				';
				$output .= 'editor_selector: "wysiwyg",
				';
				$output .= 'theme : "advanced",
				';
				$output .= 'content_css : "'.Router::webroot('css/the_editor.css').'",
				';
				$output .= 'relative_urls : false,
				';
				$output .= 'plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,shortcodes",
				';

				// Theme options
				$output .= 'theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,image,|,code,|,BS-readmore,|, BS-layouts, BS-Sbuttons, BS-Sslider, BS-Saccordion, |",// BS-Stooltip, |",
				';
				$output .= 'theme_advanced_buttons2 : "",
				';
				$output .= 'theme_advanced_buttons3 : "",
				';
				$output .= 'theme_advanced_buttons4 : "",
				';
				$output .= 'theme_advanced_toolbar_location : "top",
				';
				$output .= 'theme_advanced_toolbar_align : "left",
				';
				$output .= 'theme_advanced_statusbar_location : "bottom",
				';
				$output .= 'theme_advanced_resizing : true
				';

			$output .= '});';
		$output .= '</script>';


		return $output;
	}


}

?>