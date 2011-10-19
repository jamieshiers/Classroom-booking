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

<h2>Add New Period</h2>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>

<div class="form" id="add_period">
	
	<?php
	
	echo form_open('period/add_period'); 
	echo form_label('Name:');
	echo form_input('name');
	//---------------------START TIME--------------------------------------------
	$start_hour = array( 
		'name' => 'start_hour', 
		'size' => "1", 
		'maxlength' => '2',
		'style' => 'display:inline-block;'
		);
	$start_minute = array( 
		'name' => 'start_minute', 
		'size' => "1", 
		'maxlength' => '2',
		'style' => 'display:inline-block;'
		);
	echo form_label('Start Time:'); 
	echo form_input($start_hour); echo ":";
	echo form_input($start_minute);echo "<br />";
	//--------------------END TIME------------------------------------------------
	$end_hour = array( 
		'name' => 'end_hour',
		'size' => "1", 
		'maxlength' => '2',
		'style' => 'display:inline-block;'
		);
	$end_minute = array( 
		'name' => 'end_minute', 
		'size' => "1", 
		'maxlength' => '2',
		'style' => 'display:inline-block;'
		);
	echo form_label('End Time:'); 
	echo form_input($end_hour); echo ":";
	echo form_input($end_minute); echo "<br />";
	echo form_label('Bookable:');
	echo form_checkbox('bookable', 'accept');
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Add Period',
	    );
	echo form_submit($data); 
	echo form_close();
	
	?>
	
</div>