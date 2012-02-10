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

<h1>Add Room</h1>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>

<div class="form" id="add_room">
	
	<?php
	
	echo form_open('rooms/rooms/add_room'); 
	echo form_label('Room Name');
	echo form_input('name');
	echo form_label('Room Admin');
	echo form_input('admin');
	echo form_label('Bookable'); 
	echo form_checkbox('bookable');
	
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Create Room',
	    );
	
	echo form_submit($data); 
	echo form_close();
	
	?>
	
</div>