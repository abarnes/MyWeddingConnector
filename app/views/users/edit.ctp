<h3>Edit User</h3>
<span style="font-size:.8em;"><a href="/users">Back to Admin Page</a></span>
<br/><br/>

    <?php echo $form->create('User', array('action' => 'edit/'.$id)); ?>
    <?php echo $form->input('username', array( 'label' => 'Username: ')); ?>
    <?php echo $form->input('email', array( 'label' => 'Email: ')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $form->end('Update User'); ?>

    