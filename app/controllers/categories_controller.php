<?php
class CategoriesController extends AppController {
 
	var $name = 'Categories';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time', 'javascript');
	var $components = array('Auth','Session');
        
        function beforeFilter() {
            $this->Auth->allow('view','select');
        }
        
	
	function index () {
		$this->layout = 'admin';
		$this->set('down','industries');
		$this->paginate = array('limit' => 20);
			$cats = $this->paginate('Category');
			if (count($cats)==0){
				$this->Session->setFlash('No industriess currently in system.  Click "Add Industry" to create one.');
			}
		$this->set(compact('cats'));
	}
	
	function add() {
		$this->layout = 'admin';
		$this->set('down','industries');
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash('"'.$this->data['Category']['name'] . '" Successfully Added.');
				if ($this->data['Category']['use_ranges']=='1') {
					$i = $this->Category->getLastInsertID();
					$this->redirect(array('controller'=>'ranges','action' => 'add/'.$i));
				} else {
					$this->redirect(array('controller'=>'categories','action' => 'index'));
				}
			} else {
				$this->Session->setFlash('Error: Failed to Save Industry');
			}
		}
	}
	
	function select($id=null){
		if (isset($id)) {
			$this->set('id',$id);
		} else {
			$this->set('id','');
		}
		$this->Category->recursive = 2;
		$this->set('categories',$this->Category->find('all',array('order'=>'use_ranges DESC','conditions'=>array('Category.enable'=>'1'))));
		if (!empty($this->data)) {
			$cc = 0;
			foreach ($this->data['Category'] as $row=>$value) {
				if (substr($row,0,1)=='c') {
					if ($value==true) {
						$cc++;
					}
				}
			}
			if ($cc==0) {
				$this->redirect('/categories/select/'.$id);
			}
			
			foreach ($this->data['Category'] as $row=>$value) {
				if (substr($row,0,1)=='c') {
					$f = $this->Category->findById(substr($row,1));
					
					$i = 1;
					while($i<4){
						$this->Category->Record->create();
						$data = array();
						$data['Record']['client_id'] = $id;
						$data['Record']['category_id'] = substr($row,1);
						if ($f['Category']['use_ranges']=='1') {
							if ($value==false) {
								$data['Record']['select'] = '0';
							} else {
								$data['Record']['range_id'] = $this->data['Category']['v'.substr($row,1)];
								$data['Record']['select'] = '1';
							}
						} else {
							$data['Record']['select'] = $value;
						}
						
						$this->Category->Record->save($data);
						$this->Category->Record->id = false;
						$i++;
					}
				}
			}
			//$this->Session->setFlash('Thank you! You will receive your quotes soon.');
			$this->redirect(array('controller'=>'pages','action' => 'thankyou'));
		}
	}
    
	function edit($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		$this->set('id',$id);

		if (empty($this->data)) {
			$this->data = $this->Category->read();
		} else {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash('Industry has been updated.');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			}
		}
	}
    
	function delete($id) {
		$this->Category->delete($id,true);
		$this->Session->setFlash('Industry successfully deleted.');
		$this->redirect(array('action'=>'index'));
	}
    
}

?>