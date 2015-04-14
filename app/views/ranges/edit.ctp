<div style="width:60%;float:left;">

<h3>Edit Price Range</h3>
<!--<span style="font-size:.8em;"><a href="/ranges/index/">Back to Price Ranges</a></span>
<br/><br/>-->
    
    <?php echo $form->create('Range', array('action' => 'edit/'.$id)); ?>
    <?php echo $form->input('low_end', array( 'label' => 'Low End: ')); ?>
    <?php echo $form->input('high_end', array( 'label' => 'High End: ')); ?>
    <?php //echo $form->input('category_id', array( 'label' => 'Category')); ?>
    <?php echo $form->input('Vendor', array( 'label' => 'Vendors: ','multiple'=>'checkbox')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $form->end('Update'); ?>

</div>

<div style="width:40%;float:right;">
    <h4>Price</h4>
    <p>No dollar sign ($) on ranges.</p>
    <br/><br/>
</div>
    