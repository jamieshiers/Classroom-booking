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



<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>

<div class="form" id="add_holiday_form">
	<?php echo form_open('holiday/holiday/add_holiday')?>
	<label for="name"> Holiday Name:
	<?php echo form_input('name'); ?></label><br />
	<?php $date_start = array(
	              'name'        => 'date_start',
	              'class'       => 'datepicker',
	            );?>
	
	<label for="date_start"> Start Date:
	<?php echo form_input($date_start); ?></label><br /> 
	<?php $data = array('name' => 'date_end', 'class' => 'datepicker');?>
	<label for="date_end"> End Date:
	<?php echo form_input($data); ?></label><br />
	<?php echo form_submit('submit', 'Create Holiday');
	echo form_close();
	?>
	
</div>