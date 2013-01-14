<?php

/**
 * Category class
 * @package bsmarty\controller
 */
class MenuController extends Controller{

	/** -*|*-*|*-*|*-*|*-*|*-*| ADMIN |*-*|*-*|*-*|*-*|*-*|*- **/

	/**
	 * Admin Index
	 */
	public function admin_index(){
		$this->loadModel('Menu');

		$d['menus'] = $this->Menu->allmenus();

		$this->set($d);
	}

	/**
	 * Admin Edit
	 * Edit an element
	 */
	public function admin_edit($type=null, $group_id=NULL){
		$this->loadModel('Menu');
		if($this->request->data){ // post form
			/* What type is? Group or Item? */
			if($type == 'group'){ // it's a group
				if($this->Menu->group->validates($this->request->data)){
					$this->Menu->group->save($this->request->data);
					$this->Flash->create('Group added');
					$this->redirect('admin/menu/index');
				}
			}elseif($type == 'item'){ // it's an item
										
				if(isset($this->request->data->menu_order)){ // Edit action

					// get menu order in array
					$menu_order = explode(',', $this->request->data->menu_order);

					$position = 1; // initialize position
					$i = 0;
					$Items = new stdclass;
					foreach($menu_order as $id_item){
						/* Set dynamic variables */
						$parent_id = 'parent_id__'.$id_item;
						$name      = 'name__'.$id_item;
						$url       = 'url__'.$id_item;
						$class     = 'class__'.$id_item;
						$target    = 'target__'.$id_item;

						/* Set the object for saving data */
						$Items->$i            = new stdclass;
						$Items->$i->id        = $id_item;
						$Items->$i->parent_id = $this->request->data->$parent_id;
						$Items->$i->group_id  = $group_id;
						$Items->$i->name      = $this->request->data->$name;
						$Items->$i->url       = $this->request->data->$url;
						$Items->$i->class     = $this->request->data->$class;
						$Items->$i->target    = $this->request->data->$target;
						$Items->$i->position  = $position;

						$this->Menu->item->save($Items->$i);

						$position++;
						$i++;
					}

					// We have to make a loop for saving each elements correctly
					
					$this->Flash->create('Items saved');
					$this->redirect('admin/menu/edit/item/'.$group_id);

				}else{ // Add action
					if($this->Menu->item->validates($this->request->data)){ // Validates data
						// Get the last position setted in db for the menu
						$lastPosition = $this->Menu->item->findFirst(array(
							'fields'     => 'position',
							'conditions' => array('group_id' => $group_id),
							'orderBy'    => 'position DESC'
							));
						$this->request->data->position = $lastPosition->position+1;
						$this->request->data->group_id = $group_id;
						$this->Menu->item->save($this->request->data);
						$this->Flash->create('Item added');
						$this->redirect('admin/menu/edit/item/'.$group_id);
					}
				}
				
				
			}else{
				die('unkown type');
			}
		}else{
			if($type == 'item'){
				
				$d['items']  = $this->Menu->item->find(array(
					'fields' => '*',
					'conditions' => array('group_id' => $group_id),
					'orderBy' => 'position ASC'
				));

				/* Build an array with the association between id and item name for parent select list */
				$d['itemsAssoc'] = array();
				$d['itemsAssoc'][0] = new stdclass;
				$d['itemsAssoc'][0]->id = '0';
				$d['itemsAssoc'][0]->name = 'none';
				$i = 1;
				$d['itemsOrder'] = ''; // Original serialized order of items
				foreach ($d['items'] as $item) {
					$d['itemsAssoc'][$i] = new stdclass;
					$d['itemsAssoc'][$i]->id = $item->id;
					$d['itemsAssoc'][$i]->name = $item->name;

					$d['itemsOrder'] .= $item->id.',';

					$i++;
				}

				$d['itemsOrder'] = substr($d['itemsOrder'], 0, -1); // Erased the last ","

				$d['group_id'] = $group_id;

				$this->set($d);

			}else{
				die('unkown type');
			}
		}
	}

	/**
	 * Admin Delete
	 * Delete a group or an item
	 * If deleting a group, then delete all related items
	 * If deleting an itemn, recalculate the position
	 */
	public function admin_delete($type=null, $id=null){
		$this->loadModel('Menu');
		/* What type is? Group or Item? */
		if($type == 'group'){ // it's a group				

			// Delete the menu group
			$this->Menu->group->delete($id);
			// Cont all associated items
			$items_count = $this->Menu->item->findCount(array(
				'conditions' => array('group_id' => $id)
				));
			if($items_count > 0){
				// Grab all associated itemq
				$items = $this->Menu->item->find(array(
					'conditions' => array('group_id' => $id)
					));
				// Delete all items
				foreach($items as $item){
					$this->Menu->item->delete($item->id);
				}
			}
			$this->Flash->create('Group Deleted');
			$this->redirect('admin/menu/index');
		}elseif($type == 'item'){ // it's an item
			// Grab the group_id of the item
			$item_group = $this->Menu->item->findFirst(array(
				'conditions' => array('id' => $id),
				'fields'     => 'group_id'
				));

			// Test if this item has children
			$item_haschild = $this->Menu->item->findCount('parent_id="'.$id.'"');
			if($item_haschild > 0){
				$children = $this->Menu->item->getChildren($id);
				$children = array_shift($children); // Sanitize the variable
				
				// Looping to delete them all
				foreach($children as $child){
					$this->Menu->item->delete($child);
				}

				$this->Flash->create('Items Deleted');
			}else{
				// Delete the item
				$this->Menu->item->delete($id);
				$this->Flash->create('Item Deleted');
			}
			$this->redirect('admin/menu/edit/item/'.$item_group->group_id);
		}else{
			die('unkown type');
		}
	}
}