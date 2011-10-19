<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Subjects extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('subjects_model');
		$this->template->set_layout('default');
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
	
	// function for displaying Room
//---------------------------------------------------------------------------	
	public function index()
	{
		$data['subjects'] = $this->subjects_model->get_subjects();
		$this->template->title('Subjects');
		$this->template->build('subjects', $data);
		
	}
	
	// function for adding a Room
//---------------------------------------------------------------------------	
	public function add_subject()
	{
		$this->template->title('Add Subject'); 
		$this->template->build('add_subject');
		
		$this->form_validation->set_rules('subject', 'Subject Name', 'required'); 
	
		$validate = $this->form_validation->run(); 
		
		if($validate == FALSE)
		{
			$this->template->build('add_subject');
		}
		else
		{
			$update = array(
				'subject' => $this->input->post('subject', TRUE), 
				
				);
			
			$insert = $this->subjects_model->add_subject($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Subject not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Subject Saved');
			}
			
			redirect('subjects');
		}
	}
//---------------------------------------------------------------------------	
	public function edit_subject()
	{
		$id = $this->uri->segment(4);
	
		$data['subject'] = $this->subjects_model->get_subject_by_id($id);
		
		$this->template->title('Edit Subject'); 
		$this->template->build('edit_subject', $data);
		
		$this->form_validation->set_rules('subject', 'Subject Name', 'required'); 
				
		$validate = $this->form_validation->run();
		
		if($validate == FALSE)
		{
			$this->template->build('edit_subject', $data);
		}
		else
		{
			$update = array(
				'id' => $id,
				'subject' => $this->input->post('subject', TRUE) 
				);
			
			$insert = $this->subjects_model->edit_subject($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Period not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Period Saved');
			}
			
			redirect('subjects');
		}
		
	}
//---------------------------------------------------------------------------

	public function delete_subject()
	{
		$period_id = $this->uri->segment(4); 
		
		$this->subjects_model->delete_subject($period_id);
		$this->session->set_flashdata('msg', 'Subject Deleted');
		
		redirect('subjects');
		
	}
	
	
}//end of holiday.php 
