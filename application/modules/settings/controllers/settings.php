<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Settings extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_auth');
		$this->load->model('settings_model');
		$this->user_auth->protect();
		$this->template->set_layout('default');
	}
	
	public function dashboard()
	{
		$data['ldap'] = $this->settings_model->get_setting('ldap');
		$this->template->title('Settings Dashboard'); 
		$this->template->build('dashboard', $data);
	}
	
	public function user_settings()
	{
		$data['checked'] = $this->settings_model->get_setting('ldap');
		$data['config'] = $this->load->config('users/ldap');
		$this->template->title('User Settings');
		$this->template->build('user_settings', $data);
		
	}
	
	public function email_settings()
	{
		$data['config'] = $this->load->config('email');
		$this->template->title('Email Settings');
		$this->template->build('email_settings', $data);
	}
	
	public function save_email_settings()
	{
			$template_path = APPPATH. 'modules/settings/config_templates/email_template.php'; 
		   $output_path = APPPATH. 'config/email.php';
        
		   $ldap_config = file_get_contents($template_path);
		   
		   
		   // Update SMTP SERVER
		   if($this->input->post('smtp'))
		   {
		   	$new  = str_replace("%SMTP%",$this->input->post('smtp'),$ldap_config);
		   }
		   
		if($this->input->post('from'))
			   {
			   	$new  = str_replace("%FROM_EMAIL%",$this->input->post('from'),$new);
			   }
		
		if($this->input->post('from_name'))
			{
				$new  = str_replace("%FROM_NAME%",$this->input->post('from_name'),$new);
			}
		if($this->input->post('from_domain'))
			{
				$new  = str_replace("%FROM_DOMAIN%",$this->input->post('from_domain'),$new);
			}
		
		   // Update username 
		   if($this->input->post('username'))
		   {
		   	$new  = str_replace("%USERNAME%",$this->input->post('username'),$new);
        
		   }
			// Update password
			   if($this->input->post('password'))
			   {
			   	$new  = str_replace("%PASSWORD%",$this->input->post('password'),$new);
			   }else{
				$this->load->config('email'); 

				$smtp_password = $this->config->item('smtp_pass');

				$new  = str_replace("%PASSWORD%",$smtp_password,$new);	
				}
		   
		   
		   
		   
        
		   $handle = fopen($output_path, 'w+');
        
		   @chmod($ouput_path, 0777);
        
		   if(fwrite($handle,$new))
		   {
		   	$this->session->set_flashdata('msg', 'Settings Saved'); 
		   	
		   	$this->dashboard();
		   }
		   else
		   {
		   	$this->session->set_flashdata('error', 'Settings Not Saved'); 
		   	
		   	$this->user_settings();
		   }
	}
	
	
	
	public function save_user_settings()
	{
		
		$ldap = $this->input->post('LDAP') ? 1:0 ;
		
		
		   // Set LDAP Up
		   
		   	$update = array('setting_value' => $ldap);
		   	$this->settings_model->update($update, 'settings', 'ldap');
		  
		   
		   $template_path = APPPATH. 'modules/settings/config_templates/ldap_template.php'; 
		   $output_path = APPPATH. 'modules/users/config/ldap.php';
        
		   $ldap_config = file_get_contents($template_path);
		   
		   
		   // Update Account Suffix
		   if($this->input->post('suffix'))
		   {
		   	$new  = str_replace("%SUFFIX%",$this->input->post('suffix'),$ldap_config);
		   }
		   
		   // Update Base DN
		   if($this->input->post('base_dn'))
		   {
		   	$new  = str_replace("%BASE_DN%",$this->input->post('base_dn'),$new);
        
		   }
		   // Update Controller
		   if($this->input->post('controller'))
		   {
		   	$new  = str_replace("%CONTROLLER%",$this->input->post('controller'),$new);
		   }
		   
		   // Update username
		   if($this->input->post('username'))
		   {
		   	$new  = str_replace("%USERNAME%",$this->input->post('username'),$new);
		   }
		   
		   // Update password
		   if($this->input->post('password'))
		   {
		   	$new  = str_replace("%PASSWORD%",$this->input->post('password'),$new);
		   }else{
			$this->load->config('users/ldap'); 
			
			$ad_password = $this->config->item('ad_password');
			
			$new  = str_replace("%PASSWORD%",$ad_password,$new);	
			}
		   
		   
        
		   $handle = fopen($output_path, 'w+');
        
		   @chmod($ouput_path, 0777);
        
		   if(fwrite($handle,$new))
		   {
		   	$this->session->set_flashdata('msg', 'Settings Saved'); 
		   	
		   	$this->dashboard();
		   }
		   else
		   {
		   	$this->session->set_flashdata('error', 'Settings Not Saved'); 
		   	
		   	$this->user_settings();
		   }
	}
	
	
	
}