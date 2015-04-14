<?php
class ClientsController extends AppController {
 
	var $name = 'Clients';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time', 'javascript');
	var $uses = array('Client','Category','Range','Vendor','Setting','Record');
	var $components = array('Auth','Session','Email');
        
        function beforeFilter() {
            $this->Auth->allow('add');
        }
        
	function index ($w=null) {
		$this->layout = 'admin';
		$this->set('down','brides');
		if (isset($w)) {
			if ($w=='approved') {
				$this->paginate = array('limit' => 20,'conditions'=>array('Client.approved'=>'1'),'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.phone','Client.created'));
				$this->set('show','Approved');
			} else {
				$this->paginate = array('limit' => 20,'conditions'=>array('Client.approved'=>'2'),'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.phone','Client.created'));
				$this->set('show','Rejected');
			}
		} else {
			$this->paginate = array('limit' => 20,'conditions'=>array('Client.approved !='=>'0'),'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.phone','Client.created'));
			$this->set('show','Approved & Rejected');
		}
		$clients = $this->paginate('Client');
		$this->set(compact('clients'));
		//die(print_r($clients));
	}
	
	function pending () {
		$this->layout = 'admin';
		$this->set('down','pending');
		$this->paginate = array('limit' => 18,'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.created','Client.phone'),'conditions'=>array('Client.approved'=>'0'));
		$clients = $this->paginate('Client');
		$this->set(compact('clients'));
	}
	
	function add() {
		if (!empty($this->data)) {
			
			$this->Client->set($this->data);
			if ($this->Client->validates()) {
				$w = $this->data['Client']['wedding_date'];
				$this->data['Client']['wedding_date'] = date('Y-m-d',strtotime($w));
				if ($this->Client->save($this->data)) {
					$i = $this->Client->find('first',array('order'=>'Client.created DESC','conditions'=>array('Client.last_name'=>$this->data['Client']['last_name'],'Client.zip'=>$this->data['Client']['zip'])));
					$id = $i['Client']['id'];
					$this->redirect(array('controller'=>'categories','action' => 'select/'.$id));
				} else {
					$this->Session->setFlash('Error: Failed to Save');
				}
			} else {
				$errors = $this->Client->invalidFields();
				$this->set('errors',$errors);
			}
		} else {
			$this->set('errors',array());
		}
	}
    
	function edit($id) {
		$this->set('id',$id);

		if (empty($this->data)) {
			$this->data = $this->Client->read();
		} else {
			if ($this->Client->save($this->data)) {
				$this->Session->setFlash('Client Has Been Updated.');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			}
		}
	}
	
	function view ($id) {
		$this->layout = 'admin';
		$this->set('down','brides');
		$c = $this->Client->findById($id);
		if (isset($c)) {
			$this->set('c',$c);
			$this->set('cats',$this->Category->find('list',array('fields'=>array('Category.name'))));
			$this->set('v',$this->Vendor->find('list',array('fields'=>array('Vendor.name'))));
		} else {
			$this->Session->setFlash('ID not found.');
			$this->redirect(array('action'=>'index'));
		}
	}
    
	function delete($id) {
		$this->Client->delete($id,true);
		$this->Session->setFlash('Client Successfully Deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
	function reject($id) {
		$this->Client->id = $id;
		if ($this->Client->saveField('approved','2')) {
			//$this->Session->setFlash('');
		} else {
			$this->Session->setFlash('Error');
		}
		$this->redirect(array('action'=>'pending'));
	}
	
	function approve($id) {
		$this->Client->id = $id;
		if ($this->Client->saveField('approved','1')) {
			$records = $this->Client->Record->find('all',array('conditions'=>array('Record.client_id'=>$id)));
			//find vendors
			$chosen = array();
			foreach ($records as $r) {
				if ($r['Record']['select']=='1') {
					//for categories with ranges
					if ($r['Record']['range_id']!=null) {
						//need to get latest vendor per category
						$i=1;
						while ($i<200) {
							$this->Vendor->bindModel(array(
								'hasOne' => array(
									'RangesVendor',
									'FilterTag' => array(
										'className' => 'Range',
										'foreignKey' => false,
										'conditions' => array('FilterTag.id = RangesVendor.vendor_id')
							))));
							$vendor = $this->Vendor->find('first',array('order'=>'Vendor.last_sent ASC','fields'=>array('Vendor.*'),'conditions'=>array('Vendor.active'=>'1',"Not"=>array('Vendor.id'=>$chosen),'Vendor.category_id'=>$r['Record']['category_id'],'RangesVendor.range_id'=>$r['Record']['range_id'])));
							
							if (!empty($vendor)) {
								if ($vendor['Vendor']['total_bill']==null) {
									$amt = 0;
								} else {
									$amt = $vendor['Vendor']['total_bill'];
								}
								if ($amt>=$vendor['Vendor']['leads_per_week']) {
									$i++;
								} else {
									$i=201;
								}
							} else {
								$i=201;
							}
						}
						
					//for categories without ranges	
					} else {
						$i=1;
						while ($i<200) {
							$vendor = $this->Vendor->find('first',array('order'=>'Vendor.last_sent ASC','conditions'=>array('Vendor.active'=>'1',"Not"=>array('Vendor.id'=>$chosen),'Vendor.category_id'=>$r['Record']['category_id'])));
							if (!empty($vendor)) {
								if ($vendor['Vendor']['total_bill']==null) {
									$amt = 0;
								} else {
									$amt = $vendor['Vendor']['total_bill'];
								}
								if ($amt>=$vendor['Vendor']['leads_per_week']) {
									$i++;
								} else {
									$i=201;
								}
							} else {
								$i = 201;
							}
						} 
					}
					
					//make sure a vendor was found
					if (!empty($vendor)) {
						//common to each type
						$this->_mail($vendor['Vendor']['email'],$id,$r['Record']['range_id']);
						
						$this->Record->id = $r['Record']['id'];
						$data = array();
						$data['Record']['sent'] = '1';
						$data['Record']['vendor_id'] = $vendor['Vendor']['id'];
						$this->Record->save($data);
						$this->Record->id = false;						
						
						$chosen[] = $vendor['Vendor']['id'];						
						
						$this->Vendor->id = $vendor['Vendor']['id'];
						$d = array();
						$d['Vendor']['total_all'] = $vendor['Vendor']['total_all']+1;
						$d['Vendor']['total_bill'] = $vendor['Vendor']['total_bill']+1;
						$d['Vendor']['last_sent'] = date('Y-m-d H:i:s');
						$this->Vendor->save($d);
						$this->Vendor->id = false;
					} else {
						$this->Record->id = $r['Record']['id'];
						$data = array();
						$data['Record']['sent'] = '1';
						$data['Record']['vendor_id'] = null;
						$this->Record->save($data);
						$this->Record->id = false;
					}
					
					unset($vendor);
					unset($i);
				}
			}
			$this->redirect(array('action'=>'pending'));
			
		} else {
			$this->Session->setFlash('Error: Failed to Save');
		}
	}
	
	function _mail($to,$id,$range=null){
		$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		$client = $this->Client->findById($id);
		$this->set('name',$s['Setting']['site_url']);
		$this->set('c',$client);
		if ($range!=null) {
			$r = $this->Range->findById($range);
			$this->set('rr','Price Range: '.$r['Range']['name']);
		} else {
			$this->set('rr','');
		}
		
		// Let the vendor know
		$this->Email->to = $to;
		$this->Email->subject = 'Lead from '.$s['Setting']['site_url'];
		$this->Email->replyTo = $s['Setting']['replyto_email'];
		$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
		$this->Email->template = 'lead'; 
		$this->Email->sendAs = 'both';
		$this->Email->send();
		//sleep(1);
		return true;
	}
    
}

?>