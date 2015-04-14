<h3>Add Vendor</h3>

<div style="width:100%;float:left;">    

    <?php echo $form->create('Vendor', array('action' => 'add/'.$cat)); ?>
    <?php echo $form->input('name', array( 'label' => 'Name: ')); ?>
    <?php //echo $form->input('category_id', array( 'label' => 'Category: ')); ?>
    <?php echo $form->input('phone', array( 'label' => 'Phone: ')); ?>
    <?php echo $form->input('email', array( 'label' => 'Email: ')); ?>
    <?php echo $form->input('address1', array( 'label' => 'Address 1: ')); ?>
    <?php echo $form->input('address2', array( 'label' => 'Address 2: ')); ?>
    <?php echo $form->input('city', array( 'label' => 'City: ')); ?>
    <?php echo $form->input('state', array( 'label' => 'State: ')); ?>
    <?php echo $form->input('zip', array( 'label' => 'Zip Code: ')); ?>
    <?php echo $form->input('contact_name', array( 'label' => 'Contact Name: ')); ?>
    <?php echo $form->input('notes', array( 'label' => 'Notes: <br/>')); ?>
    <?php echo $form->input('leads_per_week', array( 'label' => 'Maximum Leads/Week: <br/>')); ?>
    <?php if (!empty($ranges)) { ?>
    <?php echo $form->input('Range', array( 'label' => 'Price Ranges: <br/>','multiple'=>'checkbox')); ?>
    <?php } ?>
    <?php echo $form->end('Add Vendor'); ?>

</div>
    