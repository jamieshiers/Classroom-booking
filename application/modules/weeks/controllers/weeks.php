<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


class Weeks extends Controller
{
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('weeks_model');
		$this->template->set_layout('default');
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
//---------------------------------------------------------------------------

	public function index()
	{
		$this->load->model('settings/settings_model'); 
		$data['week_1_name'] = $this->settings_model->get_setting('week_1_name')->setting_value;
		$data['week_2_name'] = $this->settings_model->get_setting('week_2_name')->setting_value;
		$this->template->title('Weeks'); 
		$this->template->build('weeks', $data);
		
	} 
//---------------------------------------------------------------------------
	
	public function save_weeks()
	{
		$this->load->model('settings/settings_model'); 
		$week = $this->input->post('week_num');
		$week1 = $this->input->post('week1');
		$week2 = $this->input->post('week2');
		
			$update = array('setting_value' => $week);
		   	$this->settings_model->update($update, 'settings', 'weeks');
			$update = array('setting_value' => $week1);
		   	$this->settings_model->update($update, 'settings', 'week_1_name');
			$update = array('setting_value' => $week2);
		   	$this->settings_model->update($update, 'settings', 'week_2_name');
		
		redirect('dashboard');
	}
	
	


//---------------------------------------------------------------------------	
	public function add_year()
	{
		$this->template->title('Add Academic Year'); 
		$this->template->build('add_year');
		
		$this->form_validation->set_rules('date_start', 'Start Date', 'required'); 
		$this->form_validation->set_rules('date_end', 'End Date', 'required');
		
		$validate = $this->form_validation->run(); 
		
		if($validate === FALSE)
		{
			$this->template->build('add_year');
		}
		else
		{
		 	$date_start = $this->input->post('date_start');
		 	$date_end = $this->input->post('date_end');			
			
			$date_start = explode("/", $date_start);
			$datestart = $date_start[2];
			$datestart .= "-";
			$datestart .= $date_start[1];
			$datestart .= "-";
			$datestart .= $date_start[0];
			
			$date_end = explode("/", $date_end);
			$dateend= $date_end[2];
			$dateend.= "-";
			$dateend.= $date_end[1];
			$dateend.= "-";
			$dateend.= $date_end[0];
			
			$data = array(
				'date_start' => $datestart, 
				'date_end' => $dateend);
				
			$insert = $this->weeks_model->add_year($data);
			
			if($insert == TRUE)
			{
				$this->session->set_flashdata('msg', 'Year Saved');
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('error', "Year couldn't be saved!");
				redirect('dashboard');
			}
		}
		
	}
//---------------------------------------------------------------------------

	public function add_week()
	{
		$data['monday'] = $this->weeks_model->getmonday();
		$data['holiday'] = $this->weeks_model->get_holidays();
		
		$this->template->title('Add Week'); 
		$this->template->build('add_week', $data);
		
		$this->form_validation->set_rules('name', 'Week Name', 'required');
		$validate = $this->form_validation->run();
		if($validate == FALSE)
		{
			$this->template->build('add_week');
		}
		else
		{
			$data = array('name' => $this->input->post('name'));
			
			$insert = $this->weeks_model->add_week($data);

			
	
			$week['id'] = $insert; 
			$week['dates'] = $this->input->post('date'); 
			
			
			//print_r($this->input->post('date'))	;		
			$add = $this->weeks_model->add_monday($week);
		
			if($insert == TRUE)
			{
				$this->session->set_flashdata('msg', 'Week Saved');
				redirect('weeks');
			}
			else
			{
				$this->session->set_flashdata('error', "Week couldn't be saved!");
				redirect('weeks');
			}
		}
	}
//---------------------------------------------------------------------------
	 
	public function delete_week()
	{
		$id = $this->uri->segment(4);
		$delete = $this->weeks_model->delete_week($id);
		if($delete)
		{
			$this->session->set_flashdata('msg', 'Week deleted'); 
			redirect('weeks');
		}
		else
		{
			$this->session->set_flashdata('error', "Week couldn't be deleted!"); 
			redirect('weeks');
		}
		
	}


}