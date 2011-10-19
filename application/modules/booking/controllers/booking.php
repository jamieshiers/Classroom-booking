<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Booking extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('booking_model');
		
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
//---------------------------------------------------------------------------

	public function view()
	{
		$id = $this->uri->segment(4);
		$data['id'] = $this->uri->segment(4); 
		$date = $this->uri->segment(5);
		
		
		if($id == "")
		{
			redirect('dashboard'); 
		}
		
		// if no date is given in the url, get it from todays date
		
		if($date == '')
		{
			// this is the code to give us mondays date
			$data['date'] = date('Y-m-d', mktime(0,0,0,date('m'), date('d')-date('w')+1, date('Y')));
			// this will give us date of friday
			$enddate = date("Y-m-d", mktime(0,0,0,date('m'),date('d')-date('w')+7,date('Y')));
		}
		else {
			// Split the given date down into day, month, and year values
			list($year,$month,$day) = explode('-', $date);
			
			// Our temporary date is used to find out the day number of the chosen date
			// i.e. Friday return number 5
			$tmpdate = new DateTime($date);
			$dayname = $tmpdate->format('w');
			
			// Piece together the date, changing the date to that of the start of the week
			$data['date'] = date('Y-m-d', mktime(0,0,0,$month, $day-$dayname+1, $year));
			
			// Also, we need the date for the last day of the week too
			$enddate = date('Y-m-d', mktime(0,0,0,$month, $day-$dayname+7, $year));
		}
		
		$this->load->model('settings/settings_model');
		$weeks = $this->settings_model->get_setting('weeks')->setting_value;
		$week1 = $this->settings_model->get_setting('week_1_name')->setting_value;
		$week2 = $this->settings_model->get_setting('week_2_name')->setting_value;
		
		$data['settings']['no_weeks'] = $weeks;
		$data['settings']['week1_name'] = $week1; 
		$data['settings']['week2_name'] = $week2;
		// we now have the dates to aid our search. 
		
		// we now need to get, periods, bookings and the room information
		
		$year_end = $this->booking_model->get_year();
		
		
		$data['periods'] = $this->booking_model->get_periods();
		
		$data['bookings'] = $this->booking_model->get_bookings($id, $data['date'], $enddate, $year_end); 
		
		$data['item'] = $this->booking_model->get_room($id);
		
		$data['weeks'] = $this->booking_model->cal($data['date']);
		
		// now generate the data for the sidebar to match the dashboard
		
		$user = $this->session->userdata['logged_in'];
		$data['bookingss'] = $this->booking_model->get_booking($user);
		
	
		
		$this->load->library('calendar');
		
		$data['calendar'] = $this->calendar->generate();
		
		
		$this->template->set_layout('sidebar');
		$this->template->set_partial('right_sidebar', 'sidebar', $data);
		$this->template->title('View Bookings'); 
		$this->template->build('booking', $data);		
	}
	
//---------------------------------------------------------------------------	
	public function add()
	{
		$data['room'] 	= $this->uri->segment(4); 
		$data['date'] 	= $this->uri->segment(5); 
		$data['period'] = $this->uri->segment(6);
		$data['week'] 	= $this->uri->segment(7);
		
		$data['users'] = $this->booking_model->get_users();
		$data['subjects'] = $this->booking_model->get_subjects();
	
		//$this->template->set_layout('default'); 
		$this->template->title('Add New Booking');
		$this->template->build('add_booking', $data);
		
		$this->form_validation->set_rules('Class', 'Class Name', 'required');
		$validate = $this->form_validation->run(); 
		
		if ($validate == FALSE)
		{
			$this->template->build('add_booking',$data);
		}
		else
		{
			
			
			$update = array(
				'class'		=> $this->input->post('Class', TRUE),
				'lesson' 	=> $this->input->post('Lesson', TRUE),
				'room_id'	=> $data['room'],
				'period_id' => $data['period'],
				'date'		=> $data['date'],
				'block'    	=> (isset($_POST['booking'])) ? 1 : 0, 
				'week_num'	=> $data['week'],
				'user'	    => $this->session->userdata('logged_in'),
				'email' 	=> $this->session->userdata('email'),
				'year_end' 	=> $this->booking_model->get_year(),			
					); 
				
				$user_id = $this->booking_model->add_booking($update);
				
				
				$email['room'] = $this->booking_model->get_room($data['room']);
				$email['period'] = $this->booking_model->get_single_period($data['period']);
				$email['week'] = $data['week'];
				
				
				list($year,$month,$day) = explode('-', $data['date']);
				
				$email['date'] = date('l j F Y', mktime(0,0,0,$month,$day,$year));
				
				$this->config->load('email');
				$this->email->from($this->config->item('from_email'), $this->config->item('from_name')); 
				$this->email->to($this->session->userdata('email')); 
				$this->email->subject('Your Booking Confirmation');
				
				$message = $this->load->view('booking_confirm_email', $email, TRUE);
			
				$this->email->message($message);
		
				$this->email->send();
				
				$this->session->set_flashdata('msg', 'Settings Saved'); 
				
				redirect('booking/booking/view/'. $data['room'].'/'.$data['date']);
		}
	}
