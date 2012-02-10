<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Dashboard_model extends CI_Model
{
		
		public function get_booking($user)
		{
		$date = date('Y-m-d');
		
		$this->db->from('bookings')
		->where('user', $user)
		->where('block', '0')
		->where('date >=', $date)
		->join('rooms', 'roomid = room_id')
		->join('periods', 'periodid = period_id', 'center')
		->order_by('date', 'asc')
		->limit(5);
		$query = $this->db->get(); 
	
	
		
		if($query->num_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			return $query->result();
		}
		}
//---------------------------------------------------------------------------
	
	public function get_room()
	{
		$this->db->from('rooms')
		->where('bookable', '1')
		->order_by('name','asc');
		$query = $this->db->get();
		
		$data = $query->result_array();
		
		return $data;
	}

//---------------------------------------------------------------------------

	public function swap($username) 
	{
		$date = date('Y-m-d');
		$this->db->from('swap')
		->where('user', $username)
		->where('date >=', $date);
		
		$query = $this->db->get(); 
		
		if($query->num_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			return $query->result();
		}		
	}
//---------------------------------------------------------------------------

	public function room_admin($username)
	{
		$date = date('Y-m-d');
		$this->db->from('bookings')
		->where('room_admin', $username)
		->where('date >=', $date)
		->where('responded', NULL);

		$query = $this->db->get();

		if($query->num_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			return $query->result();
		}


	}




}