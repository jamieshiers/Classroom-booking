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
<h1>Manage Rooms</h1>

<a href=<?php echo site_url('rooms/rooms/add_room')?> class="button blue">Add New Room</a>

<table class="zebra-striped">
<tr>
	<th>Name</th>
	<th>Bookable</th>
	<th>Room Admin</th>
	<th></th>
	<th></th>
	
</tr>
<?php if($rooms) {?>
<?php foreach($rooms as $date) 
{ ?>
<tr>
<td class="padding"><?php echo $date['name']; ?></td>
<?php if($date['bookable'] == 0){?>
	<td class="padding"><img src= "<?php echo base_url();?>/images/no.gif" border="0"></td>
	<?php } else {?>
		<td class="padding"><img src="<?php echo base_url();?>/images/accept.gif" border="0"></td>
		<?php } ?>
<td class="padding"><?php echo $date['admin'];?></td>
	
<td class="padding"><a href=<?php echo site_url('rooms/rooms/edit_room/'.$date['roomid']) ?> class="button blue">Edit</a></td>
<td>
	<a href=<?php echo site_url('rooms/rooms/delete_room/'.$date['roomid'])?> class="button red">Delete</a>
</td>

</tr>
<?php }
} else {
echo '<td colspan="4" align="center" style="padding:16px 0">No Rooms Set Up</td>';
}
?>
</table>
</div>