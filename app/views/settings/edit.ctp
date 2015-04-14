<h3>Change Settings</h3>
        
        <div class="link">
        <?php //echo $html->link('<< Manage Categories',array('controller'=>'categories','action'=>'index')); ?>
        </div><br/>
        
<div style="width:60%;">
    
    <div class="label">
    <?php echo $form->create('Setting', array('action' => 'edit')); ?>
    <?php echo $form->input('from_email', array( 'label' => 'From email address')); ?>
    <?php echo $form->input('replyto_email', array( 'label' => 'Reply To email address')); ?>
    <?php echo $form->input('site_url', array( 'label' => 'Site URL')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $form->end('Save Changes'); ?>
    </div>

</div>
    