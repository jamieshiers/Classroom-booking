<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Holiday extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('holiday_model');
		$this->template->set_layout('default');
		
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
	
	// function for displaying holidays
//---------------------------------------------------------------------------	
	public function index()
	{
		$this->template->set_layout('default');
		$data['holiday'] = $this->holiday_model->get_holidays();
		$this->template->title('Holidays');
		$this->template->build('holiday', $data);
		
	}
	
	// function for adding a holiday
//---------------------------------------------------------------------------	
	public function add_holiday()
	{
		$this->template->title('Add Holiday'); 
		$this->template->build('add_holiday');
		
		$this->form_validation->set_rules('name', 'Holiday Name', 'required'); 
		$this->form_validation->set_rules('date_start', 'Start Date', 'required'); 
		$this->form_validation->set_rules('date_end', 'End Date', 'required');
		
		$validate = $this->form_validation->run(); 
		
		if($validate == FALSE)
		{
			$this->template->build('add_holiday');
		}
		else
		{
			
			$date_start = $this->input->post('date_start');
		 	$date_end = $this->input->post('date_end');			
			
			$date_start = explode("/", $date_start);
			$datestart = $date_start[2];
			$datestart .= "-";
			$datestart .= $date_start[0];
			$datestart .= "-";
			$datestart .= $date_start[1];
			
			$date_end = explode("/", $date_end);
			$dateend= $date_end[2];
			$dateend.= "-";
			$dateend.= $date_end[0];
			$dateend.= "-";
			$dateend.= $date_end[1];
			
			$update = array(
				'name' => $this->input->post('name', TRUE), 
				'date_start' => $datestart, 
				'date_end' => $dateend,
			);
			
			$insert = $this->holiday_model->add_holiday($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Holiday not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Holiday Saved');
			}
			
			redirect('holiday');
		}
	}
//---------------------------------------------------------------------------	
	public function edit_holiday()
	{
		$id = $this->uri->segment(4);
		
		$data['holiday'] = $this->holiday_model->get_holiday_by_id($id);
		
		$this->template->title('Edit Holiday'); 
		$this->template->build('edit_holiday', $data);
		
		$this->form_validation->set_rules('name', 'Holiday Name', 'required'); 
		$this->form_validation->set_rules('date_start', 'Start Date', 'required'); 
		$this->form_validation->set_rules('date_end', 'End Date', 'required');
		
		$validate = $this->form_validation->run(); 
		
		if($validate == FALSE)
		{
			$this->template->build('edit_holiday', $data);
		}
		else
		{
			$date_start = $this->input->post('date_start');
		 	$date_end = $this->input->post('date_end');			
			
			$date_start = explode("/", $date_start);
			$datestart = $date_start[2];
			$datestart .= "-";
			$datestart .= $date_start[0];
			$datestart .= "-";
			$datestart .= $date_start[1];
			
			$date_end = explode("/", $date_end);
			$dateend= $date_end[2];
			$dateend.= "-";
			$dateend.= $date_end[0];
			$dateend.= "-";
			$dateend.= $date_end[1];
			
			
			$update = array(
				'id' => $id,
				'name' => $this->input->post('name', TRUE), 
				'date_start' => $datestart, 
				'date_end' => $dateend,
			);
			
			$insert = $this->holiday_model->edit_holiday($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Holiday not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Holiday Saved');
			}
			
			redirect('holiday');
		}
		
	}
//---------------------------------------------------------------------------

	public function delete_holiday()
	{
		$holiday_id = $this->uri->segment(4); 
		
		$this->holiday_model->delete_holiday($holiday_id);
		$this->session->set_flashdata('msg', 'Holiday Deleted');
		
		redirect('holiday');
		
	}
	
	
}//end of holiday.php 
