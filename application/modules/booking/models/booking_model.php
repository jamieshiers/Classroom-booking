<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Booking_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
//---------------------------------------------------------------------------
	
	function get_bookings($id,$startdate,$enddate,$year_end)
	{
		$this->db->where(array('room_id' => $id, 'date >=' => $startdate, 'date <=' => $enddate));
		$this->db->or_where('block',1);
		$this->db->where('year_end', $year_end);
		$this->db->where('room_id',$id);
		$query = $this->db->get('bookings');
		return $query->result();
	}
//---------------------------------------------------------------------------
	//get the end of the academic year so that we arent loading last years bookings when we start a new year. 
	
	public function get_year()
	{
		$query = $this->db->get('year'); 
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			return $row->date_end;
		}
		else
		{
			return FALSE;
		}
	}
//---------------------------------------------------------------------------
	function get_periods()
	{
		$this->db->order_by('start_time', 'asc'); 
		$query = $this->db->get('periods'); 
		return $query->result();
	}
//---------------------------------------------------------------------------

	function get_room($id)
	{
		$this->db->where('roomid', $id); 
		$query = $this->db->get('rooms');
		$room = $query->row();
		return $room;
	}
//---------------------------------------------------------------------------

	function get_single_period($id)
	{
		$this->db->where('periodid', $id); 
		$query = $this->db->get('periods');
		$period = $query->row();
		return $period;
	}
	
//---------------------------------------------------------------------------

	function get_week_number($date)
	{
		$this->db->from('week_dates')
			->join('weeks', 'weekid = week_id', 'left')
			->where('date', $date);
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

	function get_holiday($start)
	{
		$this->db->from('holidays')
		->where('date_start >=', $start)
		
		->order_by('date_start', 'asc');
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

	function get_users()
	{
		$this->db->from('users'); 
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

	function get_single_user()
	{
		$this->db->from('users')->where('username', $username);
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
	function get_subjects() 
	{
		$this->db->order_by('subject', 'asc');
		$this->db->from('subjects'); 
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

	public function get_years()
	{
		$this->db->order_by('year_name', 'asc');
		$query = $this->db->get('years');
		
		$data = $query->result_array();
		
		return $data;
	}
	
	
	
//---------------------------------------------------------------------------

	public function add_booking($data)
	{
		$this->db->insert('bookings', $data); 
	
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
	
		$id = $this->db->insert_id(); 
		return $id;
	}
//---------------------------------------------------------------------------

	public function delete_booking($id)
	{
		$this->db->where('id', $id); 
		$this->db->delete('bookings'); 
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

//---------------------------------------------------------------------------s

	function cal($date)
	{
		$data = array();
		
		// First off, we split the current date down to work with it
		list($selectedyear,$selectedmonth,$selectedday) = explode('-',$date);
		// Now, we find all academic years in the database and see if the selected date falls within that period
		$queryyears = $this->db->get('year');
		$resultyears = $queryyears->result();
		$queryholidays = $this->db->get('holidays');
		$resultholidays = $queryholidays->result();
		
		foreach ($resultyears as $rowyear) {
			$tmpdateyear = $rowyear->date_start;
			$alt = 1;
			while ($tmpdateyear <= $rowyear->date_end) {
				// Split the given date down into day, month, and year values
				list($yy,$ym,$yd) = explode('-', $tmpdateyear);
					
				// Our temporary date is used to find out the day number of the chosen date
				// i.e. Friday return number 5
				$tmpdate = new DateTime($tmpdateyear);
				$tmpdayname = $tmpdate->format('w');
				
				// Piece together the date, changing the date to that of the start of the week
				$tmpdateyear = date('Y-m-d', mktime(0,0,0,$ym, $yd-$tmpdayname+1, $yy));
								
				$weeknum = ltrim(date('W',mktime(0,0,0,$ym,$yd,$yy)), '0');
				
				foreach ($resultholidays as $rowholiday) {
					$tmpdateholiday = $rowholiday->date_start;
					while ($tmpdateholiday <= $rowholiday->date_end) {
						if ($tmpdateholiday == $tmpdateyear) {
							$data['weeknums'][$weeknum] = $rowholiday->name;
						}
						list($hy,$hm,$hd) = explode('-',$tmpdateholiday);
						$tmpdateholiday = date('Y-m-d',mktime(0,0,0,$hm,$hd+1,$hy));
					}
				}
				if (!isset($data['weeknums'][$weeknum])) {
					$data['weeknums'][$weeknum] = $alt;
					$alt = ($alt == 1) ? 2 : 1;	
				}
				
				if ($tmpdateyear == $date) {
					$inacademicyear = true;
					$data['yearname'] = $rowyear->name;
					$data['yearid'] = $rowyear->id;
				}
				$tmpdateyear = date('Y-m-d',mktime(0,0,0,$ym,$yd+7,$yy));
			}
			
			if (isset($inacademicyear)) {
				break;
			}
			
		}
		//print_r($data);
		return($data);
	}
//---------------------------------------------------------------------------

	public function ext($filename)
	{
		$filename = strtolower($filename);
		$exts = explode(".", $filename);
		$n = count($exts)-1;
		$exts = $exts[$n];
		return $exts;
	}
//---------------------------------------------------------------------------

	public function insert_csv($data)
	{
		if(isset($data[0]))
		{
			if(array_key_exists('class,lesson,room_id,period_id,date,block,week_num,user,year_id,staff,year_end',$data[0]))
			{
				foreach($data as $row)
				{
					list($class,$lesson,$room_id,$period_id,$date,$block,$week_num,$user,$year_id,$staff,$year_end) = explode(',',$row['class,lesson,room_id,period_id,date,block,week_num,user,year_id,staff,year_end']); 
					$insert = array(
						'class' 	=> $class, 
						'lesson' 	=> $lesson, 
						'room_id'	=> $room_id, 
						'period_id'	=> $period_id, 
						'date'		=> $date, 
						'block'		=> $block, 
						'week_num' 	=> $week_num, 
						'user'		=> $user, 
						'year_id'	=> 1, 
						'staff'		=> $user,
						'year_end'  => $year_end
					);
					
					$this->db->insert('bookings', $insert);
					
					$id = $this->db->insert_id(); 
					$this->db->query("UPDATE bookings INNER JOIN rooms ON room_id = name SET room_id = roomid WHERE id=".$id."");
                    $this->db->query("UPDATE bookings INNER JOIN periods ON period_id = period_name SET period_id = periodid WHERE id=".$id."");
				}
				
			return 'Bookings successfully imported';
			}
			else
			{
				return "Error importing Bookings into database";
			}
		}
	}
	
//---------------------------------------------------------------------------

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

	public function get_booking_by_id($id)
	{
		$this->db->from('bookings')
			->where('id', $id); 
			
		$query = $this->db->get();
			
		return $query->result();
	}
//---------------------------------------------------------------------------

	public function get_booking_id($id)
	{
		$this->db->from('bookings')
			->where('id', $id); 
			
		$query = $this->db->get();
			
		return $query->row_array();
	}

//---------------------------------------------------------------------------

	public function add_swap($data)
	{
		$this->db->insert('swap', $data);
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
	
		$id = $this->db->insert_id(); 
		return $id;
		
	}

//---------------------------------------------------------------------------

	public function update_booking($id,$user)
	{
		$this->db->where('id', $id); 
		$this->db->update('bookings', $user);
	}

//---------------------------------------------------------------------------

	public function delete_swap($id)
	{
		$this->db->where('booking_id', $id);
		$this->db->delete('swap');
		
		if($this->db->affected_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
		
	}
	
} // end of holiday_model.php