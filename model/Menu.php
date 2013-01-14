<?php
/**
 * Menu class
 *
 * Instructions
 * This is a list of action you can do with the class:
 *  - add a menu group
 *  - add element to menu
 *  - re-ordering the menu
 *  - edit the menu element
 *  - delete the meu element
 *
 * The table structure:
 *  - menu_items
 *    - id
 *    - group_id
 *    - parent_id
 *    - name
 *    - url
 *    - class
 *    - target
 *    - position
 *  - menu_group
 *    - id
 *    - name
 *
 */

/**
 * Menu
 * This is a class calling others
 * @package bsmarty\model
 */
class Menu {

	/* Attributes */

	/**
	 * Group
	 * Variable to store the Menu_group class
	 * @var object
	 */
	var $group;

	/**
	 * Item
	 * Variable to store the Menu_item class
	 * @var object
	 */
	var $item;

	/**
	 * Construct
	 * Method to set the Menu_group and Menu_item classes
	 * @param void
	 */
	public function __construct(){
		$this->group = new Menu_group;
		$this->item  = new Menu_item;
	}

	/**
	 * All menus
	 * Load all menu items by menu groups
	 * @param void
	 * @return array of object $menus
	 */
	public function allmenus(){
		$menus = $this->group->find(array(
			'fields' => '*', //all (id and name)
			'orderBy' => 'id ASC'
		));

		foreach($menus as $menu){
			$menu->html = $this->item->render($menu->id);
		}

		return $menus;
	}

	/**
	 * Get menu
	 * Load one menu
	 * @param string $groupename
	 * @return html
	 */
	public function getMenu($groupename){
		$menu = $this->group->findFirst(array(
			'fields' => 'id',
			'conditions' => array('name' => $groupename)
		));

		return $this->item->render($menu->id);
	}

}

class Menu_group extends Model {

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

class Menu_item extends Model{

	/* Attributes */

	/**
	 * variable to store temporary data to be processed later
	 *
	 * @var array
	 */
	var $data;

	/**
	 * variable to store temporary data to be processed later
	 *
	 * @var array
	 */
	var $children = array();

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

	/**
	 * Get Children
	 * Get all child of an item
	 * Recursive function
	 * @param int $id
	 */
	public function getChildren($id){
		// Count the number of children of the item, and call the functon itsefl foreach item
		if($this->findCount('parent_id="'.$id.'"')>0){

			// Add the current item on the list
			$this->children['id'][] = $id;

			// Get children informations of the item
			$children[$id] = $this->find(array(
				'conditions' => array('parent_id' => $id)
				));

			// Looping on all results to find if thez have children
			foreach($children[$id] as $child){
				$this->getChildren($child->id);
			}
		}else{
			// Check if the id is already in the list, if not, add it
			if(!array_search($id, $this->children['id'])){
				$this->children['id'][] = $id;
			}
		}

		return $this->children;
	}

	/**
	 * Add an item
	 *
	 * @param int $id 			ID of the item
	 * @param int $parent 		parent ID of the item
	 * @param string $li_attr 	attributes for <li>
	 * @param string $name		text inside <li></li>
	 * @param string $url       url for the <a></a>
	 * @param string $class     class for the <li></li>
	 * @param string $target    open the url on a new tab if exists
	 */
	function add_row($id, $parent, $li_attr, $name, $url, $class, $target) {
		$this->data[$parent][] = array(
			'id' => $id,
			'li_attr' => $li_attr,
			'name' => $name,
			'url' => $url,
			'class' => $class,
			'target' => $target
		);
	}

	/**
	 * Generates nested lists
	 *
	 * @param string $ul_attr
	 * @return string
	 */
	function generate_list($ul_attr = '') {
		return $this->ul(0, $ul_attr);
	}

	/**
	 * Recursive method for generating nested lists
	 *
	 * @param int $parent
	 * @param string $attr
	 * @return string
	 */
	function ul($parent = 0, $attr = '') {
		static $i = 1;
		$indent = str_repeat("\t\t", $i);
		if (isset($this->data[$parent])) {
			if ($attr) {
				$attr = ' '.$attr;
			}
			$html = "\n$indent";
			$html .= "<ul$attr>";
			$i++;
			foreach ($this->data[$parent] as $row) {
				$child = $this->ul($row['id']);
				$html .= "\n\t$indent";
				$html .= '<li'.$row['li_attr'].' class="'.$row['class'].'"><a href="'.$row['url'].'" title="'.$row['name'].'"';
				if(isset($row['target']) && !empty($row['target'])){
					$html .= ' target="_blank"';
				}
				$html .= '>';
				$html .= $row['name'];
				$html .= '</a>';
				if ($child) {
					$i--;
					$html .= $child;
					$html .= "\n\t$indent";
				}
				$html .= '</li>';
			}
			$html .= "\n$indent</ul>";
			return $html;
		} else {
			return false;
		}
	}

	/**
	 * Clear the temporary data
	 */
	function clear() {
		$this->data = array();
	}




	/**
	 * Render function
	 * Build the HTML tree menu
	 *
	 * @param int $group_id
	 * @param int $menu_id the ul id
	 */
	public function render($group_id, $menu_id='bs-menu'){
		$items = $this->find(array(
				'fields' => '*',
				'conditions' => array('group_id' => $group_id),
				'orderBy' => 'position ASC'
			));

		foreach ($items as $row) {
			$this->add_row(
				$row->id,
				$row->parent_id,
				' id="menu-'.$row->id.'"',
				$row->name,
				$row->url,
				$row->class,
				$row->target
			);
		}

		$html = $this->generate_list('id="'.$menu_id.'-'.$group_id.'"');

		/* Clearig temporary data */
		$this->clear();

		return $html;

		
	}
}