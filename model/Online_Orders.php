<?php
/**
 * Online Orders
 * @package bsmarty\model
 */
class Online_Orders extends Model {

	/* Attributes */
	public $category;
	public $item;

	public $expeditor   = "commande@atalante-pathologie.com";
	public $recipient   = "flaussinot@groupeforum.net";
	public $domainTitle = "Atalante Pathologie";

	/**
	 * Constructor
	 * Instanciation of all sub classes in attributes
	 */
	public function __construct(){
		$this->category = new Online_Order_category;
		$this->item = new Online_Order_Item;
	}

	/**
	 * Make Slug
	 * Make the slug from the given var
	 * @param string $text
	 * @return string $text (slugged)
	 */
	public function makeSlug($text){ 
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text); // replace non letter or digits by -
	  $text = trim($text, '-'); // trim
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // transliterate
	  $text = strtolower($text); // lowercase
	  $text = preg_replace('~[^-\w]+~', '', $text); // remove unwanted characters

	  if(empty($text)){
	    return 'n-a';
	  }

	  return $text;
	}

	/**
	 * Sanitize orders
	 * Delete items with quantity = 0
	 * @param object $orders
	 * @return object $orders (sanitized)
	 */
	public function sanitizeOrders($orders){
		foreach($orders as $id=>$quantity){
			if($quantity == '0' OR $id == 'other') unset($orders->$id);
		}
		return $orders;
	}

	/**
	 * Format Orders
	 * Retrieve all infos for each orders
	 * @param object $orders
	 * @return object $formatOrders
	 */
	public function formatOrders($orders){
		/* Sanitize orders */
		$orders = $this->sanitizeOrders($orders);

		$formatOrders = new StdClass;

		/* Retrieve data */
		$i = 0;
		foreach($orders as $slug=>$quantity){
			$formatOrders->$i = new stdclass;

			$data = $this->item->findFirst(array(
				'conditions' => array('slug' => $slug)
				));

			if($data){ // Because we have a textarea
				$formatOrders->$i           = $data;
				$formatOrders->$i->slug     = $slug;
				$formatOrders->$i->quantity = $quantity;
			}

			$i++;
		}

		return $formatOrders;
	}

	/**
	 * Send Order
	 * Send email with recap order, to the administrator and the customer
	 * @param object $items
	 * @param string $shipping
	 */
	public function sendOrder($user, $subject, $site_url, $items, $shipping, $other='', $template="online_orders"){

		parent::__construct(); // Refresh the PDO connection

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
		$email['keys']['shipping'] = $shipping;
		$email['keys']['nb_items'] = count((array)$items);
		$email['keys']['table'] .= '<table bordercolor="black">';
		$email['keys']['table'] .= '<thead><tr><th>Label</th><th>*</th><th>Quantité</th></tr></thead><tbody>';
		foreach($items as $k=>$v){
			$email['keys']['table'] .= '<tr><td>'.$v->name.'</td><td><center>'.$v->factor.'</center></td><td><center>'.$v->quantity.'</center></td></tr>';
		}
		$email['keys']['table'] .= '</tbody></table>';

		if(!empty($other)) {
			$email['keys']['table'] .= '<h4>Autre</h4><p>'.$other.'</p>';
		}

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


		/* Sending mail */
		return mail($bs_to, $subject, $email['body'], implode("\r\n", $email['headers']));
	}
}

/* ----------------- Specific classes ----------------- */

/**
 * Online Order Category
 */
class Online_Order_category extends Model{

	/* Attributes */
	
	/**
	 * Validates
	 * Add some rules to the user's register form
	 * This is an array composed of two argument:
	 * - rule    : accepts 'noEmpty' and regex
	 * - message : accepts HTML content
	 * @var array $validates
	 */
	var $validates = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have to give a name'
		)
	);

}

/**
 * Online Order Item
 */
class Online_Order_Item extends Model{

	/* Attributes */
	
	/**
	 * Validates
	 * Add some rules to the user's register form
	 * This is an array composed of two argument:
	 * - rule    : accepts 'noEmpty' and regex
	 * - message : accepts HTML content
	 * @var array $validates
	 */
	var $validates = array(
		'category_id' => array(
			'rule' => 'notEmpty', // Number
			'message' => 'You have to give a category id'
		),
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'You have to give a name'
		),
		'factor' => array(
			'rule' => '[0-9]+', // Number
			'message' => 'You have to give a number'
		)
	);

}