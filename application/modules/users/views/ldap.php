<h2> Standard users</h2>
<p> Standard users can only access the booking resources</p>
<i> hold shift to select multiple groups</i>
<?php echo form_open("users/admin/save_ldap"); ?>
<select multiple size="15" name="users[]">
<?php
foreach($groups as $group ) 
{
	if(!empty($group['cn'][0]))
	{
		echo "<option "; 
		foreach ($standard_user  as $user) 
		{
			if ($user == $group['distinguishedname'][0]) { echo 'selected'; }
		}
		echo ' value="'.$group['distinguishedname'][0].'">'.$group['cn'][0].'</option>';
	}

} 
?>
</select>
<h2> Admin users</h2>
<p>Admin users have access to everything</p>
<i> hold shift to select multiple groups</i>
<select multiple size="15" name="admins[]">
<?php
foreach($groups as $group ) 
{
	if(!empty($group['cn'][0]))
	{
		echo "<option "; 
		foreach ($admin_user  as $user) 
		{
			if ($user == $group['distinguishedname'][0]) { echo 'selected'; }
		}
		echo ' value="'.$group['distinguishedname'][0].'">'.$group['cn'][0].'</option>';
	}

} 
?>
</select>
<h2>Disabled users</h2>
<p>Disabled users cannot log in to the booking system</p>
<i> hold shift to select multiple groups</i>

<select multiple size="15" name="disabled[]">
<?php
foreach($groups as $group ) 
{
	if(!empty($group['cn'][0]))
	{
		echo "<option "; 
		foreach ($disabled_user  as $user) 
		{
			if ($user == $group['distinguishedname'][0]) { echo 'selected'; }
		}
		echo ' value="'.$group['distinguishedname'][0].'">'.$group['cn'][0].'</option>';
	}

} 
?>
</select>

<?php echo form_submit("submit","save");
echo form_close(); 
?>
