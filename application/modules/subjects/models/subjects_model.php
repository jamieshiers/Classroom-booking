<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Subjects_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get_subject_by_id($id)
	{
		$this->db->from('subjects')
			->where('id', $id); 
		
		$query = $this->db->get();
		
		$data = $query->result_array(); 
		return $data;
	}
	
	
	
//---------------------------------------------------------------------------
	
	public function get_subjects()
	{
		$this->db->order_by('subject', 'asc');
		$query = $this->db->get('subjects');
		
		$data = $query->result_array();
		
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function add_subject($data)
	{
		$this->db->insert('subjects', $data); 
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		
		$id = $this->db->insert_id(); 
		return $id;
	}
//---------------------------------------------------------------------------

	public function edit_subject($update)
	{
		$this->db->where('id', $update['id']); 
		$this->db->update('subjects', $update);
		
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
	
	public function delete_subject($id)
	{
		$this->db->where('id', $id); 
		$this->db->delete('subjects');
		
		
	}

	
} // end of holiday_model.php