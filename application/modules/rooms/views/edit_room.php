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

<h1>Edit Room</h1>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>

<div class="form" id="edit_room">
	
	<?php foreach($room as $p) {  

	echo form_open('rooms/rooms/edit_room/'.$p['roomid']);
	echo form_label('Name:');
	echo form_input('name', $p['name']);
	echo form_label('Room Admin');
	echo form_input('admin', $p['admin']);
	
	if($p['bookable'] == 0)
	{
		$checked = "";
	}
	else
	{
		$checked = TRUE; 
	}
	echo form_label('Bookable:');
	echo form_checkbox('bookable', 'accept', $checked);
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Edit Room',
	    );
	
	echo form_submit($data);
	echo form_close();
	
	?>
	<?php }?>
</div>