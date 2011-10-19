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


<div class="error_message">
	<?php if(validation_errors())
	{
		echo '<div class=error_message>'.validation_errors().'</div>';
	}
	?>
	
	
</div>
<div id="add_user_form" class="form">
<?php echo form_open('users/admin/add_user'); ?>
<label for="first_name"> First Name:
<?php echo form_input('first_name'); ?></label><br />
<label for="last_name"> Last Name:
<?php echo form_input('last_name'); ?></label><br />
<label for="username"> Username:
<?php echo form_input('username'); ?></label><br />
<label for="username"> Email:
<?php echo form_input('email'); ?></label><br />
<label for="last_name"> Group:
<?php echo form_dropdown('user_group', $data); ?></label><br />
<label for="username"> Password:
<?php echo form_password('password'); ?></label> <br />
<label for="username"> Confirm:
<?php echo form_password('password_confirm'); ?></label><br />
<?php
echo form_submit('submit', 'Add User');
echo form_close(); ?>
</div>
