<?php echo $this->Paginator->options(array('url' => $this->passedArgs)); ?>

<script type="text/javascript">
$(document).ready(function() {
  $('.co').corner();
});
</script>

<table class="grid">
    <tr>
	<th class="hid">
            
        </th>
        <th>
            <?php echo $this->Paginator->sort('First Name', 'Client.first_name'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('Last Name', 'Client.last_name'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('Email', 'Client.email'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('Phone', 'Client.phone'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('Zip', 'Client.zip'); ?>
        </th>
        <th>
            <?php echo $this->Paginator->sort('Wedding Date', 'Client.wedding_date'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('Time Submitted', 'Client.created'); ?>
        </th>
        <!--<th>
            Action
	</th>-->
    </tr>
    <?php
    $c = 1;
    foreach ($clients as $u) {
	
	if ($c%2>0) {
	    $class = 'row1';
	} else {
	    $class = 'row2';
	}
	$c++;
    ?>
    <tr class="<?php echo $class; ?>">
        <td class="hid" style="width:140px;">
            <a href="/clients/approve/<?php echo $u['Client']['id']; ?>" style="text-decoration:none;"><div class="but2 co" style="background-color:rgb(162,202,102);border:2px solid rgb(126,157,75);">
	        <p style="color:white;">Approve</p>
	    </div></a>
	    <a href="/clients/reject/<?php echo $u['Client']['id']; ?>" style="text-decoration:none;"><div class="but2 co" style="background-color:rgb(217,91,88);border:2px solid rgb(169,66,63);">
	        <p style="color:white;">Reject</p>
	    </div></a>
        </td>
	<td>
	    <?php echo $u['Client']['first_name']; ?>
	</td>
	<td>
	    <?php echo $u['Client']['last_name']; ?>
	</td>
	<td>
            <?php echo '<a href="mailto:'.$u['Client']['email'].'">'.$u['Client']['email'].'</a>'; ?>
        </td>
	<td>
	    <?php echo $u['Client']['phone']; ?>
	</td>
	<td>
	    <?php echo $u['Client']['zip']; ?>
	</td>
        <td>
            <?php echo date('m-j-Y',strtotime($u['Client']['wedding_date'])); ?>
        </td>
	<td>
            <?php echo date('g:ia m-j-Y',strtotime($u['Client']['created'])); ?>
        </td>
        <!--<td>
	    <?php /*echo $html->link('Approve',array('action'=>'approve/'.$u['Client']['id'])); ?>
	    <?php echo $html->link('View',array('action'=>'view/'.$u['Client']['id'])); ?>
            <?php echo $html->link('Edit',array('action'=>'edit/'.$u['Client']['id'])); ?>
            <?php echo $html->link(
				'Delete', 
				array('controller'=>'clients','action'=>'delete/'.$u['Client']['id']), 
				null, 
				'Are You Sure You Want To Delete This Person?'
			);*/ ?>
        </td>-->
    </tr>
    <?php } ?>
</table>
<br/>
<div class="nav" style="text-align:center;width:100%;">
    <!-- Shows the page numbers -->
    <?php echo $this->Paginator->prev('<< Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next('Next >>', null, null, array('class' => 'disabled')); ?>
    <br/>
    <!-- prints X of Y, where X is current page and Y is number of pages -->
    <?php echo $this->Paginator->counter(); ?>
</div>