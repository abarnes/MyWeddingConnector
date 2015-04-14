<?php
class RangesController extends AppController {
 
	var $name = 'Ranges';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time', 'javascript');
	//var $uses = array('Choice','Race','Driver','Year','DriversYear','User','Record','Place');
	var $components = array('Auth','Session');
        
        function beforeFilter() {
            //$this->Auth->allow('view');
        }
        
	
	function index ($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		$this->set('r',$this->Range->Category->findById($id));
		
		$this->set('ranges', $this->Range->Vendor->find('list'));
		$this->paginate = array('limit' => 18,'order'=>'Range.low_end ASC','conditions'=>array('Range.category_id'=>$id));
			$ranges = $this->paginate('Range');
			if (count($ranges)==0){
				$this->Session->setFlash('No ranges currently defined for this industry.');
			}
		$this->set(compact('ranges'));
	}
	
	function add($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		$this->set('r',$this->Range->find('all',array('conditions'=>array('Range.category_id'=>$id))));
		
		$this->set('id',$id);
		$n = $this->Range->Category->findById($id);
		$this->set('name',$n['Category']['name']);
		//$this->set('categories', $this->Range->Category->find('list',array('order'=>'Category.name ASC','conditions'=>array('Category.use_ranges'=>'1'))));
		if (!empty($this->data)) {
			$this->data['Range']['category_id']=$id;
			if ($this->Range->save($this->data)) {
				$this->Session->setFlash('Price Range Successfully Added.');
				$find = $this->Range->find('first',array('conditions'=>array('Range.low_end'=>$this->data['Range']['low_end']),'order'=>array('Range.created DESC')));
				$this->redirect(array('controller'=>'ranges','action' => 'select/'.$find['Range']['id']));
			} else {
				$this->Session->setFlash('Error: Failed to Save Price Range');
			}
		}
	}
	
	function select($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		
		$this->Range->id = $id;
		$this->set('id',$id);
		$r = $this->Range->findById($id);
		$this->set('name',$r['Range']['name']);
		
		$v = $this->Range->Vendor->find('list',array('conditions'=>array('Vendor.category_id'=>$r['Range']['category_id']),'order'=>array('Vendor.name ASC')));
		if (count($v)==0) {
			$this->Session->setFlash('Price range set.  Add more, or skip ahead and add vendors.');
			$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
		}
		$this->set('vendors',$v);
		$this->set('categories', $this->Range->Category->find('list',array('order'=>'Category.name ASC','conditions'=>array('Category.use_ranges'=>'1'))));
		if (empty($this->data)) {
			$this->data = $this->Range->read();
		} else {
			if ($this->Range->save($this->data)) {
				$this->Session->setFlash('Vendors Set.');
				$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			} 
		}
	}
    
	function edit($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		
		$this->set('id',$id);
		$r = $this->Range->findById($id);
		
		$v = $this->Range->Vendor->find('list',array('conditions'=>array('Vendor.category_id'=>$r['Range']['category_id']),'order'=>array('Vendor.name ASC')));
		$this->set('vendors',$v);
		$this->set('categories', $this->Range->Category->find('list',array('order'=>'Category.name ASC','conditions'=>array('Category.use_ranges'=>'1'))));
		
		$this->Range->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Range->read();
		} else {
			if ($this->Range->save($this->data)) {
				$this->Session->setFlash('Range Has Been Updated.');
				$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			} 
		}
	}
    
	function delete($id) {
		$r = $this->Range->findById($id);
		$this->Range->delete($id);
		$this->Session->setFlash('Range Successfully Deleted.');
		$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
	}
	
}

?>