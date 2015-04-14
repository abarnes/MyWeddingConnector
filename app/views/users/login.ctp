<style>
    .d {
        width:260px;
        text-align:center;
        margin-right:auto;
        margin-left:auto;
        margin-top:130px;
        border:2px solid rgb(110,163,211);
        font-family:'Calibri','Arial';
    }
    input {
        margin-top:7px;
        margin-bottom:7px;
        border:2px solid rgb(110,163,211);
        font-size:1.5em;
        width:210px;
    }
    .submit input {
        width:150px;
        font-size:1em;
        color: #ffffff;
        background: rgb(85,147,204);
    }
    h4 {
        color:red;
    }
</style>

<script type="text/javascript">
$(document).ready(function() {
  $('#corner').corner("28px");
  $('.g').corner();
});
</script>

<div class="d" id="corner">
    <h2>Control Panel</h2>
    <h4><?php echo $session->flash(); ?></h4>
    <h4><?php echo $session->flash('auth'); ?></h4>
<?php echo $form->create('User', array('action' => 'login'));
    echo $form->input('username', array( 'label' => 'Username: <br/>'));
    echo $form->input('password', array('label'=>'Password: <br/>'));
    echo $form->end(array('label'=>'Sign In','class'=>'g')); ?>
</div>