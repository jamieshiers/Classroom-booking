<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/
//---------------------------------------------------------------------------
/**
* User Model
* @subpackage Models
* 
*/

class User_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	//public function getuser($query);
	//{
		
	//}
//---------------------------------------------------------------------------	
	/**
	* Get a user by their id
	*
	* @param 	int The users id number
	* @return 	mixed 
	*/
	
	public function get_user_by_id($user)
	{
		$user = (int) $user; 
		
		$this->db->from('users')
		//		->join('user_groups', 'user_groups = group_id', 'left')
				->where('id', $user); 
				
		$query = $this->db->get();
		
		if($query->num_rows() !=1)
		{
			return FALSE;
		}
		$data = $query->result_array(); 
		//$query->free_result(); 
		return $data;
		
	}
//---------------------------------------------------------------------------	
	/**
	* Get a user by their username
	*
	* @param 	string 
	* @return 	mixed 
	*/
	
	public function get_user_by_username($username)
	{
		$this->db->from('users')
				//->join('user_groups', 'user_groups = group_id', 'left')
				->where('username', $username);
				
		$query = $this->db->get(); 
		
		if($query->num_rows() !=1)
		{
			return FALSE; 
		}
		
		$data = $query->row_array(); 
		$query->free_result(); 
		return $data;
	}
//---------------------------------------------------------------------------	
	/**
	* Add the user to the database
	* @param array data collected from input form
	* @return mixed FALSE if error / $user_id if the user has been added
	*/
	
	public function add_user($data)
	{
		// this hashes the password using the hash function below
		$data['password'] = $this->hash($data['password']);
		
		$this->db->insert('users', $data);
		
		if ($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		$user_id = $this->db->insert_id(); 
		
		return $user_id;
	}
//---------------------------------------------------------------------------	
	public function edit_user($data)
	{
		if ($data['password'] == '')
		{
			unset($data['password']);
		}
		else
		{
			$data['password'] = $this->hash($data['password']);
		}
		$this->db->where('id', $data['id']);
		$this->db->update('users', $data);
			
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE; 
		}
		
		$user_id = $data['id'];
		
		return $user_id;
	}
	
//---------------------------------------------------------------------------
		/**
		* Delete the user from the database
		* @param String The user to be deleted
		* 
		*/
		
		public function delete_user($user_id)
		{
			$this->db->where('id', $user_id); 
			$this->db->delete('users');
		}

//---------------------------------------------------------------------------
	/**
	* Hash the password using do_hash in the security function (SHA1)
	* @param    String The Password to be hashed
	* @return 	String The hashed password
	*/
	
	public function hash($password)
	{
		$this->load->helper('security'); 
		$password = do_hash($password);
		
		return $password;
	}
//---------------------------------------------------------------------------	
	public function username_check($username, $id)
	{
		$this->db->select('username')
				->from('users')
				->where('username', $username)
				->where('id !=', $id); 
		
		$query = $this->db->get();
		
		return $query;
	}
	
//---------------------------------------------------------------------------

	public function user_list()
	{
		//$this->db->select('username')->from('users'); 
		
		$query = $this->db->get('users');
		
		$data = $query->result_array();
		
		return $data;
	}
	
	
	public function ldap_login()
	{
		$this->db->select('setting_value')
			->from('settings')
			->where('setting_name', 'ldap');
			
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
	
	
//---------------------------------------------------------------------------	
	/**
	 * Get a list of LDAP groups and return
	 */
	function get_ldap_groups()
	{
		// get the LDAP settings from the database ready to connect/bind to the server
		
		$this->load->config('ldap');
		$ldap_servers = $this->config->item('domain_controllers');
		$base_dn = $this->config->item('base_dn'); 
		$ldap_user = $this->config->item('ad_username');
		$ldap_password = $this->config->item('ad_password');
		$servers = explode(';',$ldap_servers);
		
		// Multiple servers can be listed, so try to connect to each one - if S1 is down, it allows
		// connection to S2 for authentication still
		foreach ($servers as $server) {
			$ds = ldap_connect($server);
			if ($ds) { 
				$connectedto = $server;
				
				break;
			}
		}
		
		// If connection made
		if ($ds) {
			// Bind
			$r = ldap_bind($ds, $ldap_user, $ldap_password);
			if ($r) {
				
				// Search for this groupType, which will return all groups
				$sr = ldap_search($ds, $base_dn, "groupType=-2147483646");
				
				// Put each group it finds into the array, and then sort it alphbetically
				if (ldap_count_entries($ds, $sr) > 0 ) {
					$info = ldap_get_entries($ds, $sr);
					foreach ($info as $entry) {
						$data[] = $entry;
					}
					sort($data);
				} else {
					$data[] = "No LDAP groups found";
				}
			}
		} else {
			$data[] = "Couldn't connect to LDAP server";
		}
		
		return $data;
	}
	
	public function save_ldap($admins,$users,$disabled)
	{
		
		// For each 'standard users' group chosen, stack it into a string seperated by a semi-colon
		foreach ($users as $group) {
			$user .= $group.';';
		}
		// Do the same for the admin groups
		foreach ($admins as $group) {
			$admin .= $group.';';
		}
		
		foreach($disabled as $group)
		{
			$disabled .= $group.';';
		}
		

		// Save these two settings back to the database
		$this->db->where('setting_name', 'ldap_standard_users');
		$this->db->update('settings',array('setting_value' => $user));
		$this->db->where('setting_name', 'ldap_admin_users');
		$this->db->update('settings',array('setting_value' => $admin));
		$this->db->where('setting_name', 'ldap_disabled_users');
		$this->db->update('settings',array('setting_value' => $disabled));
		
		
		return true;
	}
} // end of user_model.php 
