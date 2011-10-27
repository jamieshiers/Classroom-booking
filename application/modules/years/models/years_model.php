<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Years_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get_years_by_id($id)
	{
		$this->db->from('years')
			->where('id', $id); 
		
		$query = $this->db->get();
		
		$data = $query->result_array(); 
		return $data;
	}
	
	
	
//---------------------------------------------------------------------------
	
	public function get_years()
	{
		$this->db->order_by('year_name', 'asc');
		$query = $this->db->get('years');
		
		$data = $query->result_array();
		
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function add_years($data)
	{
		$this->db->insert('years', $data); 
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		
		$id = $this->db->insert_id(); 
		return $id;
	}
//---------------------------------------------------------------------------

	public function edit_years($update)
	{
		$this->db->where('id', $update['id']); 
		$this->db->update('years', $update);
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
		
	}
	
//---------------------------------------------------------------------------
	
	public function delete_years($id)
	{
		$this->db->where('id', $id); 
		$this->db->delete('years');
		
		
	}

	
} // end of holiday_model.php