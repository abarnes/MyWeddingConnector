<h3>Add User</h3>
<span style="font-size:.8em;"><a href="/users">Back to Admin Page</a></span>
<br/><br/>
    
    <?php echo $form->create('User', array('action' => 'add')); ?>
    <?php echo $form->input('username', array( 'label' => 'Username: ')); ?>
    <?php echo $form->input('email', array( 'label' => 'Email: ')); ?>
    <?php echo $form->input('password', array('label'=>'Password: ','value'=>'')); ?>
    <?php echo $form->input('password2', array('type'=>'password','value'=>'','label'=>'Retype Password: ')); ?>
    <?php echo $form->end('Add User'); ?>


    