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


<h2>Edit Holiday</h2>

<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>
<?php foreach($holiday as $hol) {?>
<div class="form" id="edit_holiday_form">
	<?php echo form_open('holiday/holiday/edit_holiday/'.$hol['id'])?>
	<label for="name"> Holiday Name:
	<?php echo form_input('name', $hol['name']); ?></label><br />
	<label for="date_start"> Start Date:
		<?php $date_start = array(
		              'name'        => 'date_start',
		              'class'       => 'datepicker',
					  'value' 		=> $hol['date_start']
		            );?>
	<?php echo form_input($date_start); ?></label><br />
	<label for="date_end"> End Date:
		<?php $date_end = array(
		              'name'        => 'date_end',
		              'class'       => 'datepicker',
					  'value' 		=> $hol['date_end']
		            );?>
	<?php echo form_input($date_end); ?></label><br />
	<?php echo form_submit('submit', 'Edit Holiday');
	echo form_close();
	?>
<?php } ?>	
</div>