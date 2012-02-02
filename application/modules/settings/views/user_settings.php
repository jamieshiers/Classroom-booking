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
<script>
$(document).ready(function(){
	if($('#ldap').attr('checked'))
	{
		$('#ldap_settings').show();
	}
	
	$("#ldap").click(function(){

			// If checked
			if ($("#ldap").is(":checked"))
			{
				//show the hidden div
				$("#ldap_settings").show("slow");
			}
			else
			{
				//otherwise, hide it
				$("#ldap_settings").hide("slow");
			}
		  });
	
});

	

</script>



<h1>User Settings</h1>
<?php

echo form_open('settings/settings/save_user_settings');
echo form_label('Use LDAP for Login', 'LDAP');

if($checked->setting_value == 1)
{
	$data = array(
		'name' => 'LDAP',
		'id' => 'ldap',
		'checked' => TRUE,
		'value' => '1'	
	);

	echo form_checkbox($data);
}
else
{
	$data = array(
		'name' => 'LDAP',
		'id' => 'ldap', 	
		'value' => '1'
	);

	echo form_checkbox($data);
}

?>
<div id="ldap_settings" style="display:none;">
<?php
$controller = implode(";",$this->config->item('domain_controllers'));
echo form_label('Account Suffix', 'suffix');
echo form_input('suffix', $this->config->item('account_suffix'));
echo form_label('Base DN', 'base_dn');
echo form_input('base_dn', $this->config->item('base_dn'));
echo form_label('Domain Controller', 'controller');
echo form_input('controller', $controller);
echo form_label('Username', 'username');
echo form_input('username', $this->config->item('ad_username'));
echo form_label('Password (If you don\'t want to change the password leave this blank)','password');
echo form_password('password');
?>
</div>
<?php

$data = array(
    'name'        => 'submit',
    'type'        => 'submit',
    'class' 	  => 'button green',
	'value'		  => 'Save',
    );

echo form_submit($data);
echo form_close();


?>

