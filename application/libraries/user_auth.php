<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/

class User_Auth
{
	function __construct()
	{
		$this->_ci =& CI_Base::get_instance(); 
		
		// Load some additional libraries and helpers
		$this->_ci->load->library('session', 'template'); 
		$this->_ci->load->model('users/user_model'); 
	}
//---------------------------------------------------------------------------	
//---------------------------------------------------------------------------
	public function logout()
	{
		$this->_ci->session->sess_destroy();
		return TRUE; 
	}
	
//---------------------------------------------------------------------------

	public function protect()
	{
		if($this->_ci->session->userdata('logged_in') === FALSE)
		{
			$this->_ci->session->set_flashdata('error', 'You need to be logged in to access this page!');
			redirect('users/admin/login');
		}
		else
		{
			return TRUE;
		}
		
	}



}