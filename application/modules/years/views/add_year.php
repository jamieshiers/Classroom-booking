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

<h2>Add Year Group</h2>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>

<div class="form" id="add_subject">
	
	<?php
	
	echo form_open('years/years/add_year'); 
	echo form_label('Year Group Name:');
	echo form_input('years');
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Add Year Group',
	    );
	echo form_submit($data); 
	echo form_close();
	
	?>
	
</div>