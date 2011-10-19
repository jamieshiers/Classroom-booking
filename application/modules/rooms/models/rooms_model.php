<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Rooms_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
//---------------------------------------------------------------------------
	
	public function get_rooms()
	{
		$query = $this->db->get('rooms');
		
		$data = $query->result_array();
		
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function get_room_by_id($id)
	{
		$this->db->from('rooms')
			->where('roomid', $id); 
		
		$query = $this->db->get();
		
		$data = $query->result_array(); 
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function add_room($data)
	{
		$this->db->insert('rooms', $data); 
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		
		$id = $this->db->insert_id(); 
		return $id;
	}
//---------------------------------------------------------------------------

	public function edit_room($update)
	{
		$this->db->where('roomid', $update['roomid']); 
		$this->db->update('rooms', $update);
		
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
	
	public function delete_room($id)
	{
		$this->db->where('roomid', $id); 
		$this->db->delete('rooms');
		
		
	}

	
} // end of holiday_model.php