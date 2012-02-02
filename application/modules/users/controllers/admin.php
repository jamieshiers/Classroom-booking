<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


class Admin extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->template->set_layout('default');	
	}
//---------------------------------------------------------------------------
	
	public function index()
	{
		$this->user_auth->protect();
		$data['users'] = $this->user_model->user_list(); 
		$this->template->title('Users');
		$this->template->build('display', $data);
	}
//---------------------------------------------------------------------------
	/**
	* Add a new user
	*
	*/
	
	public function add_user()
	{
		$this->user_auth->protect();
		
		$this->template->title('Add New User');
		$this->template->build('add_user');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|callback_username_check'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
		//$this->form_validation->set_rules('user_group', 'Group', 'required'); 
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]'); 
		$validate = $this->form_validation->run(); 
		
		if ($validate == FALSE)
		{
			$this->template->build('add_user');
		}
		else
		{
			$update = array(
				'first_name'=> $this->input->post('first_name', TRUE),
				'last_name' => $this->input->post('last_name', TRUE),
				'username'	=> $this->input->post('username', TRUE),
				'email' 	=> $this->input->post('email', TRUE),
				'user_group'=> $this->input->post('user_group', TRUE), 
				'password'	=> $this->input->post('password', TRUE),
				); 
				
				$user_id = $this->user_model->add_user($update);
				
				$this->session->set_flashdata('msg', 'Settings Saved'); 
				
				redirect('users/admin/edit_user/'. $user_id);
		}
	}
//---------------------------------------------------------------------------

	public function edit_user()
	{
		$id = $this->uri->segment(4);
		$this->user_auth->protect();
		$data['users'] = $this->user_model->get_user_by_id($id);
		
		$this->template->title('Edit User'); 
		$this->template->build('edit_user', $data);
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|'); 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
		//$this->form_validation->set_rules('user_group', 'Group', 'required'); 
		$this->form_validation->set_rules('password', 'Password'); 
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'matches[password]'); 
		//$validate = $this->form_validation->run(); 
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->template->build('edit_user', $data);
		}
		else
		{
			$update = array(
				'id'		=> $this->input->post('id', TRUE),
				'first_name'=> $this->input->post('first_name', TRUE), 
				'last_name' => $this->input->post('last_name', TRUE),
				'username'	=> $this->input->post('username', TRUE),
				'email' 	=> $this->input->post('email', TRUE),
				'user_group'=> $this->input->post('user_group', TRUE), 
				'password'	=> $this->input->post('password', TRUE),
				); 
				
				$user_id = $this->user_model->edit_user($update);
				
				$this->session->set_flashdata('msg', 'Settings Saved'); 
				
				redirect('users/admin/');
		}
	}
//---------------------------------------------------------------------------	
	public function delete_user()
	{
		$user_id = $this->uri->segment(4); 
		$this->user_auth->protect();
		$this->user_model->delete_user($user_id);
		$this->session->set_flashdata('msg', 'User Deleted');
		
		redirect('users/admin/');
	}
//---------------------------------------------------------------------------
	public function username_check($username, $id)
	{
		$this->db->select('username')
				->from('users')
				->where('username', $username)
				->where('id !=', $id); 
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$this->form_validation->set_message('username_check', 'The username is already in use.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
//---------------------------------------------------------------------------
	public function login()
	{
	
		$install = base_url()."install/index.php";
		
		if(file_exists("./install/index.php")){?>
			
		<h1>Whoa there!<h1>	
			<h3>You need to delete the install directory before you proceed.</h3>
			
		<?
		exit();	
		}
		
		$this->form_validation->set_rules('username', 'Username', 'required'); 
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		$validate = $this->form_validation->run();
		if($validate == FALSE)
		{
			
			$this->template->set_layout('login');
			$this->template->title('Login'); 
			$this->template->build('login');
		}
		else
		{
			$username = $this->input->post('username', TRUE); 
			$password = $this->input->post('password', TRUE);
			
			$ldap = $this->user_model->ldap_login();
			$ldap = $ldap['setting_value'];
			
			$login = $this->user_auth->login($username, $password, $ldap);
			
		
			if($login == TRUE)
			{
				$this->session->set_flashdata('msg', 'Login Successful!'); 
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('error', 'Incorrect Username or Password! Please Try again.'); 
				$this->template->set_layout('login');
				$this->template->title('Login');
				$this->template->build('login');
			}
		}
	}

//---------------------------------------------------------------------------

	public function logout()
	{
		$this->user_auth->logout(); 
		$this->session->sess_destroy();
	
		redirect('users/admin/login');
	}
	
	
	
	public function ldap()
	{
		$data['groups'] = $this->user_model->get_ldap_groups(); 
		$data['standard_user'] = array(
			'0' => "CN=2005 Intake,OU=Groups,OU=CSE,DC=HOE,DC=Local", 
			'1' => "CN=2007 Intake,OU=Groups,OU=CSE,DC=HOE,DC=Local");
		$data['admin_user'] = array(
			'0' => "CN=2005 Intake,OU=Groups,OU=CSE,DC=HOE,DC=Local", 
			'1' => "CN=2007 Intake,OU=Groups,OU=CSE,DC=HOE,DC=Local");
		
		$this->template->build('ldap', $data);
	}
	
		public function save_ldap()
	{
		$admins = $this->input->post('admins'); 
		$users = $this->input->post('users');
		$disabled = $this->input->post('disabled');
		
		$data['success'] = $this->user_model->save_ldap($admins,$users,$disabled);
		
		redirect('dashboard');
	}
	
	
	
	
	
}