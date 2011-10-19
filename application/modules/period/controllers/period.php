<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Period extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('period_model');
		$this->template->set_layout('default');
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
	
	// function for displaying holidays
//---------------------------------------------------------------------------	
	public function index()
	{
		$data['period'] = $this->period_model->get_periods();
		$this->template->title('Periods');
		$this->template->build('periods', $data);
		
	}
	
	// function for adding a holiday
//---------------------------------------------------------------------------	
	public function add_period()
	{
		$this->template->title('Add Period'); 
		$this->template->build('add_period');
		
		$this->form_validation->set_rules('name', 'Period Name', 'required'); 
		$this->form_validation->set_rules('start_hour', 'Start Time', 'required'); 
		$this->form_validation->set_rules('end_hour', 'End Time', 'required');
		
		$validate = $this->form_validation->run(); 
		
		if($validate == FALSE)
		{
			$this->template->build('add_period');
		}
		else
		{
			$update = array(
				'period_name' => $this->input->post('name', TRUE), 
				'start_time' => $this->input->post('start_hour', TRUE).':'.$this->input->post('start_minute', TRUE), 
				'end_time' => $this->input->post('end_hour', TRUE).':'.$this->input->post('end_minute', TRUE),
				'bookable' => (isset($_POST['bookable'])) ? 1 : 0
				);
			
			$insert = $this->period_model->add_period($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Period not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Period Saved');
			}
			
			redirect('period');
		}
	}
//---------------------------------------------------------------------------	
	public function edit_period()
	{
		$id = $this->uri->segment(4);
		
		$data['period'] = $this->period_model->get_period_by_id($id);
		
		$this->template->title('Edit Period'); 
		$this->template->build('edit_period', $data);
		
		$this->form_validation->set_rules('name', 'Period Name', 'required'); 
		$this->form_validation->set_rules('start_hour', 'Start Time', 'required'); 
		$this->form_validation->set_rules('end_hour', 'End Time', 'required');
		
		$validate = $this->form_validation->run();
		
		if($validate == FALSE)
		{
			$this->template->build('edit_period', $data);
		}
		else
		{
			$update = array(
				'periodid' => $id,
				'period_name' => $this->input->post('name', TRUE), 
				'start_time' => $this->input->post('start_hour', TRUE).':'.$this->input->post('start_minute', TRUE), 
				'end_time' => $this->input->post('end_hour', TRUE).':'.$this->input->post('end_minute', TRUE),
				'bookable' => (isset($_POST['bookable'])) ? 1 : 0
				);
			
			$insert = $this->period_model->edit_period($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Period not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Period Saved');
			}
			
			redirect('period');
		}
		
	}
//---------------------------------------------------------------------------

	public function delete_period()
	{
		$period_id = $this->uri->segment(4); 
		
		$this->period_model->delete_period($period_id);
		$this->session->set_flashdata('msg', 'Period Deleted');
		
		redirect('period');
		
	}
	
	
}//end of holiday.php 
