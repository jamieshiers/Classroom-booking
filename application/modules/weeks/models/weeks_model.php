<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/

class Weeks_Model extends CI_Model
{
	public function get_weeks()
	{
		$query = $this->db->get('weeks'); 
		
		if($query->num_rows() == 0)
		{
			return FALSE;
		}
		
		$data = $query->result_array(); 
		$query->free_result();
		return $data;
	}
//---------------------------------------------------------------------------
	
	public function get_year()
	{
		$query = $this->db->get('year'); 
		if($query->num_rows() == 1)
		{
			$query->row();
		}
		else
		{
			return FALSE;
		}
	}
//---------------------------------------------------------------------------

	public function get_holidays()
	{
		$query = $this->db->get('holidays');
		
		$data = $query->result_array();
		
		return $data;
	}
//---------------------------------------------------------------------------
	public function year()
	{
		$query = $this->db->get('year');
		
		$data = $query->result_array();
		
		return $data;
	}

//---------------------------------------------------------------------------
	public function add_year($data)
	{
		$query = $this->db->get('year'); 
		if($query->num_rows() == 1)
		{
			// Data is allready there update it!
			$this->db->update('year', $data);
			return TRUE;
		}
		else
		{
			// Data doesnt exist create new record
			$this->db->insert('year', $data);
			return TRUE; 
		}
	}

//---------------------------------------------------------------------------
	public function add_week($data)
	{
		$this->db->insert('weeks', $data);
		if ($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			$week_id = $this->db->insert_id(); 

			return $week_id;
		}
	}
//---------------------------------------------------------------------------

	public function add_monday($week)
	{
		$id = $week['id']; 
		
		foreach($week['dates'] as $date)
		{
			$temp = array('date' => $date, 'week_id' => $id); 
			
			$this->db->insert('week_dates', $temp);
		}
		
	}
	

//---------------------------------------------------------------------------		
		
	public function delete_week($id)
	{
		$this->db->where('id', $id); 
		$this->db->delete('weeks'); 
		
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
	/** 
	*	function to get all the mondays in the academic year
	*	
	*
	*/
	
	function getmonday()
	{
		// Get the current academic year from the database
		$queryyear = $this->db->get('year');
		$resultyear = $queryyear->result_array();
		// assign the dates to variables
		foreach($resultyear as $year)
		{
			$year_start = $year['date_start']; 
			$year_end = $year['date_end'];	
		}
		
		// If the term starts midweek we need to find out the date of the following monday
		list($year,$month,$day) = explode('-', $year_start);
		$tempdate = new DateTime($year_start); 
		$dayname = $tempdate->format('w');
		// This is the first monday in the academic year
		$start_week = date("Y-m-d", mktime(0,0,0,$month,$day-$dayname+1,$year));
		
		// like wise if the year finishes mid week. 
		
		list($year,$month,$day) = explode('-', $year_end);
		$tempdate = new DateTime($year_end); 
		$dayname = $tempdate->format('w');
		// this is the last monday of the year
		$end_week = date("Y-m-d", mktime(0,0,0,$month,$day-$dayname+1,$year));
		
		$temp_start_week = strtotime($start_week);
		$temp_end_week = strtotime($end_week);
		$dates['0']['date'] = $start_week;
		$i = 1;
		while($temp_start_week <= $temp_end_week)
		{
			$temp_start_week = strtotime('+1 week', $temp_start_week); 
			$next = date('Y-m-d', $temp_start_week); 

			$dates[$i]['date'] = $next;
			
			
			
			$i++;
		}
		
	return $dates;
		
	}

//---------------------------------------------------------------------------


}
