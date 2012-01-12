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
<h2>Room Swap Requests</h2>
<?php

if(!$swaps)
{
	echo "No new notifications";
}
else
{
	foreach($swaps as $swap)
	{

		list($year,$month,$day) = explode('-', $swap->date);

		$date = date('l j F Y', mktime(0,0,0,$month,$day,$year));
	?>	

	<h3><?php echo $swap->request_user;?> has requested <?php echo $swap->room_name;?> on <?php echo $date;?></h3>
	<a href="<?php echo site_url();?>/booking/swapconfirm/<?php echo $swap->booking_id;?>/<?php echo $swap->request_user;?>/<?php echo $swap->room_name;?>/<?php echo $date;?>" class="button green">Yes</a>
		<a href="<?php echo site_url();?>/booking/swapdecline/<?php echo $swap->booking_id;?>/<?php echo $swap->request_user;?>/<?php echo $swap->room_name;?>/<?php echo $date;?>" class="button red">No</a>


	<?php }
}

	


