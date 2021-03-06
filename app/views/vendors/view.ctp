<?php echo $this->Paginator->options(array('url' => $this->passedArgs)); ?>

<div class="info">
    <h4>Vendor Info</h4>
    <p>
	Vendor ID: <?php echo $c['Vendor']['id']; ?><br/>
	<?php echo $form->create('Vendor', array('action' => 'edit/'.$c['Vendor']['id'])); ?>
	<?php echo $form->input('name', array( 'label' => 'Name: ')); ?>
	<?php echo $form->input('phone', array( 'label' => 'Phone: ')); ?>
	<?php echo $form->input('email', array( 'label' => 'Email: ')); ?>
	<?php echo $form->input('address1', array( 'label' => 'Address 1: ')); ?>
	<?php echo $form->input('address2', array( 'label' => 'Address 2: ')); ?>
	<?php echo $form->input('city', array( 'label' => 'City: ')); ?>
	<?php echo $form->input('state', array( 'label' => 'State: ')); ?>
	<?php echo $form->input('zip', array( 'label' => 'Zip Code: ')); ?>
	<?php echo $form->input('active', array( 'label' => 'Active')); ?>
	<?php echo $form->input('contact_name', array( 'label' => 'Contact Name: ')); ?>
	<?php echo $form->input('leads_per_week', array( 'label' => 'Leads per Week: ')); ?>
	<?php echo $form->input('notes', array( 'label' => 'Notes: <br/>')); ?>
    </p>
</div>

<div class="info">
    <h4>Industry Selections</h4>
    <p>
	<?php echo $form->input('category_id', array( 'label' => 'Industry: ')); ?>
	<span style="font-size:.7em;">Note: click save after changing industry to reload price ranges.</span><br/>
	<?php echo $form->input('Range', array( 'label' => 'Price Ranges: <br/>','multiple'=>'checkbox')); ?>
	<?php echo $form->input('id', array( 'type'=>'hidden')); ?>
	<?php echo $form->end('Save'); ?>
    </p>
</div>

<div class="info">
    Total Leads: <?php echo $c['Vendor']['total_all']; ?><br/>
    Unbilled Leads: <?php echo $c['Vendor']['total_bill']; ?>
</div>
<br/>

<div style="float:right;width:130px;">
	    <a href="/vendors/delete/<?php echo $c['Vendor']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this?')"><div class="but co" style="width:120px;">
	        <p style="color:white;">Remove Vendor</p>
	    </div></a>
</div>

<?php if ($w == 'leads') { ?>

<a href="/vendors/view/<?php echo $c['Vendor']['id']; ?>/leads" style="text-decoration:none;"><div style="background-color:rgb(162,202,102);border:2px solid rgb(126,157,75);" class="approved">
    <p style="color:white;">Lead History</p>
</div></a>
<a href="/vendors/view/<?php echo $c['Vendor']['id']; ?>/billing" style="text-decoration:none;"><div style="background-color:#ffffff;border:2px solid rgb(162,202,102);" class="approved">
    <p style="color:black;">Billing History</p>
</div></a>

<table class="grid">
    <tr>
	<th>
            Date Submitted
        </th>
	<th>
            Bride ID
        </th>
        <th>
            First Name
        </th>
	<th>
            Last Name
        </th>
	<th>
	    Zip
	</th>
	<th>
	    Email
	</th>
	<th>
	    Phone
	</th>
	<th>
	    Price of the Lead
	</th>
    </tr>
    <?php
    $g = 1;
    foreach ($b as $b) {
	
	if ($g%2>0) {
	    $class = 'row1';
	} else {
	    $class = 'row2';
	}
	$g++;
    ?>
    <tr class="<?php echo $class; ?>">
        <td>
            <?php echo date('m-j-Y',strtotime($b['Record']['created'])); ?>
        </td>
        <td>
	    <a href="/clients/view/<?php echo $b['Record']['client_id']; ?>"><?php printf("%06s", $b['Record']['client_id']); ?></a>
        </td>
	<td>
	    <?php echo $b['Client']['first_name']; ?>
	</td>
	<td>
	    <?php echo $b['Client']['last_name']; ?>
	</td>
	<td>
	    <?php echo $b['Client']['zip']; ?>
	</td>
	<td>
	    <?php echo $b['Client']['email']; ?>
	</td>
	<td>
	    <?php echo $b['Client']['phone']; ?>
	</td>
	<td>
	    $<?php echo $price; ?>
	</td>
    </tr>
    <?php } ?>
</table>

<?php } else { ?>

<a href="/vendors/view/<?php echo $c['Vendor']['id']; ?>/leads" style="text-decoration:none;"><div style="background-color:#ffffff;border:2px solid rgb(162,202,102);" class="approved">
    <p style="color:black;">Lead History</p>
</div></a>
<a href="/vendors/view/<?php echo $c['Vendor']['id']; ?>/billing" style="text-decoration:none;"><div style="background-color:rgb(162,202,102);border:2px solid rgb(126,157,75);" class="approved">
    <p style="color:white;">Billing History</p>
</div></a>

<table class="grid">
    <tr>
	<th>
           Paid [yes/no]
        </th>
	<th>
            Week
        </th>
        <th>
            # of Leads
        </th>
	<th>
            Balance
        </th>
	<th class="hid" style="width:120px;">
            
        </th>
    </tr>
    <?php
    $g = 1;
    foreach ($h as $h) {
	
	if ($g%2>0) {
	    $class = 'row1';
	} else {
	    $class = 'row2';
	}
	$g++;
    ?>
    <tr class="<?php echo $class; ?>">
        <td>
            <?php
		if ($h['Bill']['paid']=='1') {
		    echo 'yes';
		} else {
		    echo 'no';
		}
	    ?>
        </td>
	<td>
	    <?php echo $h['Bill']['week_start'].' - '.$h['Bill']['week_end']; ?>
	</td>
	<td>
	    <?php echo $h['Bill']['leads']; ?>
	</td>
	<td>
	    $<?php echo $h['Bill']['total']; ?>
	</td>
	<td class="hid">
	    <?php if ($h['Bill']['paid']=='0') { ?>
		<a href="/vendors/paid/<?php echo $h['Bill']['id']; ?>" style="text-decoration:none;"><div class="but co">
		    <p style="color:white;">Mark Paid</p>
		</div></a>
	    <?php } else { ?>
		<a href="/vendors/paid/<?php echo $h['Bill']['id']; ?>" style="text-decoration:none;"><div class="but co">
		    <p style="color:white;">Mark Unpaid</p>
		</div></a>
	    <?php } ?>
	</td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
<div class="nav" style="text-align:center;width:100%;">
    <!-- Shows the page numbers -->
    <?php echo $this->Paginator->prev('<< Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next('Next >>', null, null, array('class' => 'disabled')); ?>
    <br/>
    <!-- prints X of Y, where X is current page and Y is number of pages -->
    <?php echo $this->Paginator->counter(); ?>
</div>
<br/>