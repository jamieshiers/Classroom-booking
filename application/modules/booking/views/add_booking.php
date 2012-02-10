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

<div style="padding:20px;">


	<?php echo form_open('booking/booking/add/'.$room.'/'.$date.'/'.$period.'/'.$week)?>
	
	<?php
	
	if($room_info->admin !== NULL)
	{
		echo "<div class='room_admin'>";
		echo "<p>Your booking will be approved by ".$room_info->admin."</p>";
		echo "</div>";
		echo form_hidden('admin', '1');
		echo form_hidden('admin_user', $room_info->admin);
	}
	
	?>
	<label for="Class">Year Group</label>
	
	<?php 
		
										
	$year_groups = array(); 
	
	foreach($years as $year)
	{
		$year_groups[$year['year_name']] = $year['year_name'];
	}
	
	
	
	
	echo form_dropdown('Class', $year_groups, 'select'); ?><br />
	<label for="Lesson"> Lesson:</label>
	<select name="Lesson">
	<?php 
	
	foreach($subjects as $subject)
	{
		echo "<option>".$subject->subject."</option>";
	}
	echo "</select>"; echo "<br />";
	
	
	
	if($this->session->userdata('accesslevel') == 'admin')
	{
		echo form_label('Block Booking'); 
		echo form_checkbox('booking'); 
	}
	
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Add Booking',
	    );
	echo form_submit($data);
	echo form_close();
	?>
</div>
