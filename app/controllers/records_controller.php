<?php
class RecordsController extends AppController {
 
	var $name = 'Records';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time', 'javascript');
	var $uses = array('Setting','Record','Category','Vendor');
	var $components = array('Auth','Session');
        
        function beforeFilter() {
            //$this->Auth->allow('view');
        }
        
	
	function index () {
		//$this->set('records', $this->Range->Vendor->find('list'));
		$this->paginate = array('limit' => 18);
			$records = $this->paginate('Record');
			if (count($records)==0){
				$this->Session->setFlash('No records found.');
			}
		$this->set(compact('records'));
	}
	
	function dashboard(){
		$this->layout = 'admin';
		$this->set('down','dashboard');
		
		$ind = $this->Record->Vendor->Category->find('all',array('conditions'=>array('Category.enable'=>'1')));
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		
		if ($this->Record->find('count',array('conditions'=>array('Record.sent'=>'1')))!=0) {
			$this->set('go','1');
		
			if (empty($this->data)) {
				$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created >' => date('Y-m-d', strtotime("-1 month"))))));
				$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created >' => date('Y-m-d', strtotime("-1 month")))));
				
				$f = 0;
				$total = 0;
				foreach ($ind as $i) {
					$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created >=' => date('Y-m-d', strtotime("-1 month")))));
					$ind[$f]['leads'] = $l;
					$total = $total+$l;
					$f++;
				}
				
				$g = 0;
				foreach ($ind as $i) {
					$tt = $i['leads']/$total;
					$ind[$g]['perc'] = $tt*100;
					$g++;
				}
				$b = date('Y-m-d',strtotime("-1 month"));
				$beg = date('j',strtotime("-1 month"));
				$begin = strtotime($b);
				$end = strtotime(date('Y-m-d'));
				
				$this->set('nam','Previous month');
			} else {
				if ($this->data['Record']['start_date']==$this->data['Record']['end_date']) {
					$this->Session->setFlash('You cannot set the dates equal to each other.');
					$this->redirect(array('action'=>'dashboard'));
				}
				if ($this->data['Record']['start_date']!=null && $this->data['Record']['end_date']!=null) {
					$bo = strtotime($this->data['Record']['end_date']);
					$bo = $bo+86400;
					
					$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created >=' => date('Y-m-d', strtotime($this->data['Record']['start_date'])),'Client.created <='=>date('Y-m-d', $bo)))));
					$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created >=' => date('Y-m-d', strtotime($this->data['Record']['start_date'])),'Record.created <='=>date('Y-m-d', $bo))));
					
					$f = 0;
					$total = 0;
					foreach ($ind as $i) {
						$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created >=' => date('Y-m-d', strtotime($this->data['Record']['start_date'])),'Record.created <='=>date('Y-m-d', $bo))));
						$ind[$f]['leads'] = $l;
						$total = $total+$l;
						$f++;
					}
					
					$g = 0;
					foreach ($ind as $i) {
						if ($total!=0) {
							$tt = $i['leads']/$total;
							$ind[$g]['perc'] = $tt*100;
						} else {
							$ind[$g]['perc'] = '0';	
						}
						$g++;
					}
					$b = date('Y-m-d',strtotime($this->data['Record']['start_date']));
					$beg = date('j',strtotime($this->data['Record']['start_date']));
					$begin = strtotime($b);
					$end = strtotime(date('Y-m-d',strtotime($this->data['Record']['end_date'])));
					
					$this->set('nam',date('M j, Y',strtotime($this->data['Record']['start_date'])).' to '.date('M j, Y',strtotime($this->data['Record']['end_date'])));
				} elseif ($this->data['Record']['start_date']==null && $this->data['Record']['end_date']!=null) {
					/*$this->Session->setFlash('Please provide a start date.');
					$this->redirect(array('action'=>'dashboard'));*/
					$bo = strtotime($this->data['Record']['end_date']);
					$bo = $bo+86400;
					
					$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created <='=>date('Y-m-d', $bo)))));
					$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created <='=>date('Y-m-d', $bo))));
					
					
					$f = 0;
					$total = 0;
					foreach ($ind as $i) {
						$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created <='=>date('Y-m-d', $bo))));
						$ind[$f]['leads'] = $l;
						$total = $total+$l;
						$f++;
					}
					
					$g = 0;
					foreach ($ind as $i) {
						if ($total!=0) {
							$tt = $i['leads']/$total;
							$ind[$g]['perc'] = $tt*100;
						} else {
							$ind[$g]['perc'] = '0';	
						}
						$g++;
					}
					
					$b = date('Y-m-d',strtotime("-6 months"));
					$beg = date('j',strtotime("-6 months"));
					$begin = strtotime($b);
					$end = strtotime(date('Y-m-d',strtotime($this->data['Record']['end_date'])));
					
					$this->set('nam','Three months ago to '.date('M j, Y',strtotime($this->data['Record']['end_date'])));
				} else {
					$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created >=' => date('Y-m-d', strtotime($this->data['Record']['start_date']))))));
					$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created >=' => date('Y-m-d', strtotime($this->data['Record']['start_date'])))));
					
					$f = 0;
					$total = 0;
					foreach ($ind as $i) {
						$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created >=' => date('Y-m-d', strtotime($this->data['Record']['start_date'])))));
						$ind[$f]['leads'] = $l;
						$total = $total+$l;
						$f++;
					}
					
					$g = 0;
					foreach ($ind as $i) {
						if ($total!=0) {
							$tt = $i['leads']/$total;
							$ind[$g]['perc'] = $tt*100;
						} else {
							$ind[$g]['perc'] = '0';	
						}
						$g++;
					}
					$b = date('Y-m-d',strtotime($this->data['Record']['start_date']));
					$beg = date('j',strtotime($this->data['Record']['start_date']));
					$begin = strtotime($b);
					$end = strtotime(date('Y-m-d'));
					
					$this->set('nam','From '.date('M j, Y',strtotime($this->data['Record']['start_date'])));
				}
			}
			$this->set('rev',$total*$s['Setting']['lead_price']);
			$this->set('ind',$ind);
			$this->set('leads',count($ld));
			
			$dat = array();
				foreach ($ld as $l) {
					$f = date('Y-m-d',strtotime($l['Record']['created']));
					$d = date('j',strtotime($l['Record']['created']));
					$f = strtotime($f);
					if (array_key_exists($f,$dat)) {
						$dat[$f]['leads'] = $dat[$f]['leads']+1;
					} else {
						$dat[$f]['leads'] = 1;
						$dat[$f]['date'] = $d;
						$dat[$f]['stamp'] = $f;
					}
				}
				
				while ($begin<=$end) {
					if (!array_key_exists($begin,$dat)) {
						$dat[$begin]['leads'] = 0;
						$dat[$begin]['date'] = date('j',$begin);
						$dat[$begin]['stamp'] = $begin;
					}
					$begin = $begin+86400;
				} 
				
				$sortArray = array(); 
	
				foreach($dat as $person){ 
				    foreach($person as $key=>$value){ 
					if(!isset($sortArray[$key])){ 
					    $sortArray[$key] = array(); 
					} 
					$sortArray[$key][] = $value; 
				    } 
				} 
				
				$orderby = "stamp"; //change this to whatever key you want from the array 
				
				array_multisort($sortArray[$orderby],SORT_ASC,$dat);
				
				$it = count($dat);
				if ($it>35 && $it<60) {
					$result = array();
					for ($i = 0; $i < $it; $i += 2) {
					  $result[] = $dat[$i];
					}
				} elseif ($it>=60 && $it<90) {
					$result = array();
					for ($i = 0; $i < $it; $i += 5) {
					  $result[] = $dat[$i];
					}
				} elseif ($it>=90 && $it<120) {
					$result = array();
					for ($i = 0; $i < $it; $i += 10) {
					  $result[] = $dat[$i];
					}
				} elseif ($it>=120 && $it<190) {
					$result = array();
					for ($i = 0; $i < $it; $i += 15) {
					  $result[] = $dat[$i];
					}
				} elseif ($it>=190) {
					$result = array();
					for ($i = 0; $i < $it; $i += 20) {
					  $result[] = $dat[$i];
					}
				} else {
					$result = $dat;
				}
				
				//die(print_r($dat));
			$this->set('dat',$result);
		
		} else {
			$this->set('go','0');
		}
	}
	
	function add() {
		//$this->set('rs', $this->Range->Vendor->find('list'));
		if (!empty($this->data)) {
			if ($this->Record->save($this->data)) {
				$this->Session->setFlash('Record Successfully Added.');
				$this->redirect(array('controller'=>'records','action' => 'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Record');
			}
		}
	}
    
	function edit($id) {
		$this->set('id',$id);
		//$this->set('vendors', $this->Range->Vendor->find('list',array('order'=>'Range.name ASC')));
		if (empty($this->data)) {
			$this->data = $this->Record->read();
		} else {
			if ($this->Record->save($this->data)) {
				$this->Session->setFlash('Record Has Been Updated.');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			} 
		}
	}
    
	function delete($id) {
		$this->Record->delete($id);
		$this->Session->setFlash('Record Successfully Deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
}

?>