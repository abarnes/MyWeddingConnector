<div style="width:45%;float:left;"> 

    <h3>Add Price Range - <?php echo $name; ?></h3>
    <span style="font-size:.8em;"><a href="/ranges/index/<?php echo $id; ?>">Back to Price Ranges</a></span>
    <br/><br/>   
    
    <?php echo $form->create('Range', array('action' => 'add/'.$id)); ?>
    <?php echo $form->input('low_end', array( 'label' => 'Low End: ')); ?>
    <?php echo $form->input('high_end', array( 'label' => 'High End: ')); ?>
    <?php //echo $form->input('category_id', array( 'label' => 'Category')); ?>
    <?php //echo $form->input('Vendor', array( 'label' => 'Vendors')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?><br/>
    <?php echo $form->end('Add Price Range'); ?>

</div>

<div style="width:55%;float:right;font-size:.8em;">
    <br/>
    <h4>Range</h4>
    <p>No dollar sign ($) on ranges.</p>
    
    <p>On the next page you can select vendors in this range</p>
    
    <?php if (!empty($r)) { ?>
    <h4>Existing Ranges</h4>
        <?php foreach ($r as $r) {
            echo $r['Range']['name'].'<br/>';   
        }
    }
    ?>
</div>
    