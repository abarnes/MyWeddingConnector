<?php echo $this->Paginator->options(array('url' => $this->passedArgs)); ?>
<script type="text/javascript">
$(document).ready(function() {
  $('.co').corner();
});
</script>

<h3>Manage Price Ranges - <?php echo $r['Category']['name']; ?></h3>
<span style="font-size:.8em;"><a href="/categories">Back to Industries</a></span>
<br/><br/>

<a href="/ranges/add/<?php echo $r['Category']['id']; ?>" style="text-decoration:none;"><div style="background-color:rgb(162,202,102);border:2px solid rgb(126,157,75);" class="approved co">
    <p style="color:white;">+ Add Price Range</p>
</div></a>
<br/>

<table class="grid">
    <tr>
	<th>
	    <?php echo $this->Paginator->sort('Low End', 'Range.low_end'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('High End', 'Range.high_end'); ?>
        </th>
        <th class="hid" style="width:280px;">
            
        </th>
    </tr>
    <?php
    $c = 1;
    foreach ($ranges as $u) {
	
	if ($c%2>0) {
	    $class = 'row1';
	} else {
	    $class = 'row2';
	}
	$c++;
    ?>
    <tr class="<?php echo $class; ?>">
	<td>
	    $<?php echo $u['Range']['low_end']; ?>
	</td>
	<td>
	    $<?php echo $u['Range']['high_end']; ?>
	</td>
	
        <td class="hid">
	    <a href="/ranges/edit/<?php echo $u['Range']['id']; ?>" style="text-decoration:none;"><div class="but co">
	        <p style="color:white;">Edit</p>
	    </div></a>
	    <a href="/ranges/delete/<?php echo $u['Range']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this?')"><div class="but co">
	        <p style="color:white;">Remove</p>
	    </div></a>
	    
            <?php //echo $html->link('Edit',array('action'=>'edit/'.$u['Category']['id'])); ?>
            <?php /*echo $html->link(
				'Delete', 
				array('controller'=>'clients','action'=>'delete/'.$u['Category']['id']), 
				null, 
				'Are You Sure You Want To Delete This Category?'
			);*/ ?>
        </td>
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