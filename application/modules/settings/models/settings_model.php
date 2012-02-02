<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Settings_model extends CI_Model
{
	
	public function insert($data)
	{
		$this->db->update_batch('settings', $data); 
	
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
	
		$id = $this->db->insert_id(); 
		return $id;
	}
	
	public function update($array, $table, $setting)
	{
		$this->db->where('setting_name', $setting);
		$this->db->update($table, $array);
	}
	
	public function get_setting($setting)
	{
		$query = $this->db->get_where('settings', array('setting_name' => $setting)); 
		return $query->row();
	}
	

	
	
	
}
