<?php (defined('BASEPATH')) OR exit('No direct script access allowed');	?>

<h1>Manage Users</h1>

<a href=<?php echo site_url('users/admin/add_user/');?> id="add_user" class="button blue">Add User</a>

<div id="display_users" class="table">
	<table>
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>email</th>
			<th>Group</th>
			<th></th>
			<th></th>
		</tr>
			<?php foreach ($users as $user){?>
				<tr>
					<td><?php echo $user['username'];?></td>
					<td><?php echo $user['first_name']." ". $user['last_name'];?></td>
					<td><?php echo $user['email'];?></td>
					<td><?php echo $user['user_group'];?></td>
					<td class="padding"><a href="<?php echo site_url('users/admin/edit_user/'.$user['id'])?>" class="button blue">Edit</a></td>
					<?php
					if($user['id'] == 1)
					{?>
						<td class='padding'><a href="#" class='button disabled'>Delete</a></td>
						
					<?php }else{?>
						<td class='padding'><a href=<?php echo site_url('users/admin/delete_user/'.$user['id']) ?> class='button red'>Delete</a></td>
					<?php }?>
						
					
					
					
				</tr>
			<?php }?> 
	</table>
	
	
	
</div>

