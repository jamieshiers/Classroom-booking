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
<h1>Email Settings</h1>
<?php

echo form_open('settings/settings/save_email_settings');
echo form_label('From Email', 'from');
echo form_input('from', $this->config->item('from_email')); 
echo form_label('From Name', 'from_name');
echo form_input('from_name', $this->config->item('from_name'));
echo form_label('Sending Domain', 'from_domain');
echo form_input('from_domain', $this->config->item('from_domain'));
echo form_label('SMTP Server', 'smtp');
echo form_input('smtp', $this->config->item('smtp_host'));
echo form_label('Username', 'username');
echo form_input('username', $this->config->item('smtp_user'));
echo form_label('Password', 'password');
echo form_password('password');

$data = array(
    'name'        => 'submit',
    'type'        => 'submit',
    'class' 	  => 'button green',
	'value'		  => 'Save',
    );

echo form_submit($data);
echo form_close();


?>

