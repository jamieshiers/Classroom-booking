<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/

 	
 	echo $this->session->flashdata('msg');
 	
 	
 
 ?>

	<ul class="dash">
		
		<li>
			<a href="<?php echo site_url();?>/settings/settings/user_settings">
				<img src="<?php echo base_url();?>images/icons/user.png" alt="Add Room" title="Add a Room"/>
				<span>User login options</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/users/admin/ldap">
				<img src="<?php echo base_url();?>images/icons/group.png" alt="Add Room" title="Add a Room"/>
				<span>LDAP Groups</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/settings/settings/email_settings">
				<img src="<?php echo base_url();?>images/icons/email.png" alt="Add Room" title="Add a Room"/>
				<span>Email Server Settings</span>
			</a>
		</li>
		
	</ul>




