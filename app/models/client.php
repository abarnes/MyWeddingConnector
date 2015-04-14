<?php 
class Client extends AppModel {
    var $name = 'Client';
    var $hasMany = array('Record');
    var $validate = array(
        'email' => array(
            'rule' => array('email', true),
            'message' => 'Email'
        ),
        'first_name' => array(
            'rule' => array('minLength', '1'),
            'message' => 'First Name'
        ),
        'last_name' => array(
            'rule' => array('minLength', '1'),
            'message' => 'Last Name'
        ),
        'zip' => array(
            'rule' => array('minLength', '5'),
            'message' => 'Zip Code'
        ),
        'phone' => array(
            'rule' => array('minLength', '10'),
            'message' => 'Phone Number'
        ),
        'wedding_date' => array(
            'rule' => array('minLength', '5'),
            'message' => 'Wedding Date (mm/dd/yy)'
        )
    );
}
?>