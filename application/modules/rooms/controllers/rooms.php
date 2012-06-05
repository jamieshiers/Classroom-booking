<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/


Class Rooms extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rooms_model');
		$this->template->set_layout('default');
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
	
	// function for displaying Room
//---------------------------------------------------------------------------	
	public function index()
	{
		$this->template->set_layout('default');
		$data['rooms'] = $this->rooms_model->get_rooms();
		$this->template->title('Rooms');
		$this->template->build('rooms', $data);
		
	}
	
	// function for adding a Room
//---------------------------------------------------------------------------	
	public function add_room()
	{
		$this->template->title('Add Room'); 
		$this->template->build('add_room');
		
		$this->form_validation->set_rules('name', 'Room Name', 'required'); 
	
		$validate = $this->form_validation->run(); 
		
		if($validate == FALSE)
		{
			$this->template->build('add_room');
		}
		else
		{
			$update = array(
				'name'		 => $this->input->post('name', TRUE), 
				'admin'		 => $this->input->post('admin', TRUE),
				'bookable'	 => (isset($_POST['bookable'])) ? 1 : 0
				);
			
			$insert = $this->rooms_model->add_room($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Room not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Room Saved');
			}
			
			redirect('rooms');
		}
	}
//---------------------------------------------------------------------------	
	public function edit_room()
	{
		$id = $this->uri->segment(4);
	
		$data['room'] = $this->rooms_model->get_room_by_id($id);
		
		$this->template->title('Edit Room'); 
		$this->template->build('edit_room', $data);
		
		$this->form_validation->set_rules('name', 'Room name', 'required'); 
				
		$validate = $this->form_validation->run();
		
		if($validate == FALSE)
		{
			$this->template->build('edit_room', $data);
		}
		else
		{
			$update = array(
				'roomid' => $id,
				'name' => $this->input->post('name', TRUE),
				'admin'		 => $this->input->post('admin', TRUE),
				'bookable' => (isset($_POST['bookable'])) ? 1 : 0
				);
			
			$insert = $this->rooms_model->edit_room($update);
			
			if($insert == FALSE)
			{
				$this->session->set_flashdata('error', 'Period not saved');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Period Saved');
			}
			
			redirect('rooms');
		}
		
	}
//---------------------------------------------------------------------------

	public function delete_room()
	{
		$period_id = $this->uri->segment(4); 
		
		$this->rooms_model->delete_room($period_id);
		$this->session->set_flashdata('msg', 'Room Deleted');
		
		redirect('rooms');
		
	}
	
	
}//end of holiday.php 
