<?php 
	list($year,$month,$day) = explode('-', $date);
	$weeknum = ltrim(date('W',mktime(0,0,0,$month,$day,$year)), "0");
?>
<div class="week_bar">
	<h3 align="center">
	<?php 
	if(!isset($weeks['weeknums'][$weeknum]))
	{
		$week_num = "Not in academic year";
	}
	else
	{
		$week_num = $weeks['weeknums'][$weeknum];
	}
	
	list($year,$month,$day) = explode('-', $date); echo $item->name; echo '- Week Commencing '.date('jS F', mktime(0,0,0,$month,$day,$year)).' - Week '.$week_num; ?>
	</h3>	
</div>
<?php list($year,$month,$day) = explode('-', $date); ?>
<table width="100%">
	<tr class="booking">
		<th width="17%">&nbsp;</th>
		<th width="17%">Monday</th>
		<th width="17%">Tuesday</th>
		<th width="17%">Wednesday</th>
		<th width="16%">Thursday</th>
		<th width="16%">Friday</th>
	</tr>
	<?php foreach ($periods as $period) {?>
	<tr 
		<?php 
		if ($period->bookable == true) {
			echo 'style="height:70px;"';
		} else {
			echo 'class="booking-thin"';
		}
		?>
	>
	<td>
	<?php
	echo $period->period_name.'<br />';
	if ($period->bookable == true) 
	{
		echo '<i><small>'.$period->start_time.' - '.$period->end_time.'</small></i>';
	}?>
	</td>
	<?php for ($i = 0; $i <= 4; $i++) {
	echo '<td align="center"';
	$bookable = 1; 
	list($year,$month,$day) = explode('-', $date);
	$time = mktime(0,0,0,$month,$day+$i,$year);
	$newdate = date('Y-m-d', $time);
	foreach ($bookings as $booking) 
		{
			$bookable = 1;
			if (isset($weeks['yearname']) && ($weeks['weeknums'][$weeknum] == 1 || $weeks['weeknums'][$weeknum] == 2)) 		
			{
				if ($booking->block == true) 
				{
					list($tmpyear,$tmpmonth,$tmpday) = explode('-', $booking->date);
					$daynum = date('w',mktime(0,0,0,$tmpmonth,$tmpday,$tmpyear)) - 1;
				}
				if ($booking->period_id == $period->periodid && $booking->date == $newdate || $booking->block == true && $booking->period_id == $period->periodid && $daynum == $i && $weeks['yearid'] == $booking->year_id) 
				{
					if($settings['no_weeks'] == 2 && $booking->week_num == $weeks['weeknums'][$weeknum] || $settings['no_weeks'] == 1) 
					{
							if ($booking->block == 1)
							{
								echo 'id="block_booking"><a id="page-help" href="'.site_url().'/booking/booking/info/'.$booking->id.'"  class="colorbox">';
							}
							if($booking->block == 3)
							{
								echo 'id="temp_booking"><a id="page-help" href="'.site_url().'/booking/booking/info/'.$booking->id.'"  class="colorbox">';
							}
							if($booking->block == 0)
							{
								echo 'id="normal_booking"><a id="page-help" href="'.site_url().'/booking/booking/info/'.$booking->id.'"  class="colorbox">';
							}
							echo "<p>". $booking->class."</p>"; 
							echo "<p>". $booking->lesson."</p>"; 
							echo "<p class='lowercase'>". $booking->user."</p>"; 
							if($this->session->userdata('logged_in') == $booking->user || $this->session->userdata('accesslevel') == 'admin' || $booking->block == false)
							{
								echo '</a>';
							}		
							$bookable = 0;
							break; 
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


