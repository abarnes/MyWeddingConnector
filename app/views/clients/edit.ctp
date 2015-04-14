<h4>Edit Client</h4>
<div style="width:60%;">
    
    <div class="label">
    <?php echo $form->create('Client', array('action' => 'edit/'.$id)); ?>
    <?php echo $form->input('first_name', array( 'label' => 'First Name')); ?>
    <?php echo $form->input('last_name', array( 'label' => 'Last Name')); ?>
    <?php echo $form->input('phone', array( 'label' => 'Phone')); ?>
    <?php echo $form->input('email', array( 'label' => 'Email')); ?>
    <?php echo $form->input('zip', array( 'label' => 'Zip Code')); ?>
    <?php echo $form->input('wedding_date', array( 'label' => 'Wedding Date')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $form->end('Submit'); ?>
    </div>

</div>
    