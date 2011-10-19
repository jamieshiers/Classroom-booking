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

<div class="sidebar_title"><h2>Date</h2></div>

<div class="container">
<h3>Today's Date:</h3>
<p><?php echo date('D jS F Y') ;?></p>
<h3>Week Commencing:</h3>
<p><?php echo date('D jS F Y', mktime(0,0,0,date('m'), date('d')-date('w')+1, date('Y'))); ;?></p>

</div>

<div class="sidebar_title"><h2>My Bookings</h2></div>
<div class="container">

<?php

if($bookings == FALSE)
{
	echo '<i>No Upcoming Bookings</i>';

}
else
{

	foreach($bookings as $booking)
	{
		echo '<div class="booking_widget">'; 
		echo '<a href="'.site_url().'/booking/booking/view/'.$booking->room_id.'/'.$booking->date.'"><p>';
		echo "<b>".$booking->name."</b> - <i>". date('d-m-Y',strtotime($booking->date))."</i>"; echo "<br />";
		echo date('l',strtotime($booking->date))." ". $booking->period_name ." <i>(". $booking->start_time ." - ". $booking->end_time .")</i>"; echo "<br />";
		echo $booking->lesson.' '. $booking->class; echo "<br />";
		echo "</p></a>";
		echo "</div>";
	}
}


?>

</div>




