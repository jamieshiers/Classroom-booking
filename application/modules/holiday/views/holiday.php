<div id="holiday">
	
	<h1>Holidays</h1>
	<a href=<?php echo site_url('holiday/holiday/add_holiday')?> class="button blue">Add New Holiday</a>
<table class="zebra-striped">
	<tr>
		<th>Name</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th></th>
		<th></th>
		
	</tr>
	<?php if($holiday) {?>
<?php foreach($holiday as $date) 
{ ?>
	<tr>
	<td class="padding"><?php echo $date['name']; ?></td>
	<td class="padding"><?php echo date('d/m/y', strtotime($date['date_start']));?></td>
	<td class="padding"><?php echo date('d/m/y', strtotime($date['date_end']));?></td>
	<td class="padding"><a href=<?php echo site_url('holiday/holiday/edit_holiday/'.$date['id']) ?> class="button blue">Edit</a></td>
	<td class="padding"><a href=<?php echo site_url('holiday/holiday/delete_holiday/'.$date['id'])?> class='button red'>Delete</a></td>
	
	</tr>
<?php }
} else {
	echo '<td colspan="4" align="center" style="padding:16px 0">No holidays defined!</td>';
}
?>
</table>
</div>