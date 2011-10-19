<?php echo form_open('weeks/weeks/add_week');?>

<h2>Add a New Week</h2>
<?php if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}
?>
	<label for="name" class="required">Name:</label>
	<?php
		echo form_input('name'); echo "<br />";
		
		foreach($monday as $day)
		{
			 
			
			echo form_checkbox('date[]', $day['date']);
			
			$temp_date = strtotime($day['date']); 
			$name = date("d M Y", $temp_date);
			 echo $name; echo "<br />"; 
			
		}
		
		echo form_submit('submit', 'Save');
		echo form_close(); 
		?> 
		
		
	<div id="hols" class="sidebar">
		
		<table>
			<tr>
				<th>Name</th>
				<th>Start</th>
				<th>Finish</th>
			</tr>
			
			<?php foreach($holiday as $hol){?>
				
				<?php
				 $temp_start = strtotime($hol['date_start']); 
				 $start = date("d M Y", $temp_start); 
				 $temp_end = strtotime($hol['date_end']); 
				 $end = date("d M Y", $temp_end);
				
				
				?>
				<tr>
				<td><?php echo $hol['name'];?></td>
				<td><?php echo $start;?></td>
				<td><?php echo $end;?></td>
				</tr>
			<?php }?>
			
		</table>
		
	</div>
		