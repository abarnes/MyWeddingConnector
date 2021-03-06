<?php
class Vendor extends AppModel {
    var $name = 'Vendor';
    var $belongsTo = 'Category';
    var $hasMany = array('Record','Bill');
    var $hasAndBelongsToMany = array(
        'Range' =>
            array(
                'className'              => 'Range',
                'joinTable'              => 'ranges_vendors',
                'foreignKey'             => 'vendor_id',
                'associationForeignKey'  => 'range_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
    );
    /*var $validate = array(
        'name' => array(
            'rule' => '/^[a-z0-9A-Z\s]{1,}$/i',
            'message' => 'Only letters and numbers allowed.'
        )
    );*/
}
?>