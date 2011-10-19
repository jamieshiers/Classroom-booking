<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Holiday_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
//---------------------------------------------------------------------------
	
	public function get_holidays()
	{
		$query = $this->db->get('holidays');
		
		$data = $query->result_array();
		
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function get_holiday_by_id($id)
	{
		$this->db->from('holidays')
			->where('id', $id); 
		
		$query = $this->db->get();
		
		$data = $query->result_array(); 
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function add_holiday($data)
	{
		$this->db->insert('holidays', $data); 
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		
		$id = $this->db->insert_id(); 
		return $id;
	}
//---------------------------------------------------------------------------

	public function edit_holiday($update)
	{
		$this->db->where('id', $update['id']); 
		$this->db->update('holidays', $update);
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			$id = $update['id'];
		}
		return $id; 
	}
	
//---------------------------------------------------------------------------
	
	public function delete_holiday($id)
	{
		$this->db->where('id', $id); 
		$this->db->delete('holidays');
		
		
	}

	
} // end of holiday_model.php