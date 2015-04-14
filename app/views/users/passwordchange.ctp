<h3>Change Password - <?php echo $this->data['User']['username']; ?></h3>
<span style="font-size:.8em;"><a href="/users">Back to Admin Page</a></span>
<br/><br/>
    
        <?php
    echo $form->create('User', array('action' => 'passwordchange'));
    echo $form->input('password', array('label'=>'New Password: ','type'=>'password','value'=>''));
    echo $form->input('password2', array('type'=>'password','value'=>'','label'=>'Retype New Password: '));
    echo $form->input('id', array('type'=>'hidden'));
    echo $form->end('Change Password');
?>
