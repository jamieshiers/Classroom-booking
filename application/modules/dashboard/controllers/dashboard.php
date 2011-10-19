<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/

Class Dashboard extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->template->set_layout('sidebar');
		$this->load->library('user_auth');
		$this->user_auth->protect();
	}
//---------------------------------------------------------------------------	
	public function index()
	{
		$data['rooms'] = $this->dashboard_model->get_room();
		
		$username = $this->session->userdata('logged_in');

		//$swap['swaps'] = $this->dashboard_model->swap($username);
		
		$user = $this->session->userdata['logged_in'];
		$data['bookings'] = $this->dashboard_model->get_booking($user);	
		$this->template->title('Dashboard'); 
		$this->template->set_partial('right_sidebar', 'sidebar', $data);
		$this->template->build('dashboard', $data);
	}
//---------------------------------------------------------------------------

	
}