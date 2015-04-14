<h3>Select Vendors for this Price Range</h3>
<h5><?php echo $name; ?></h5>
    
<div style="width:45%;float:left;">    
    
    <?php echo $form->create('Range', array('action' => 'select/'.$id)); ?>
    <?php //echo $form->input('low_end', array( 'label' => 'Low End')); ?>
    <?php //echo $form->input('high_end', array( 'label' => 'High End')); ?>
    <?php //echo $form->input('category_id', array( 'label' => 'Category')); ?>
    <?php echo $form->input('Vendor', array( 'label' => 'Vendors: <br/>','multiple'=>'checkbox')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?><br/>
    <?php echo $form->end('Submit Vendors'); ?>

</div>

<div style="width:55%;float:right;font-size:.8em;">
    
</div>
    