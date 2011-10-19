<?php echo form_open('weeks/weeks/add_year');?>
<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>
	<label for="date_start" class="required">Start Date:</label>
	<?php
		$start = array(
			'name' 		=> 'date_start',
			'class' 	=> 'datepicker');
		echo form_input($start); echo "<br />";?> 
	<label for="date_end">End Date:</label> 
		<?php
		$end = array(
			'name' 		=> 'date_end',
			'class' 	=> 'datepicker');
		echo form_input($end); echo "<br />";
		echo form_submit('submit', 'Save');
		echo form_close();
		?>
