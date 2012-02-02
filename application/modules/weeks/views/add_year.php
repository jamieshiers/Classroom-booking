<h2>Add Academic Year</h2>

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
		echo form_input($end); 
		$data = array(
		    'name'        => 'submit',
		    'type'        => 'submit',
		    'class' 	  => 'button green',
			'value'		  => 'Save Year',
		    );
		echo form_submit($data);
		echo form_close();
		?>
