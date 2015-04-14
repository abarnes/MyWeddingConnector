<?php
class SettingsController extends AppController {
 
	var $name = 'Settings';
        //var $layout = 'default';
	//var $helpers = array('Html', 'Form', 'Time', 'javascript');
	var $components = array('Auth','Session');
        
        function beforeFilter() {
            //$this->Auth->allow('setup');
        }
        
	
	function edit() {
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		$this->Setting->id = $s['Setting']['id'];
		
		if (empty($this->data)) {
			$this->data = $this->Setting->read();
		} else {
			//save new settings
			if ($this->Setting->save($this->data)) {
				$this->Session->setFlash('Settings Updated');
				$this->redirect(array('controller'=>'users','action' => 'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Settings (settings,edit)');
				$this->redirect(array('controller'=>'users','action' => 'index'));
			}
		}
	}
    
}

?>