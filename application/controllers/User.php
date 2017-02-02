<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	
	
	public function profile()
	{
		$id=$this->session->userdata('user_id');
		$this->db->select("photo_url,user_name_full,user_designation,user_joining_date")
					->from("registration")
					->where("id",$id);
		$query = $this->db->get();
		$row = $query->row_array();
						
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{
			$data['user_name_full'] =  $row['user_name_full'];	 
			$data['user_designation'] =  $row['user_designation'];	 
			$data['user_joining_date'] =  $row['user_joining_date'];
			$data['photo_url'] = $row['photo_url']!="" ? $row['photo_url']:"images/person-photo.png";	
			$this->load->view('user/profile',$data);
			return;
		}
		
		$data['user_name_full']=$this->input->post("user_name_full");
		$data['user_designation']=$this->input->post("user_designation");
		$data['user_joining_date']=$this->input->post("user_joining_date");
		$photo_url=$this->session->userdata("photo_url".$id);
		if(isset($photo_url))
		{
			$data['photo_url'] = $photo_url;
			$filte_name='user_photo/'.$id.'.jpg';
			copy ($data['photo_url'],$filte_name);
			$data['photo_url']=$filte_name;
		}
		else
			$data['photo_url'] = $row['photo_url']!="" ? $row['photo_url']:"images/person-photo.png";	
			
	
		$this->db->where('id',$id);
		$this->db->update('registration', $data);
		$this->session->set_userdata($data);
		$this->load->view('user/profile',$data);
	}
	
	public function user_photo()
	{	
		$id=$this->session->userdata('user_id');
		
		$file_path = "uploads/".basename($_FILES["PhotoUrl"]["name"]);
		if(!move_uploaded_file($_FILES["PhotoUrl"]["tmp_name"], $file_path))
		{
			echo json_encode("Image could not saved");
		}
		else
		{
			$this->session->set_userdata("photo_url".$id,$file_path);
			echo json_encode("Image temporary saved");
		}
		return;
		
		
		$config['upload_path'] = "uploads/";
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size'] = '100';
		//$config['max_width'] = '100';
		//$config['max_height'] = '100';
		$config['file_name'] = $id.'_';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('file'))
		{
			$data['message']=$this->upload->display_errors();
			echo json_encode($data);
		}
		else
		{
			$data = $this->upload->data();
			$file_path="uploads/".$data['file_name'];
			//$this->db->where('id', $id);
			//$this->db->update('registration', array('photo_url'=>$file_path));
			$this->session->set_userdata("photo_url".$id,$file_path);
			echo json_encode($this->config->base_url().$file_path);
		}		
	}
	
	public function change_password()
	{
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{
			$this->load->view('user/change_password');
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
			$this->load->view('user/change_password',$data);
			return;
		}		
		$this->db->where('email', $data['email']);
		$this->db->update('registration', array('password'=>$data['password']));
		
		$data["message"]="Password has changed successfully
    	<br/>Click <a href=".$this->config->base_url("user/change_password")." >here</a> to re-login";
		$this->session->sess_destroy();
		$this->load->view('success',$data);
	}
	
	public function user_privilege()
	{
		$sql="select id,name,form_name from privilege";			
		$data["privileges"]=$this->db->query($sql)->result_array();
		//$data["form_body"]=$this->user_privilege_form_body($data["privileges"][0]['id']);
		$this->load->view('user/user_privilege',$data);
	}
	
	function get_dropdown($data)
	{
		foreach($data as $row){
			$return[$row['id']] = $row['name']."(".$row['id'].")";
    	}
    	return $return;
	}
	
	public function company_include()
	{
		$data["user_id"]=$this->input->get("user_id");
		if(!$data["user_id"])
		$data["user_id"]=$this->session->userdata("user_id");
		
		$sql="select c.id,c.name,
			(select id from company_user where company_id=c.id 
			and user_id=".$data["user_id"].") as company_id
			from company c";
		$data["company"]= $this->db->query($sql)->result_array();
		$sql="select id,user_name as name from registration";
		$data["user"]=$this->get_dropdown($this->db->query($sql)->result_array());
		$submit=$this->input->post("submit");
		if(!isset($submit))
		{	
			$this->load->view('user/company_include',$data);
			return;
		}
		
		$data["user_id"]=$this->input->post("user_id");
		$company_user =array();
		for($i=0;$i<count($data["company"]);$i++)
			if($this->input->post("company".$data["company"][$i]["id"]))
			 $company_user[]=array(
			 'user_id'=>$data["user_id"],
			 'company_id'=>$data["company"][$i]["id"],
			 'modify_user_id'=>$this->session->userdata("user_id")
			 );

		$this->db->trans_start();
		try{
			
			$sql="delete from company_user where user_id=".$data["user_id"];
			$this->db->query($sql);
			foreach($company_user as $row)		
			$this->db->insert('company_user',$row);
			//$data["id"]=$this->db->insert_id();
		}
		catch(Exception $e){
            $this->db->trans_rollback();
			$data["error"]=$e->getMessage();
			$this->load->view('user/company_include',$data);
			return;
        }					
		$this->db->trans_complete(); 		 
		$this->load->view('user/company_include',$data);
	}	
	
	
	function user_privilege_form_body($privilege_id)
	{
		$user_id=$this->session->userdata("user_id");
		$sql="select id,array_values from user_privilege
		where privilege_id=".$privilege_id."
		and user_id=".$user_id;
		$date["array_values"]= $this->db->query($sql)->result_array();
	}	
}
