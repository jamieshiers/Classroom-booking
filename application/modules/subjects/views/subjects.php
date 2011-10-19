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
<h1>Subjects</h1>

<a href=<?php echo site_url('subjects/subjects/add_subject')?> class="button blue">Add New Subject</a>
<table>
<tr>
	<th>Name</th>
	<th></th>
	<th></th>
	
</tr>
<?php if($subjects) {?>
<?php foreach($subjects as $subject) 
{ ?>
<tr>
<td class="padding"><?php echo $subject['subject']; ?></td>
	
<td class="padding"><a href=<?php echo site_url('subjects/subjects/edit_subject/'.$subject['id']) ?> class="button blue">Edit</a></td>
<td class="padding"><a href=<?php echo site_url('subjects/subjects/delete_subject/'.$subject['id'])?> class='button red'>Delete</a></td>

</tr>
<?php }
} else {
echo '<td colspan="4" align="center" style="padding:16px 0">No Rooms Set Up</td>';
}
?>
</table>
</div>