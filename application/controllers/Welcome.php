<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('security');
	}
	
	public function index()
	{	
		if ($this->session->userdata('user_id') == FALSE)
		{
			redirect($this->config->base_url("welcome/login"));
			return;
		}
		redirect($this->config->base_url("payroll/index"));
	}
	
	public function register()
	{
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{
			$data['email']="";
			$data['user_name']="";
			$this->load->view('register',$data);
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'User Name',
		'trim|required|min_length[3]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('email', 'Email',
		'trim|required|valid_email|is_unique[registration.email]');
		$this->form_validation->set_rules('password', 'Password', 
		'trim|required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password',
		'trim|required');
		
		$data['user_name']=$this->input->post("user_name");
		$data['email']=$this->input->post("email");
		$data['password']=$this->input->post("password");
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register',$data);
			return;
		}		
		
		$data['verification_id']=uniqid();
		$this->db->trans_start();
		try{
			$this->db->insert('registration',$data);
			$data["id"]=$this->db->insert_id();
			
			$this->load->library('email');
			//$this->load->library('encrypt');
		
			$this->email
				->from('info@lostfoundbd.com', 'Payroll')
				->to($data['email'])
				->subject('Payroll verification')
				->message('Hi! '.$data['user_name']
				.',<br/> Please click follwing link to  <a href="'
				.$this->config->base_url("welcome/verification")
				.'?id='
				//.$this->encrypt->encode($data['verification_id'],"a123@3a")
				.$data['verification_id']
				.'" >verifiy</a> you request')
				->set_mailtype('html');
			$this->email->send();
		}
		catch(Exception $e){
            $this->db->trans_rollback();
			$data["error"]=$e->getMessage();
			$this->load->view('register',$data);
			return;
        }					
		$this->db->trans_complete(); 
		
		$data["message"]="Registration has completed successfully
    	<br/>Please check your e-mail to verification";
		$this->load->view('success',$data);
	}
	
	public function verification()
	{
		//$this->load->library('encrypt');
		$verification_id = $this->input->get("id");
		//$verification_id = $this->encrypt->decode($this->security->xss_clean($verification_id),"a123@3a");
		$verification_id = $this->security->xss_clean($verification_id);
		if($this->db->where('verification_id',$verification_id)->count_all_results('registration')<=0)
		{
			$data["message"]="Sorry! Invalid verification id";
			$this->load->view('error',$data);
			return;
		}
		
		if($this->db->where('verification_id',$verification_id)
		->where('verified','1')->count_all_results('registration')>0)
		{
			$data["message"]="You already have a registered";
			$this->load->view('error',$data);
			return;
		}
	
		$this->db->where('verification_id', $verification_id);
		$this->db->update('registration', array('verified'=>'1'));
			
		$data["message"]="Thank you for verified.
		</br> Now you have a registered user in the payroll.";
		$this->load->view('success',$data);
	}
	
	public function login()
	{
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{
			$data['email']="";
			$this->load->view('login',$data);
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email',
		'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		$data['email']=$this->input->post("email");
		$data['password']=$this->input->post("password");
					
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login',$data);
			return;
		}		
		
		$this->db->select("id,user_name,email,photo_url,
		user_name_full,user_designation,user_joining_date")
					->from("registration")
					->where("email",$data['email'])
					->where('password',$data['password'])
					->where('verified','1');
		$query = $this->db->get();
		if ($query->num_rows() <= 0)
		{
			$data["error"]="Invalid Email and Password ";
			$this->load->view('login',$data);
			return;
		}			
			
		$row = $query->row_array();
		$data['aap_name'] = "AA";				
		$data['aap_name_full'] = "Aarong Accounts";
		$data['user_id'] = $row['id'];
		$data['email'] = $row['email'];	
		$data['user_name'] = $row['user_name'];
		$data['user_name_full'] =  $row['user_name_full']!="" ? $row['user_name_full']:"Your full name";	 
		$data['user_designation'] =  $row['user_designation']!="" ? $row['user_designation']:"Your Designation";	 
		$data['user_joining_date'] =  $row['user_joining_date']!="" ? $row['user_joining_date']:"Joining date";	 
	
		$data['photo_url'] = $row['photo_url']!="" ? $row['photo_url']:"images/person-photo.png";		
		$this->session->set_userdata($data);
		redirect($this->config->base_url("payroll/index"));		
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect($this->config->base_url("welcome/login"));
	}
	
	public function forget()
	{
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{
			$data['email']="";
			$this->load->view('forget',$data);
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email',
		'trim|required|valid_email');
		
		$data['email']=$this->input->post("email");					
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('forget',$data);
			return;
		}		
		
		$this->db->select("user_name")
					->from("registration")
					->where("email",$data['email']);
		$query = $this->db->get();
		if ($query->num_rows() <= 0)
		{
			$data["error"]="Invalid Email";
			$this->load->view('forget',$data);
			return;
		}	
		$row = $query->row_array();
		$data['user_name']=$row['user_name'];
				
		$password=uniqid();
		$this->db->trans_start();
		try{
			$this->db->where('email', $data['email']);
    		$this->db->update('registration', array('verified'=>0,'verification_id'=>$password));
			
			$this->load->library('email');
			//$this->load->library('encrypt');
		
			$this->email
				->from('info@lostfoundbd.com', 'Payroll')
				->to($data['email'])
				->subject('Payroll password reset')
				->message('Hi! '.$data['user_name']
				.',<br/> Please click follwing link to  <a href="'
				.$this->config->base_url("welcome/forget_verification")
				.'?id='
				//.$this->encrypt->encode($password,"a123@3a")
				.$password
				.'" >reset password</a> you request')
				->set_mailtype('html');
			$this->email->send();
		}
		catch(Exception $e){
            $this->db->trans_rollback();
			$data["error"]=$e->getMessage();
			$this->load->view('forget',$data);
			return;
        }					
		$this->db->trans_complete();
		 
		$data["message"]="Password reset has completed successfully
    	<br/>Please check your e-mail to verification";
		$this->load->view('success',$data);	
	}
	
	public function forget_verification()
	{
		//$this->load->library('encrypt');
		$verification_id = $this->input->get("id");
		//$verification_id = $this->encrypt->decode($this->security->xss_clean($verification_id),"a123@3a");
		$verification_id = $this->security->xss_clean($verification_id);
		if($this->db->where('verification_id',$verification_id)->count_all_results('registration')<=0)
		{
			$data["message"]="Sorry! Invalid verification id";
			$this->load->view('error',$data);
			return;
		}
		
		if($this->db->where('verification_id',$verification_id)
		->where('verified','1')->count_all_results('registration')>0)
		{
			$data["message"]="You already have a verified";
			$this->load->view('error',$data);
			return;
		}
	
		$this->db->where('verification_id', $verification_id);
		$this->db->update('registration', array('verified'=>1));
			
		$this->db->select("email,user_name")
				->from("registration")
				->where('verification_id', $verification_id);	
		$query = $this->db->get();
		if ($query->num_rows() <= 0)
		{
			$data["message"]="Invalid Email";
			$this->load->view('error',$data);
			return;
		}	
		
		$row = $query->row_array();
		$data['user_name']=$row['user_name'];
		$data['email']=$row['email'];
		$this->session->set_userdata("email",$data['email']);
		$this->load->view('forget_change_password',$data);
	}
	
	public function forget_change_password()
	{
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{
			$this->load->view('forget_change_password',$data);
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 
		'trim|required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password',
		'trim|required');
		
		$data['email']=$this->session->userdata("email");
		$data['password']=$this->input->post("password");
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('forget_change_password',$data);
			return;
		}		
		$this->db->where('email', $data['email']);
		$this->db->update('registration', array('password'=>$data['password']));
		redirect($this->config->base_url("welcome/login"));
	}	

}
