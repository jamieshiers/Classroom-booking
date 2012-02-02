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
<h1>Periods</h1>

<a href=<?php echo site_url('period/period/add_period')?> class="button blue">Add New Period</a>
<table>
<tr>
	<th>Name</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Bookable</th>
	<th></th>
	<th></th>
</tr>
<?php if($period) {?>
<?php foreach($period as $date) 
{ ?>
<tr>
<td class="padding"><?php echo $date['period_name']; ?></td>
<td class="padding"><?php echo ($date['start_time']);?></td>
<td class="padding"><?php echo ($date['end_time']);?></td>

<?php if($date['bookable'] == 0){?>
	<td class="padding"><img src="<?php echo base_url();?>/images/no.gif" border="0"></td>
	<?php } else {?>
		<td class="padding"><img src="<?php echo base_url();?>/images/accept.gif" border="0"></td>
		<?php } ?>
	
<td class="padding"><a href=<?php echo site_url('period/period/edit_period/'.$date['periodid']) ?> class="button blue">Edit</a></td>
<td class="padding"><a href=<?php echo site_url('period/period/delete_period/'.$date['periodid'])?> class="button red">Delete</a></td>

</tr>
<?php }
} else {
echo '<td colspan="4" align="center" style="padding:16px 0">No Periods defined!</td>';
}
?>
</table>
</div>