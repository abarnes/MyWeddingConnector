<?php

class Vendor extends AppModel {
    var $name = 'Vendor';
    var $belongsTo = 'Category';
    var $hasMany = array('Record');
    /*var $validate = array(
        'name' => array(
            'rule' => '/^[a-z0-9A-Z\s]{1,}$/i',
            'message' => 'Only letters and numbers allowed.'
        )
    );*/
}
?>