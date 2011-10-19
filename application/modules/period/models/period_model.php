<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Period_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
//---------------------------------------------------------------------------
	
	public function get_periods()
	{
		$this->db->order_by('start_time', 'asc');
		$query = $this->db->get('periods');
		
		$data = $query->result_array();
		
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function get_period_by_id($id)
	{
		$this->db->from('periods')
			->where('periodid', $id); 
		
		$query = $this->db->get();
		
		$data = $query->result_array(); 
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function add_period($data)
	{
		$this->db->insert('periods', $data); 
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		
		$id = $this->db->insert_id(); 
		return $id;
	}
//---------------------------------------------------------------------------

	public function edit_period($update)
	{
		$this->db->where('periodid', $update['periodid']); 
		$this->db->update('periods', $update);
		
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
	
	public function delete_period($id)
	{
		$this->db->where('periodid', $id); 
		$this->db->delete('periods');
		
		
	}

	
} // end of holiday_model.php