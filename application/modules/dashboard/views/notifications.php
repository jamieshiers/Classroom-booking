<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/



?>

<h1>Notifications</h1>

<?php

if($swaps)
{

	echo "<h2>Room Swap Requests</h2>";echo "<hr />";

	foreach($swaps as $swap)
	{

		list($year,$month,$day) = explode('-', $swap->date);

		$date = date('l j F Y', mktime(0,0,0,$month,$day,$year));
	?>	

	    <div class="notification">
	    <h3><?php echo $swap->request_user;?> has requested <?php echo $swap->room_name;?><br /> <small>on <?php echo $date;?> - <?php echo $swap->periods;?></small></h3>
	    <div class="decide">
	       <center>Want to swap rooms?</center>
	        <a href="<?php echo site_url();?>/booking/swapconfirm/<?php echo $swap->booking_id;?>/<?php echo $swap->request_user;?>/<?php echo $swap->room_name;?>/<?php echo $date;?>" class="button green">Yes</a>
	        <span>or</span>
	         <a href="<?php echo site_url();?>/booking/swapdecline/<?php echo $swap->booking_id;?>/<?php echo $swap->request_user;?>/<?php echo $swap->room_name;?>/<?php echo $date;?>" class="button red">No</a>

	    </div>
	</div>
	<?php
	

	}

}
if($room_admin)
{
	echo "<h2 class='notification_heading'>Bookings requiring approval</h2>";echo "<hr />";

	foreach($room_admin as $admin)
	{
		
		list($year,$month,$day) = explode('-', $admin->date);

		$date_admin = date('l j F Y', mktime(0,0,0,$month,$day,$year));
	?>
	<div class="notification">
	    <h3><?php echo $admin->user;?> has booked <?php echo $admin->room_name;?><br /> <small>on <?php echo $date_admin;?> - <?php echo $admin->period_name;?></small></h3>
	    <div class="decide">
	       <center>Approve this booking?</center>
	        <a href="<?php echo site_url();?>/booking/adminconfirm/<?php echo $admin->id;?>/<?php echo $date_admin?>" class="button green">Yes</a>
	        <span>or</span>
	         <a href="<?php echo site_url();?>/booking/admindecline/<?php echo $admin->id;?>/<?php echo $date_admin;?>" class="button red">No</a>

	    </div>
	</div>


	<?php }
}

	


