<?php
class VendorsController extends AppController {
 
	var $name = 'Vendors';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time', 'javascript');
	var $uses = array('Vendor','Bill','Category','Record','Setting');
	var $components = array('Auth','Session','Email');
        
        function beforeFilter() {
            $this->Auth->allow('vadd','party','index');
        }
        
	
	function index() {
		
	}
	
	function manage () {
		$this->layout = 'admin';
		$this->set('down','vendors');
		$this->set('categories', $this->Vendor->Category->find('list',array('order'=>'Category.name ASC')));
		$this->paginate = array('limit' => 20,'order'=>'Vendor.name DESC');
			$vendors = $this->paginate('Vendor');
			if (count($vendors)==0){
				$this->Session->setFlash('No vendors currently in system.  Click "Add Vendor" to create one.');
			}
		$this->set(compact('vendors'));
	}
	
	function sel() {
		$this->layout = 'admin';
		$this->set('down','vendors');
		$this->set('categories', $this->Vendor->Category->find('list',array('order'=>'Category.name ASC')));
		if (!empty($this->data)) {
			$this->redirect(array('action'=>'add/'.$this->data['Vendor']['category_id']));
		}
	}
	
	function add($cat) {
		$this->layout = 'admin';
		$this->set('down','vendors');
		$this->set('cat',$cat);
		$this->set('ranges', $this->Vendor->Range->find('list',array('conditions'=>array('Range.category_id'=>$cat),'fields'=>array('Range.id','Range.name'))));
		if (!empty($this->data)) {
			$this->data['Vendor']['category_id'] = $cat;
			if ($this->data['Vendor']['leads_per_week']==null || $this->data['Vendor']['leads_per_week']=='0' || $this->data['Vendor']['leads_per_week']=='') {
				$this->data['Vendor']['leads_per_week']='99999';
			}
			if ($this->Vendor->save($this->data)) {
				$this->Session->setFlash('"'.$this->data['Vendor']['name'] . '" Successfully Added.');
				$this->redirect(array('controller'=>'vendors','action' => 'manage'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Vendor');
			}
		}
	}
    
	function edit($id) {
		$this->set('id',$id);

		$this->set('categories', $this->Vendor->Category->find('list',array('order'=>'Category.name ASC')));
		$this->set('ranges', $this->Vendor->Range->find('list',array('fields'=>array('Range.id','Range.name'))));
		if (empty($this->data)) {
			$this->data = $this->Vendor->read();
		} else {
			if ($this->Vendor->save($this->data)) {
				$this->Session->setFlash('Vendor Has Been Updated.');
				$this->redirect(array('action'=>'view/'.$id));
			} else {
				$this->Session->setFlash('Error: Failed to Save Vendor');
			}
		}
	}
	
	function view ($id,$w=null) {
		$this->layout = 'admin';
		$this->set('down','vendors');
		$c = $this->Vendor->findById($id);
		if (isset($c)) {
			$this->Vendor->id = $id;
			$this->data = $this->Vendor->read();
			$this->set('categories', $this->Vendor->Category->find('list',array('order'=>'Category.name ASC')));
			$this->set('ranges', $this->Vendor->Range->find('list',array('conditions'=>array('Range.category_id'=>$c['Vendor']['category_id']),'fields'=>array('Range.id','Range.name'))));
			$this->set('c',$c);
			if ($w==null) {
				$this->paginate = array('limit' => 20,'order'=>'Record.created DESC','conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1'));
				$h = $this->paginate('Record');
				$this->set('b',$h);
				//$this->set('b',$this->Vendor->Record->find('all',array('conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1'))));
				$this->set('w','leads');
				$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
				$this->set('price',$s['Setting']['lead_price']);
			} else {
				if ($w=='billing') {
					$this->paginate = array('limit' => 20,'order'=>'Bill.end_timestamp DESC','conditions'=>array('Bill.vendor_id'=>$id));
					$h = $this->paginate('Bill');
					$this->set('h',$h);
					//$this->set('h',$this->Vendor->Bill->find('all',array('conditions'=>array('Bill.vendor_id'=>$id))));
					$this->set('w','billing');
				} else {
					$this->paginate = array('limit' => 20,'order'=>'Record.created DESC','conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1'));
					$h = $this->paginate('Record');
					$this->set('b',$h);
					//$this->set('b',$this->Vendor->Record->find('all',array('conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1'))));
					$this->set('w','leads');
					$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
					$this->set('price',$s['Setting']['lead_price']);
				}
			}
		} else {
			$this->Session->setFlash('ID not found.');
			$this->redirect(array('action'=>'manage'));
		}
	}
	
	function paid($id) {
		$b = $this->Vendor->Bill->findById($id);
		$this->Vendor->Bill->id = $id;
			if ($b['Bill']['paid']=='1') {
				$this->Vendor->Bill->saveField('paid','0');
				$this->Session->setFlash('Bill marked as unpaid.');
			} else {
				$this->Vendor->Bill->saveField('paid','1');
				$this->Session->setFlash('Bill marked as paid.');
			}
		$this->redirect(array('action'=>'view/'.$b['Bill']['vendor_id'].'/billing'));
	}
    
	function delete($id) {
		$this->Vendor->delete($id);
		$this->Session->setFlash('Vendor Successfully Deleted.');
		$this->redirect(array('action'=>'manage'));
	}
	
	function vadd() {
		if (!empty($this->data)) {
			if ($this->data['Vendor']['agree']!='1') {
				$this->Session->setFlash('Please read the Terms of Use.');
				$this->redirect(array('controller'=>'vendors','action'=>'index'));
			}
			$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
			$this->set('d',$this->data);
			
			$this->Email->to = 'info@myweddingconnector.com';
			$this->Email->subject = 'New Vendor';
			$this->Email->replyTo = $s['Setting']['replyto_email'];
			$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
			$this->Email->template = 'vendor'; 
			$this->Email->sendAs = 'both';
			$this->Email->send();
			
			$this->Session->setFlash('Thank you!  We will contact you shortly.');
			$this->redirect(array('controller'=>'vendors','action'=>'index'));
		} else {
			$this->redirect(array('action'=>'index','controller'=>'vendors'));
		}
	}
	
	function party() {
		if (!empty($this->data)) {
			$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
			$this->set('d',$this->data);
			$this->Email->to = 'info@myweddingconnector.com';
			
			$this->Email->subject = 'New Vendor';
			$this->Email->replyTo = $s['Setting']['replyto_email'];
			$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
			$this->Email->template = 'party'; 
			$this->Email->sendAs = 'both';
			$this->Email->send();
			
			$this->Session->setFlash('Thank you! We look forward to seeing you there.');
			$this->redirect(array('controller'=>'pages','action'=>'countdown'));
		} else {
			$this->redirect(array('action'=>'countdown','controller'=>'pages'));
		}	
	}
	
	function test(){
		$v = $this->Vendor->find('all');
		foreach ($v as $v) {
			$this->Vendor->id = $v['Vendor']['id'];
			$this->Vendor->saveField('leads_per_week',99999);
			$this->Vendor->id = false;
		}
	}
}

?>