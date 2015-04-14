<?php
class Category extends AppModel {
    var $name = 'Category';       
    var $hasMany = array('Range'=>array('dependent'=>true),'Vendor'=>array('dependent'=>true),'Record'=>array('dependent'=>true)); 
    
}
?>