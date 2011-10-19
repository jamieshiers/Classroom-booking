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

<div id="booking_info">
	<?php
		foreach($bookings as $booking)
		{
			
		
			if ($this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('logged_in') == $booking->user)
			{
			
				echo '<a href="'.site_url().'/booking/booking/delete/'.$booking->id.'" class="btn delete">Cancel Booking</a><br \>';
			
			}
			
			if($booking->block == 0)
			{
				echo '<a id="page-help" href="'.site_url().'/booking/booking/swap/'.$booking->id.'" class="btn swap" title="Room Swap Details">Request Room</a>';
			}
			
		}
	
	?>
</div>