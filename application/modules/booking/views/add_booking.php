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




	<?php echo form_open('booking/booking/add/'.$room.'/'.$date.'/'.$period.'/'.$week)?>
	<label for="Class">Year Group</label>
	
	<?php $years = array(
						'Select' => 'Select a Year Group',
						'Year 7' => 'Year 7', 
						'Year 8' => 'Year 8', 
						'Year 9' => 'Year 9', 
						'Year 10'=> 'Year 10', 
						'Year 11'=> 'Year 11', 
						'Year 12'=> 'Year 12', 
						'Year 13'=> 'Year 13'
						);
	
	
	echo form_dropdown('Class', $years, 'select'); ?><br />
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
		echo form_checkbox('booking'); echo "<br />";
	}
	
	echo "<br />";
	echo form_submit('submit', 'Create Booking');
	echo form_close();
	?>