//---------------------------------------------------------------------------
	public function delete()
	{
		$id = $this->uri->segment(4);
		$delete = $this->booking_model->delete_booking($id);
		if($delete == TRUE)
		{
		$this->session->set_flashdata('msg', 'Booking Deleted'); 	
		}
		else
		{
			$this->session->set_flashdata('error', 'Error deleting booking'); 
		}
		
		
		redirect('dashboard');
	}
//---------------------------------------------------------------------------

	public function uploadcsv()
	{
		$this->template->set_layout('default');
		$this->template->title('Upload CSV'); 
		$this->template->build('upload');
	}
//---------------------------------------------------------------------------

	public function processcsv()
	{
		$ext = $this->booking_model->ext($_FILES['csv']['name']); 
		
		if(strtolower($ext) == 'csv')
		{
			$time = time(); 
			$filename = $time.'.csv';
			
			move_uploaded_file($_FILES['csv']['tmp_name'], 
			FCPATH.'application/uploads/csv/'.$filename
			);
			$this->load->library('csvreader');
			
			$filepath = FCPATH.'application/uploads/csv/'.$filename; 
			$data['csv'] = $this->csvreader->parse_file($filepath);
			
			$insert = $this->booking_model->insert_csv($data['csv']);
			
			$this->session->set_flashdata('msg', $insert);
		}
		elseif($ext == '')
		{
			$this->session->set_flashdata('error', 'No file was Selected! Please try again.');
		}
		else
		{
			$this->session->set_flashdata('error', 'The file selected was not a CSV file. Please try again.');
		}
		
		$this->template->set_layout('default');
		$this->template->title('Upload CSV'); 
		$this->template->build('upload');
		
	}

//---------------------------------------------------------------------------

	public function info()
	{
		$id = $this->uri->segment(4);
		
		$data['bookings'] = $this->booking_model->get_booking_by_id($id);
		
		$this->template->build('booking_info', $data);
	}

//---------------------------------------------------------------------------

	public function swap()
	{
			
		$emails['id'] = $this->uri->segment(4); 
		
		$emails['bookings'] = $this->booking_model->get_booking_by_id($emails['id']);
		
		
		foreach($emails['bookings'] as $booking)
		{
			$emails['user'] = $booking->user;
			$email 	= $booking->email;
			$room 	= $booking->room_id;
			$date 	= $booking->date;
			$period = $booking->period_id;
			$emails['week'] = $booking->week_num;
			$date = $booking->date;
		}
		
		$emails['periods'] = $this->booking_model->get_single_period($period);
		
		$emails['room'] = $this->booking_model->get_room($room);
		
		$emails['request_user'] = $this->session->userdata['logged_in'];
		
		
		
		$update = array(
			'booking_id' => $emails['id'], 
			'user' => $emails['user'], 
			'request_user' => $emails['request_user'], 
			'room_name' => $emails['room']->name, 
			'periods' => $emails['periods']->period_name
		);
		
		$this->booking_model->add_swap($update);
		
		list($year,$month,$day) = explode('-', $date);
	
		$emails['date'] = date('l j F Y', mktime(0,0,0,$month,$day,$year));	
		
		
		// first send an email to the original booker
		
		$this->email->from('bookingbot@classroombooking.com', 'Booking Bot'); 
		$this->email->to($email);
		$this->email->subject('Room Request');
		
		$message = $this->load->view('room_swap_request_email', $emails, True);
		
		$this->email->message($message); 
		
		$this->email->send();
		
		
		$this->session->set_flashdata('msg', 'A email has been sent to the original booker'); 
	
		redirect('dashboard');

		
		
	}
	
//---------------------------------------------------------------------------

	public function swapconfirm()
	{
		$id = $this->uri->segment(4); 
		$user = $this->uri->segment(5);
		$swap_id = $this->uri->segment(6);
		$update = array(
			'class' => '',
			'lesson' => '',
			'user' => $user
		);	
		
		$this->booking_model->update_booking($id,$update);
		
		$this->booking_model->delete_swap($swap_id);
		
		redirect('dashboard');
	}
	
		
	
}
