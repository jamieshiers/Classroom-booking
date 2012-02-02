<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/
 if(validation_errors())
{
	echo '<div class=error_message>'.validation_errors().'</div>';
}




echo form_open('users/admin/login'); 
echo form_label('Username');
$data = array(
    'name'        => 'username',
    'class' 	  => 'wide',
    );
echo form_input($data);
echo form_label('Password'); 
$data = array(
    'name'        => 'password',
    'class' 	  => 'wide',
    );
echo form_password($data); 
$data = array(
    'name'        => 'Login',
    'type'        => 'submit',
    'class' 	  => 'button green',
	'value'		  => 'Sign In',
    );
echo form_submit($data); 
echo form_close();