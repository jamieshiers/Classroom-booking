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
<h1>Year Groups</h1>

<a href=<?php echo site_url('years/years/add_year')?> class="button blue">Add New Year Group</a>
<table>
<tr>
	<th>Name</th>
	<th></th>
	<th></th>
	
</tr>
<?php if($years) {?>
<?php foreach($years as $subject) 
{ ?>
<tr>
<td class="padding"><?php echo $subject['year_name']; ?></td>
	
<td class="padding"><a href=<?php echo site_url('years/years/edit_years/'.$subject['id']) ?> class="button blue">Edit</a></td>
<td class="padding"><a href=<?php echo site_url('years/years/delete_years/'.$subject['id'])?> class='button red'>Delete</a></td>

</tr>
<?php }
} else {
echo '<td colspan="4" align="center" style="padding:16px 0">No year groups set up</td>';
}
?>
</table>
</div>