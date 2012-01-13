
	
	
	<!-- Find out the week number -->
	<?php 
	list($year,$month,$day) = explode('-', $date);
	// Will either be 1 or 2
	//$weeknum = date('W',mktime(0,0,0,$month,$day,$year)) % 2 + 1;
	$weeknum = ltrim(date('W',mktime(0,0,0,$month,$day,$year)), "0");
	?>
	
</h1>


<!-- Show a navigation menu, allowing users to browse backwards or forwards one week
	or one month at a time for the chosen item -->
	<div class="week_bar">
	<h5 align="center">
		<?php list($year,$month,$day) = explode('-', $date); ?>
		
		
			
			<!-- Next Week -->
			<?php echo $item->name;?>
		<big><?php echo '- Week Commencing '.date('jS F', mktime(0,0,0,$month,$day,$year)).'<i> - Week '.$weeks['weeknums'][$weeknum].'</i>';; ?> </big>
		
</div>
	<?php list($year,$month,$day) = explode('-', $date); ?>
	
	
	

	
	
	<br />
	<?php
	if (isset($weeks['yearname'])) {
		//echo $weeks['yearname'];
		
		if ($settings['no_weeks'] == 2) { 
			if ($weeks['weeknums'][$weeknum] == 1) {
				if ($settings['week1_name'] != '') {
					//echo '<i> - '.$settings['week1_name'].'</i>';
				} else {
					//echo '<i> - Week One</i>';
				}
			} elseif ($weeks['weeknums'][$weeknum] == 2) {
				if ($settings['week2_name'] != '') {
					//echo '<i> - '.$settings['week2_name'].'</i>';
				} else {
					//echo '<i> - Week Two</i>';
				}
			}
		}
		if ($weeks['weeknums'][$weeknum] != 1 && $weeks['weeknums'][$weeknum] != 2) {
			
		}
	} else {
		echo '<i>Not in academic year</i>';
	}
	?>
		
</h2>



<table width="100%" cellpadding="5px" id="page-help">
	
	<!-- Only 5 columns, Mon-Fri - This is hard coded for now, but may allow flexibility
		in a future version -->
	<tr class="booking">
		<th width="17%">&nbsp;</th>
		<th width="17%">Monday</th>
		<th width="17%">Tuesday</th>
		<th width="17%">Wednesday</th>
		<th width="16%">Thursday</th>
		<th width="16%">Friday</th>
	</tr>
	
	
	<!-- We have a list of all the periods, so we loop through each one individually
		to create the row for that period -->
	<?php foreach ($periods as $period) {?>
	
	<!-- Periods that are bookable have a height set larger as they need to hold info -->
	<tr 
		<?php 
		if ($period->bookable == true) {
			echo 'style="height:70px;"';
		} else {
			echo 'class="booking-thin"';
		}
		?>
	>
	
		<!-- Print the period name, and small italic print of the times for that period -->
		<td>
		<?php
			echo $period->period_name.'<br />';
			if ($period->bookable == true) {
				echo '<i><small>'.$period->start_time.' - '.$period->end_time.'</small></i>';
			}
		?></td>
		
		<!-- For each period we need to loop through 5 times (5 days, Mon-Fri) to see if
			there is a booking -->
		<?php for ($i = 0; $i <= 4; $i++) {
			echo '<td align="center"';
			?>
			<?php
			$bookable = 1; // Needs to be reset to 1 each time the loop is run
			
			// The date is the start date of the week, i.e. Mon 20th
			// This breaks it apart and adds one on the date for each loop, so Tues becomes
			// 21st, Wed 22nd etc etc before stitching it back together to be echoed
			list($year,$month,$day) = explode('-', $date);
			$time = mktime(0,0,0,$month,$day+$i,$year);
			$newdate = date('Y-m-d', $time);
			
			// For each loop there may be a maximum of column x row of bookings to run through
			// For example, 5 days (columns) x 5 periods (rows) will give a maximum of 25
			// We need to loop through each one to see if it is the correct period/day and if
			// so insert it
			foreach ($bookings as $booking) {
				$bookable = 1;
				
				if (isset($weeks['yearname']) && ($weeks['weeknums'][$weeknum] == 1 || $weeks['weeknums'][$weeknum] == 2)) {
				
					// Find all bookings that are block bookings for this item.
					if ($booking->block == true) {
						// Split down the date to figure out which day the block booking should
						// appear on, i.e. Fri which would return the number 5. Because our loop starts
						// at 0, we need to subtract one from the figure
						list($tmpyear,$tmpmonth,$tmpday) = explode('-', $booking->date);
						$daynum = date('w',mktime(0,0,0,$tmpmonth,$tmpday,$tmpyear)) - 1;
					}
					
					// If the current loop matches the exact and period, or is block booking and
					// matches the day number and period, we echo it to the table 
					if ($booking->period_id == $period->periodid && $booking->date == $newdate || $booking->block == true && $booking->period_id == $period->periodid && $daynum == $i && $weeks['yearid'] == $booking->year_id) {
						if($settings['no_weeks'] == 2 && $booking->week_num == $weeks['weeknums'][$weeknum] || $settings['no_weeks'] == 1) {
							// Find out if the user wants booked lessons to be shaded differently
							
							
							if ($booking->block == true)
							{
								echo '<div id="block_booking">';
							}
							else
							{
								echo '<div id="normal_booking">';
							}
						
							//echo '<p>'.$booking->class.'<br />'.$booking->lesson.'<br /><br />'.$booking->user.'</p>';
							echo "<p>". $booking->class."</p>"; 
							echo "<p>". $booking->lesson."</p>"; 
							echo "<p class='lowercase'>". $booking->user."</p>"; 
							
							
							
							
							if($this->session->userdata('logged_in') == $booking->user || $this->session->userdata('accesslevel') == 'admin' || $booking->block == false)
							{
								echo '<a id="page-help" href="'.site_url().'/booking/booking/info/'.$booking->id.'"  class="colorbox"><img src="'.base_url().'images/icons/info.png"></a>';
							}		
							echo '</div>';
							// This cell is not bookable now, so we mark it as such and break
							$bookable = 0;
							break; // No point in keep looping, we've already found our booking for today
						}
					}
				}
			} 
			
			// However, if a booking has not been found, and this cell is marked as bookable
			// we will show an add link, allowing the user to book this available space
			if (!isset($weeks['yearname'])) {
				echo '<div style="color:#CCC;"><small><i>This week does not fall under any configured academic year, and therefore cannot be booked</i></small></div>';
			} elseif ($bookable == 1 && $period->bookable == true && $this->session->userdata('logged_in') && ($weeks['weeknums'][$weeknum] == 1 || $weeks['weeknums'][$weeknum] == 2)) {
				
				
				echo '<a href="'.site_url().'"</a>';
				
				echo '<a href="'.site_url().'/booking/booking/add/'.$item->roomid.'/'.$newdate.'/'.$period->periodid.'/'.$weeks['weeknums'][$weeknum].'/'.$weeks['yearid'].'" border="0" title="" class="colorbox button green">Add Booking</a>';

				
				
				
			}  elseif ($weeks['weeknums'][$weeknum] != 1 && $weeks['weeknums'][$weeknum] != 2) {
				echo '<div style="color:#CCC;"><small><i>This week has been marked as a holiday and cannot be booked</i></small></div>';
			}
			?>
		<?php 
			echo '</td>';
		} ?>
	</tr>
	<?php } ?>	
</table>


