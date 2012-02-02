<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Years extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('years_model');
		$this->template->set_layout('default');
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
	
	// function for displaying Room
//---------------------------------------------------------------------------	
	public function index()
	{
		$data['years'] = $this->years_model->get_years();
		$this->template->title('Year Groups');
		$this->template->build('years', $data);
		
	}
	
	// function for adding a Room
//---------------------------------------------------------------------------	
	public function add_year()
	{
		$this->template->title('Add year Group'); 
		$this->template->build('add_year');
		
		$this->form_validation->set_rules('years', 'years Name', 'required'); 
	
		$validate = $this->form_validation->run(); 
		
		if($validate == FALSE)
		{
			$this->template->build('add_year');
		}
		else
		{
			$update = array(
				'year_name' => $this->input->post('years', TRUE), 
				
				);
			
			$insert = $this->years_model->add_years($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Years Group not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Year Group Saved');
			}
			
			redirect('years');
		}
	}
//---------------------------------------------------------------------------	
	public function edit_years()
	{
		$id = $this->uri->segment(4);
	
		$data['years'] = $this->years_model->get_years_by_id($id);
		
		$this->template->title('Edit years'); 
		$this->template->build('edit_year', $data);
		
		$this->form_validation->set_rules('years', 'years Name', 'required'); 
				
		$validate = $this->form_validation->run();
		
		if($validate == FALSE)
		{
			$this->template->build('edit_year', $data);
		}
		else
		{
			$update = array(
				'id' => $id,
				'year_name' => $this->input->post('years', TRUE) 
				);
			
			$insert = $this->years_model->edit_years($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Year group not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Year group Saved');
			}
			
			redirect('years');
		}
		
	}
//---------------------------------------------------------------------------

	public function delete_years()
	{
		$period_id = $this->uri->segment(4); 
		
		$this->years_model->delete_years($period_id);
		$this->session->set_flashdata('msg', 'years Deleted');
		
		redirect('years');
		
	}
	
	
}//end of holiday.php 
