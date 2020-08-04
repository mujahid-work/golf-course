<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model("admin/LoginModel","login_m");
	}

	public function index() {
		
		if(!isset($_SESSION['logged_in_id'])){
			
			$data['view_to_load']="admin/pages/login";
			$data['page_title']="Admin Login";
			$this->load->view('admin/layouts/login_layout',$data);
		}
		else{

			redirect('admin/dashboard','refresh');
		}
	}

	public function adminLoginValidate(){
		
		if(isset($_POST['admin_login'])){
			
			$this->form_validation->set_rules('email_field','Email','trim|required');
			$this->form_validation->set_rules('password_field','Password','required');
	
			if($this->form_validation->run()==TRUE){
	
				$email = $this->input->post('email_field');
				$password = $this->input->post('password_field');

				$data = array(
					'email' => $email,
					'password' => md5($password)
				);
				
				$admin_data = $this->login_m->adminLoginValidate($data);

				if($admin_data == false){
					
					$this->session->set_flashdata("login_err","Oh Snap! Login Failed. Please try again!");
					redirect('login','refresh');
				}
				else{
					
					$admin_id=$admin_data->id;
					$admin_name=$admin_data->full_name;

					$this->session->set_userdata('logged_in_id',$admin_id);
					$this->session->set_userdata('logged_in_name',$admin_name);

					redirect('admin/dashboard','refresh');
				}
			}
			else{
				$this->index();
			}
		}else{
			$this->index();
		}
	}

	public function logout(){

		$this->session->unset_userdata('logged_in_id');
		$this->session->unset_userdata('logged_in_name');
		$this->session->unset_userdata('current_page');
		$this->session->unset_userdata('orders_count');

		redirect('login','refresh');
	}
}
