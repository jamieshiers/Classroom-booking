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


<h1>Edit Holiday</h1>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>
<?php foreach($holiday as $hol) {?>
<div class="form" id="edit_holiday_form">
	<?php echo form_open('holiday/holiday/edit_holiday/'.$hol['id']);
	echo form_label('Holiday Name');
	echo form_input('name', $hol['name']); 
	echo form_label('Start Date');
	$date_start = array(
		              'name'        => 'date_start',
		              'class'       => 'datepicker',
					  'value' 		=> $hol['date_start']
		            );
	echo form_input($date_start);
	echo form_label('End Date');
	$date_end = array(
		              'name'        => 'date_end',
		              'class'       => 'datepicker',
					  'value' 		=> $hol['date_end']
		            );?>
	<?php echo form_input($date_end); 
	$data = array(
	    'name'        => 'submit',
	    'type'        => 'submit',
	    'class' 	  => 'button green',
		'value'		  => 'Edit Holiday',
	    );
	echo form_submit($data);
	echo form_close();
	?>
<?php } ?>	
</div>