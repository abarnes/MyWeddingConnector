<?php
class BillShell extends Shell {
	var $uses = array('Vendor','Bill','Setting');
	//var $tasks = array('Email');
	//var $Email;

	function startup() {
	}

	function main() {
		$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		$start = date('n/j/y',strtotime("-1 week"));
		$end = date('n/j/y',strtotime("now"));
		$num = 0;
		
		$v = $this->Vendor->find('all',array('conditions'=>array('Vendor.total_bill >'=>'0')));
		foreach ($v as $v) {
			$this->Bill->create();
			$d = array();
			$d['Bill']['vendor_id'] = $v['Vendor']['id'];
			$d['Bill']['week_start'] = $start;
			$d['Bill']['week_end'] = $end;
			$d['Bill']['end_timestamp'] = strtotime("-1 week");
			$d['Bill']['leads'] = $v['Vendor']['total_bill'];
			$d['Bill']['total'] = $s['Setting']['lead_price']*$v['Vendor']['total_bill'];
			$this->Bill->save($d);
			$this->Bill->id = false;
			
			$this->Vendor->id = $v['Vendor']['id'];
			$this->Vendor->saveField('total_bill','0');
			$this->Vendor->id = false;
			
			$num++;
		}
		
		$this->out('Bills Generated for '.$num.' vendors.');
	}
		
}
?>