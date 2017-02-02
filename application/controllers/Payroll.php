<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->helper('security');
		if ($this->session->userdata('user_id') == FALSE)
		{
			redirect($this->config->base_url("welcome/login"));
			return;
		}
	}
	
	public function index()
	{	
		$data['device_id']="";
		$data['location_id']="";
		$data['number']="";
		$data['narration']="";
		$data['email']="";
		//$data['device_data']= $this->get_device();
		//$data['location_data']= $this->get_location();
		//$data['device_list']= $this->get_device_dropdown($data['device_data']);
		//$data['location_list']= $this->get_location_dropdown($data['location_data']);
		
		$this->load->view('home',$data);

	}
	
	public function get_login()
	{
		echo "ddd";
		return;
		$this->load->view('template/header');
		$this->load->view('login');
		$this->load->view('template/footer');
	}
}
