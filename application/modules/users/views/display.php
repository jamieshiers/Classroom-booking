<?php (defined('BASEPATH')) OR exit('No direct script access allowed');	?>

<h2>Manage Users</h2>
<div id="icon_bar">
<a href=<?php echo site_url('users/admin/add_user/');?> id="add_user"></a>
</div>
<div id="display_users" class="table">
	<table>
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>email</th>
			<th>Group</th>
		</tr>
			<?php foreach ($users as $user){?>
				<tr>
					<td><?php echo $user['username'];?></td>
					<td><?php echo $user['first_name']." ". $user['last_name'];?></td>
					<td><?php echo $user['email'];?></td>
					<td><?php echo $user['user_group'];?></td>
				</tr>
			<?php }?> 
	</table>
	
	
	
</div>

