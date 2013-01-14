<?php

/**
 * Form class
 * This class can manage and display form inputs.
 * There are multiple types available.
 * @package bsmarty\core
 */
class Form{
	
	public $controller;
	public $errors;

	/**
	 * Constructor
	 */
	public function __construct($controller){
		$this->controller = $controller;
	}

	/**
	 * Input
	 * Display multipe inputs type and manage errors.
	 *
	 * method input(string $name, string $label, array $options)
	 *
	 * All inputs type available:
	 * - text (default)
	 * - date
	 * - datetime
	 * - email
	 * - url
	 * - tel
	 * - search
	 * - textarea
	 * - file
	 * - checkbox
	 * - password
	 *
	 * @param string $name
	 * @param string $label
	 * @param array $options
	 *
	 */
	public function input($name, $label, $options = array()){
		$error = FALSE;
		$classError = '';
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error';
		}
		if(!isset($this->controller->request->data->$name)){
			$value = '';
			if(isset($options['value']) && !empty($options['value'])){
				$value = $options['value'];
			}
		}else{
			$value = $this->controller->request->data->$name;
		}
		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'" >';
		}

		/* Override value */
		if(isset($options['value'])){
			$value = $options['value'];
		}

		/* Begin the HTML construction */
		$html = '<div class="clearfix'.$classError.'">';

		if($label !== 'none'){
			$html .= '<label for="input-'.$name.'" class="'.$classError.'">'.$label.'</label>';
		}
					
		$html .= '<div class="input">';	
		
		$attr = ' ';
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= "$k=\"$v\" ";
		}}


		if(isset($options['class'])){
			$classError .= ' '. $options['class']; 
		}
		if(!isset($options['type']) OR $options['type'] == 'text'){
			$html .= '<input type="text" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}elseif($options['type'] == 'date'){
			$html .= '<input type="date" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}elseif($options['type'] == 'email'){
			$html .= '<input type="email" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" >';
		}elseif($options['type'] == 'url'){
			$html .= '<input type="url" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}elseif($options['type'] == 'tel'){
			$html .= '<input type="tel" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}elseif($options['type'] == 'search'){
			$html .= '<input type="search" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}elseif($options['type'] == 'datetime'){
			$html .= '<input type="datetime" class="'.$classError.'" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}elseif($options['type'] == 'texarea'){
			$html .= '<textarea id="input-'.$name.'" name="'.$name.'" '.$attr.' >'.$value.'</textarea>';
		}elseif($options['type'] == 'checkbox'){
			$html .= '<input type="checkbox" name="'.$name.'" value="1" '.(empty($value)? '' : 'checked').' >';
		}elseif($options['type'] == 'yesno'){
			if(!empty($value) AND $value=1){
				$yes = 'checked';
				$no  = '';
			}else{
				$no  = 'checked';
				$yes = '';
			}
			$html .= '<input type="radio" name="'.$name.'" value="1" '.$yes.' > Yes';
			$html .= '<input type="radio" name="'.$name.'" value="0" '.$no.' > No';
		}elseif($options['type'] == 'file'){
			$html .= '<input type="file" class="input-file" id="input-'.$name.'" name="'.$name.'" '.$attr.' >';
		}elseif($options['type'] == 'password'){
			$html .= '<input class="'.$classError.'" type="password" id="input-'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
		}
		if($error){
			$html .= '<small class="error">'. $error.'</small>';
		}

		$html .= '</div></div>';
		return $html;
	}

	/**
	 * Select
	 * Generate select input
	 *
	 * @param string $name
	 * @param string $label
	 * @param object $value
	 * @param array  $option
	 */
	public function select($name, $label, $value, $options = array()){
		$error = FALSE;
		$classError = '';

		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error';
		}
		if(!isset($this->controller->request->data->$name)){
			$focus = '';
			if(isset($options['focus']) && !empty($options['focus'])){
				$focus = $options['focus'];
			}
		}else{
			$focus = $this->controller->request->data->$name;
		}

		$html = '<div class="clearfix'.$classError.'">
					<label for="input'.$name.'" class="'.$classError.'">'.$label.'</label>
					<div class="input">';
		$attr = ' ';
		$html .= '<select id="input-'.$name.'" name="'.$name.'" '.$attr.' >';

		foreach($value as $k){
			if($focus === $k->name || $focus === $k->id){
				$html .= '<option value="'.$k->id.'" SELECTED>'.$k->name.'</option>';
			}
			$html .= '<option value="'.$k->id.'">'.$k->name.'</option>';
		}
		
		
        $html .= '</select>';

        if($error){
			$html .= '<small class="error">'. $error.'</small>';
		}
        $html .= '</div></div>';
		return $html;
	}

}