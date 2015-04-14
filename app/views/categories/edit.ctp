<h3>Edit Industry</h3>
<span style="font-size:.8em;"><a href="/categories">Back to Industries</a></span>
<br/><br/>
    
    <?php echo $form->create('Category', array('action' => 'edit/'.$id)); ?>
    <?php echo $form->input('name', array( 'label' => 'Name: ')); ?>
    <?php echo $form->input('use_ranges', array( 'label' => 'Use Price Ranges')); ?>
    <?php echo $form->input('enable', array( 'label' => 'Enable')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $form->end('Save'); ?>
    