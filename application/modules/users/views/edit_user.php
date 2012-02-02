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

<?php $data = array( 'admin' => 'Admin', 'user' => 'user') ;?>

<h2>Edit User Details</h2>
<div class="error_message">
	<?php if(validation_errors())
	{
		echo '<div class=error_message>'.validation_errors().'</div>';
	}
	?>
	
<?php foreach ($users as $user) {?>
</div>
<div id="add_user_form">
<?php echo form_open('users/admin/edit_user/'.$user['id']); 
echo form_hidden('id', $user['id']);?>

<label for="first_name"> First Name:
<?php echo form_input('first_name', $user['first_name']); ?></label><br />
<label for="last_name"> Last Name:
<?php echo form_input('last_name', $user['last_name']); ?></label><br />
<label for="username"> Username:
<?php echo form_input('username', $user['username']); ?></label><br />
<label for="username"> Email:
<?php echo form_input('email', $user['email']); ?></label><br />
<label for="last_name"> Group:
<?php echo form_dropdown('user_group', $data); ?></label><br />
<label for="username"> Password:(leave blank, if you dont want to change password)
<?php echo form_password('password'); ?></label> <br />
<label for="username"> Confirm:
<?php echo form_password('password_confirm'); ?></label><br />
<?php

$data = array(
    'name'        => 'submit',
    'type'        => 'submit',
    'class' 	  => 'button green',
	'value'		  => 'Edit User',
    );

echo form_submit($data);
echo form_close(); }?>
</div>
