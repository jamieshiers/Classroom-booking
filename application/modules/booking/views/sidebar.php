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

<h2>Calendar</h2>

<div class="datepicker"></div>

<h2>Key</h2>

<div id="normal_booking" style="padding:10px;">
	<p>Individual Booking</p>
</div>
<div id="block_booking" style="padding:10px; margin-top:10px;">
	<p>Timetabled Lesson</p>
</div>
<div id="temp_booking" style="padding:10px; margin-top:10px;">
	<p>Awaiting Approval</p>
</div>



<div class="sidebar_title"><h2>My Bookings</h2></div>


<?php

if(!$bookingss)
{
	echo "<p><i>No Upcoming Bookings</i></p>";

}
else
{

	foreach($bookingss as $booking)
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





