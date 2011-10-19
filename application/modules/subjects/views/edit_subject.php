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

<h2>Edit Subject</h2>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>

<div class="form" id="edit_subject">
	
	<?php foreach($subject as $p) {  

	echo form_open('subjects/subjects/edit_subject/'.$p['id']);
	echo form_label('Subject Name:');
	echo form_input('subject', $p['subject']);
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Edit Subject',
	    );
	echo form_submit($data); 
	echo form_close();
	
	?>
	<?php }?>
</div>