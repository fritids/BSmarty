<?php
/**
 * ThemeShortcode class
 * All shortcode available for the CMS
 * @package bsmarty\model
 */
class ThemeShortcode extends Shortcode {

	/*
	* ------------------------------------------------- *
	*		Tabular Content
	* ------------------------------------------------- *
	*/
	function tabulars($atts, $content = null ) {
		// [tabs align="" tab1="" tab2="" tab3=""][/tabs]

		$tabs = "";
		$content = $this->do_shortcode($content);	
		$content = $this->fixshortcode($content);
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content)); 

		unset($atts['align']);

	    for($i=1;$i<count($atts)+1;$i++){
	        $tab_name = $atts['tab'.$i];
	        if($tab_name){
	        	if($i == 1){
	        		$tabs .=   '<dd class="active"><a href="#tab'.$i.'">'.$tab_name.'</a></dd>';
	        	}else{
	        		$tabs .=   '<dd><a href="#tab'.$i.'">'.$tab_name.'</a></dd>';	
	        	}
	        }
	    }

		return '<div class="tabular-content"><dl class="tabs contained">'.$tabs.'</dl><ul class="tabs-content contained">'.$this->do_shortcode($content).'</ul></div>';
	}

	function tab($atts, $content = null ) {
		//[tab id="tab1"][/tab]
	    $content = $this->do_shortcode($content);	
		$content = $this->fixshortcode($content);
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content)); 
		
		$html = ' <li id="'.$atts['id'].'Tab" >'.$this->do_shortcode($content).'</li>';
		
		return $html;
	}

	/*
	* ------------------------------------------------- *
	*		Accordions
	* ------------------------------------------------- *
	*/
	function accordion($atts, $content = null) {
	    //[accordion][/accordion]

		$moreClass = '';
	    if(isset($atts['class'])){
	    	$moreClass = $atts['class'];
	    }
	   
	    //fix shortcode
	    $content = $this->do_shortcode($content);	
	    $content = $this->fixshortcode($content);
	    $content = preg_replace('#<br \/>#', "",trim($content));
	    $content = preg_replace('#<p>#', "",trim($content));
	    $content = preg_replace('#<\/p>#', "",trim($content)); 
	    
	    return '<ul class="accordion '.$moreClass.'">'.$this->do_shortcode($content).'</ul>';
	}

	function accordion_panel($atts, $content = null) {
		//[pane title="" active][/pane]

		
	    $activeClass = '';
	    if(isset($atts['0']) AND $atts['0'] == 'active'){
	    	$activeClass = ' class="active"';
	    }

	    $pane_title = $atts['title'];
		
	    //fix shortcode
	    $content = $this->do_shortcode($content);	
	    $content = $this->fixshortcode($content);
	    $content = preg_replace('#<br \/>#', "",trim($content));
	    $content = preg_replace('#<p>#', "",trim($content));
	    $content = preg_replace('#<\/p>#', "",trim($content)); 

	    
	    return '<li'.$activeClass.'><div class="title"><h5>'.$pane_title.'</h5></div><div class="content">'.$this->do_shortcode($content).'</div></li>';
	}

	/*
	* ------------------------------------------------- *
	*		Slider
	* ------------------------------------------------- *
	*/
	function slider($atts, $content = null) {
		//[slider][/slider]

		//fix content
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content));
		
	 	$content = $this->do_shortcode($content);
		$content = $this->fixshortcode($content);

		return '<div class="featured">'.$this->do_shortcode($content).'</div>';
	}

	function slide($atts, $content = null) {
	 	//[slide image_width="" image_height="" link="" alt_text="" title="" auto_resize="true"]

		//defaults
		extract($this->shortcode_atts(array(  
	       "image_width" => '940',
		   "image_height" => '246',
		   "link" => '#',
		   "alt_text" => 'slider image',
		   "title" => ''   
		), $atts));

		//width and height
		if($image_width  == "")  $image_width = "940";
		if($image_height == "") $image_height = "246";

		//fix content
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content));
		$content = preg_replace('#<span class="url">#', "",trim($content));
		$content = preg_replace('#</span>#', "",trim($content));
	 
		if($link){
			$linkStart='<a href="'.$link.'">';
			$linkEnd='</a>';
		}

		$slide = $linkStart.'<img src="'.$content.'"  alt="'.$alt_text.'" width="'.$image_width.'" height="'.$image_height.'" title="'.$title.'">'.$linkEnd;

		return $slide;
	}

	/*
	* ------------------------------------------------- *
	*		Table
	* ------------------------------------------------- *
	*/
	function table($atts, $content = null ) {
		// [table col1="Title 1" col2="Title 2" col3="Title 3"]

		$cols = "";
		$content = $this->do_shortcode($content);	
		$content = $this->fixshortcode($content);
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content)); 

	    for($i=1;$i<count($atts)+1;$i++){
	        $col_name = $atts['col'.$i];
	        if($col_name){
	        	$cols .=   '<th>'.$col_name.'</th>';
	        }
	    }

		return '<table class="bordered-table zebra-striped tablesort"><thead><tr>'.$cols.'</tr></thead><tbody>'.$this->do_shortcode($content).'</tbody></table>';
	}

	function line($atts, $content = null) {
	 	// [line][/line]

		//fix content
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content));
		$content = preg_replace('#<span class="url">#', "",trim($content));
		$content = preg_replace('#</span>#', "",trim($content));

		return '<tr>'.$this->do_shortcode($content).'</tr>';
	}

	function col($atts, $content = null) {
	 	// [col][/col]

		//fix content
		$content = preg_replace('#<br \/>#', "",trim($content));
		$content = preg_replace('#<p>#', "",trim($content));
		$content = preg_replace('#<\/p>#', "",trim($content));
		$content = preg_replace('#<span class="url">#', "",trim($content));
		$content = preg_replace('#</span>#', "",trim($content));

		return '<td>'.$this->do_shortcode($content).'</td>';
	}

}
