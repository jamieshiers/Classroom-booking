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
	
	public function login($username, $password, $ldap)
	{
		// if ldap is set to 0 then we are using local users from the database
		if($ldap == 0)
		{
			$pass = $this->_ci->user_model->hash($password); 
		
			$this->_ci->db->from('users')
					->where('username', $username)
					->where('password', $pass);
		
			$query = $this->_ci->db->get(); 
		
			if($query->num_rows() == 1)
			{
				$row = $query->row(); 
				// Our user exists - upadate the table 
				
				$counter = $row->counter;
				
				$counter++;
				
				
				$date = date('Y-m-d');
				$data = array( 'last_login' => $date, 'counter' => $counter);
				$this->_ci->db->where('id', $row->id); 
				$this->_ci->db->update('users', $data);
				//Set the session  
				$this->_ci->session->set_userdata('logged_in', $username); 
				$this->_ci->session->set_userdata('userid', $row->id); 
				$this->_ci->session->set_userdata('accesslevel', $row->user_group);
				$this->_ci->session->set_userdata('email', $row->email);
				$this->_ci->session->set_userdata('counter', $counter);
				return TRUE;
			}
		}
		// if $ldap is set to 1 then we are using users from windows AD
		if($ldap == 1)
		{
			//except for the superuser account who can allways log in regradless
			if($username == "superuser")
			{
			
				$pass = $this->_ci->user_model->hash($password); 

				$this->_ci->db->from('users')
						->where('username', $username)
						->where('password', $pass);

				$query = $this->_ci->db->get(); 

				if($query->num_rows() == 1)
				{
					$counter = $row->counter;
					$counter++;
					$row = $query->row(); 
					// Our user exists - upadate the table 
					$date = date('Y-m-d');
					$data = array( 'last_login' => $date, 'counter' => $counter);
					$this->_ci->db->where('id', $row->id); 
					$this->_ci->db->update('users', $data);
					//Set the session  
					$this->_ci->session->set_userdata('logged_in', $username); 
					$this->_ci->session->set_userdata('userid', $row->id); 
					$this->_ci->session->set_userdata('accesslevel', $row->user_group);
					$this->_ci->session->set_userdata('counter', $counter);
					return TRUE;
				}
				
			}
			else
			{

				
				$this->_ci->load->library('ldap');


				if($this->_ci->ldap->authenticate($username,$password))
				{


				$user_info = $this->_ci->ldap->user_info($username);
				$user_group = $user_info['0']['memberof'];

					$shift = array_shift($user_group);


						$this->_ci->db->from('settings')->where('setting_name', 'ldap_disabled_users');

						$query = $this->_ci->db->get();

						$row = $query->row()->setting_value;

						$disabled_groups = explode(';', $row);
						$pop = array_pop($disabled_groups);



						foreach($disabled_groups as $group)
						{
							foreach($user_group as $user_group2)
							{

								if($user_group2 === $group)
								{
									$authgroup = 'disabled';
									break; 
								}


							}

						}






					// get  the standard user groups from the database

						$this->_ci->db->from('settings')->where('setting_name', 'ldap_standard_users');

						$query = $this->_ci->db->get();

						$row = $query->row()->setting_value;

						$standard_groups = explode(';', $row);
						$pop = array_pop($standard_groups);



						foreach($standard_groups as $group)
						{
							foreach($user_group as $user_group2)
							{

								if($user_group2 === $group)
								{
									$authgroup = 'user'; 
								}


							}

						}


						// get the admin users groups from the database

						$this->_ci->db->from('settings')->where('setting_name', 'ldap_admin_users');

						$query = $this->_ci->db->get();

						$row = $query->row()->setting_value;

						$admin_groups = explode(';', $row);

						foreach($admin_groups as $group)
						{
							foreach($user_group as $user_group2)
							{

								if($group === $user_group2)
								{
									$authgroup = 'admin'; 	
								}


							}

						} 





						if($authgroup == 'admin')
						{
							$this->_ci->session->set_userdata('logged_in', $username); 

							$this->_ci->session->set_userdata('accesslevel', 'admin');
							return TRUE;
						}
						if($authgroup == "disabled")
						{
							Return FALSE;
						}

						else
						{
							$this->_ci->session->set_userdata('logged_in', $username); 

							$this->_ci->session->set_userdata('accesslevel', 'user');
							return TRUE;
						}



				}
				
			}
			
			
			
		}
		
		
	}


			
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