<?php 
class User extends AppModel {
    var $name = 'User';
    var $validate = array(
        'username' => array(
            'rule' => 'isUnique',
            'message' => 'This username has already been taken.',
            'required'=>true,
            'allowEmpty'=>false
        )
    );
    
}
?>