<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->session->set_userdata('current_page','Categories');
		
		if(!isset($_SESSION['logged_in_id'])){
			redirect('login','refresh');
		}

		$this->load->model("admin/CatgeoriesModel","categories_m");
		$this->load->model("admin/DashboardModel","dash_m");
		
		$total_submitted_orders = $this->dash_m->fetchSubmittedOrdersCount();
		$total_accepted_orders = $this->dash_m->fetchAcceptedOrdersCount();
		$total_ready_orders = $this->dash_m->fetchReadyOrdersCount();
		$total_serving_orders = $this->dash_m->fetchServingOrdersCount();
		$total_completed_orders = $this->dash_m->fetchCompletedOrdersCount();
		$total_cancelled_orders = $this->dash_m->fetchCancelledOrdersCount();

		$orders_count = array(
			'total_submitted_orders' => $total_submitted_orders->total_submitted_orders,
			'total_accepted_orders' => $total_accepted_orders->total_accepted_orders,
			'total_ready_orders' => $total_ready_orders->total_ready_orders,
			'total_serving_orders' => $total_serving_orders->total_serving_orders,
			'total_completed_orders' => $total_completed_orders->total_completed_orders,
			'total_cancelled_orders' => $total_cancelled_orders->total_cancelled_orders
		);

		$this->session->set_userdata('orders_count',$orders_count);
	}

	public function index() {

		$main_all_catgs_data = $this->categories_m->fetchAllMainCategories();
		$sub_active_catgs_data = $this->categories_m->fetchAllSubCategoriesForMainCatgeories();
		$notifications_data = $this->dash_m->fetchNotifications();
		
		$data['view_to_load']="admin/pages/main_categories";
		$data['page_title']="Manage Main Categories";
		$data['main_all_catgs_data'] = $main_all_catgs_data;
		$data['sub_active_catgs_data'] = $sub_active_catgs_data;
		$data['notifications_data'] = $notifications_data;
		$this->load->view('admin/layouts/dashboard_layout',$data);
    }
    
    public function subCategories() {

		$main_active_catgs_data = $this->categories_m->fetchActiveMainCategories();
		$sub_all_catgs_data = $this->categories_m->fetchAllSubCategories();
		$notifications_data = $this->dash_m->fetchNotifications();
        
		$data['view_to_load']="admin/pages/sub_categories";
		$data['page_title']="Manage Sub-Categories";
		$data['main_active_catgs_data'] = $main_active_catgs_data;
		$data['sub_all_catgs_data'] = $sub_all_catgs_data;
		$data['notifications_data'] = $notifications_data;
		$this->load->view('admin/layouts/dashboard_layout',$data);
	}

	public function addMainCategory(){

		if(isset($_POST['main_catg_add_btn'])){

			$this->form_validation->set_rules('main_catg_title_field','Title','trim|required');
			$this->form_validation->set_rules('main_catg_status_field','Status','trim|required');

			if($this->form_validation->run()==TRUE){

				$main_catg_pic='';
						
				$_FILES['file']['name']       = $_FILES['main_catg_image_field']['name'];
				$_FILES['file']['type']       = $_FILES['main_catg_image_field']['type'];
				$_FILES['file']['tmp_name']   = $_FILES['main_catg_image_field']['tmp_name'];
				$_FILES['file']['error']      = $_FILES['main_catg_image_field']['error'];
				$_FILES['file']['size']       = $_FILES['main_catg_image_field']['size'];
				
				$uploadPath = './uploads/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){
					
					$attachmentData = $this->upload->data();
					$main_catg_pic = $attachmentData['file_name'];
				}

				$main_catg_data=array(
					'main_catg_title' => $this->input->post('main_catg_title_field'),
					'main_catg_status' => $this->input->post('main_catg_status_field'),
					'main_catg_image' => $main_catg_pic
				);

				$value=$this->categories_m->addMainCategory($main_catg_data);

				if($value==true){
					$this->session->set_flashdata('main_catg_add_succ', 'Heads up! Main Category added successfully.'); 
					redirect('admin/Categories/','refresh');
				}
				else{
					$this->session->set_flashdata('main_catg_add_err', 'Oh Snap! Main Category is not added. Please try again!'); 
					redirect('admin/Categories/','refresh');
				}
			}
			else{
				$this->index();
			}
		}
		else{
			$this->index();
		}
	}

	public function enableMainCategory($main_catg_id){

		$data = array(
			'main_catg_status' => 'Active'
		);
		
		$value = $this->categories_m->enableMainCategory($data,$main_catg_id);

		if($value==true){
			$this->session->set_flashdata('main_catg_enable_succ', '<b>Heads up!</b> Main Category enabled successfully.');
			redirect('admin/Categories/','refresh');
		}
		else{
			$this->session->set_flashdata('main_catg_enable_err', '<b>Oh Snap!</b> Main Category is not enabled. Please try again!');
			redirect('admin/Categories/','refresh');
		}
	}

	public function disableMainCategory($main_catg_id){

		$data = array(
			'main_catg_status' => 'In-Active'
		);
		
		$value = $this->categories_m->disableMainCategory($data,$main_catg_id);

		if($value==true){
			$this->session->set_flashdata('main_catg_disable_succ', '<b>Heads up!</b> Main Category disabled successfully.');
			redirect('admin/Categories/','refresh');
		}
		else{
			$this->session->set_flashdata('main_catg_disable_err', '<b>Oh Snap!</b> Main Category is not disabled. Please try again!');
			redirect('admin/Categories/','refresh');
		}
	}

	public function fetchSingleMainCategory(){

		$main_catg_id = $this->input->post('id');

		$single_main_catg_data = $this->categories_m->fetchSingleMainCategory($main_catg_id);

		echo json_encode(array(
			'single_main_catg_data' => $single_main_catg_data
		));
	}

	public function updateMainCategory(){

		$main_catg_pic='';
		$main_catg_id = $this->input->post('id_field');
		$main_catg_pic = $this->input->post('main_catg_old_pic_field');
						
		$_FILES['file']['name']       = $_FILES['main_catg_edit_image_field']['name'];
		$_FILES['file']['type']       = $_FILES['main_catg_edit_image_field']['type'];
		$_FILES['file']['tmp_name']   = $_FILES['main_catg_edit_image_field']['tmp_name'];
		$_FILES['file']['error']      = $_FILES['main_catg_edit_image_field']['error'];
		$_FILES['file']['size']       = $_FILES['main_catg_edit_image_field']['size'];
		
		$uploadPath = './uploads/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('file')){
			
			$attachmentData = $this->upload->data();
			$main_catg_pic = $attachmentData['file_name'];
		}

		$main_catg_data=array(
			'main_catg_title' => $this->input->post('main_catg_edit_title_field'),
			'main_catg_status' => $this->input->post('main_catg_edit_status_field'),
			'main_catg_image' => $main_catg_pic
		);

		$value=$this->categories_m->updateMainCategory($main_catg_data,$main_catg_id);

		if($value==true){
			$this->session->set_flashdata('main_catg_edit_succ', 'Heads up! Main Category updated successfully.');
			echo json_encode(array(
				'status' => 'success'
			));
		}
		else{
			$this->session->set_flashdata('main_catg_edit_err', 'Oh Snap! Main Category is not updated. Please try again!');
			echo json_encode(array(
				'status' => 'fail'
			));
		}
	}

	public function addSubCategory(){

		if(isset($_POST['sub_catg_add_btn'])){

			$this->form_validation->set_rules('sub_catg_title_field','Title','trim|required');
			$this->form_validation->set_rules('main_catg_field','Main Category','trim|required');
			$this->form_validation->set_rules('sub_catg_status_field','Status','trim|required');

			if($this->form_validation->run()==TRUE){

				$sub_catg_pic='';
						
				$_FILES['file']['name']       = $_FILES['sub_catg_image_field']['name'];
				$_FILES['file']['type']       = $_FILES['sub_catg_image_field']['type'];
				$_FILES['file']['tmp_name']   = $_FILES['sub_catg_image_field']['tmp_name'];
				$_FILES['file']['error']      = $_FILES['sub_catg_image_field']['error'];
				$_FILES['file']['size']       = $_FILES['sub_catg_image_field']['size'];
				
				$uploadPath = './uploads/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){
					
					$attachmentData = $this->upload->data();
					$sub_catg_pic = $attachmentData['file_name'];
				}

				$sub_catg_data=array(
					'main_catg_id' => $this->input->post('main_catg_field'),
					'sub_catg_title' => $this->input->post('sub_catg_title_field'),
					'sub_catg_status' => $this->input->post('sub_catg_status_field'),
					'sub_catg_image' => $sub_catg_pic
				);

				$value=$this->categories_m->addSubCategory($sub_catg_data);

				if($value==true){
					$this->session->set_flashdata('sub_catg_add_succ', 'Heads up! Sub Category added successfully.'); 
					redirect('admin/Categories/subCategories','refresh');
				}
				else{
					$this->session->set_flashdata('sub_catg_add_err', 'Oh Snap! Sub Category is not added. Please try again!'); 
					redirect('admin/Categories/subCategories','refresh');
				}
			}
			else{
				$this->subCategories();
			}
		}
		else{
			$this->subCategories();
		}
	}

	public function enableSubCategory($sub_catg_id){

		$data = array(
			'sub_catg_status' => 'Active'
		);
		
		$value = $this->categories_m->enableSubCategory($data,$sub_catg_id);

		if($value==true){
			$this->session->set_flashdata('sub_catg_enable_succ', '<b>Heads up!</b> Sub Category enabled successfully.');
			redirect('admin/Categories/subCategories','refresh');
		}
		else{
			$this->session->set_flashdata('sub_catg_enable_err', '<b>Oh Snap!</b> Sub Category is not enabled. Please try again!');
			redirect('admin/Categories/subCategories','refresh');
		}
	}

	public function disableSubCategory($sub_catg_id){

		$data = array(
			'sub_catg_status' => 'In-Active'
		);
		
		$value = $this->categories_m->disableSubCategory($data,$sub_catg_id);

		if($value==true){
			$this->session->set_flashdata('sub_catg_disable_succ', '<b>Heads up!</b> Sub Category disabled successfully.');
			redirect('admin/Categories/subCategories','refresh');
		}
		else{
			$this->session->set_flashdata('sub_catg_disable_err', '<b>Oh Snap!</b> Sub Category is not disabled. Please try again!');
			redirect('admin/Categories/subCategories','refresh');
		}
	}

	public function fetchSingleSubCategory(){

		$sub_catg_id = $this->input->post('id');

		$single_sub_catg_data = $this->categories_m->fetchSingleSubCategory($sub_catg_id);

		echo json_encode(array(
			'single_sub_catg_data' => $single_sub_catg_data
		));
	}

	public function updateSubCategory(){

		$sub_catg_pic='';
		$sub_catg_id = $this->input->post('id_field');
		$sub_catg_pic = $this->input->post('sub_catg_old_pic_field');
						
		$_FILES['file']['name']       = $_FILES['sub_catg_edit_image_field']['name'];
		$_FILES['file']['type']       = $_FILES['sub_catg_edit_image_field']['type'];
		$_FILES['file']['tmp_name']   = $_FILES['sub_catg_edit_image_field']['tmp_name'];
		$_FILES['file']['error']      = $_FILES['sub_catg_edit_image_field']['error'];
		$_FILES['file']['size']       = $_FILES['sub_catg_edit_image_field']['size'];
		
		$uploadPath = './uploads/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('file')){
			
			$attachmentData = $this->upload->data();
			$sub_catg_pic = $attachmentData['file_name'];
		}

		$sub_catg_data=array(
			'sub_catg_title' => $this->input->post('sub_catg_edit_title_field'),
			'sub_catg_status' => $this->input->post('sub_catg_edit_status_field'),
			'main_catg_id' => $this->input->post('main_catg_edit_field'),
			'sub_catg_image' => $sub_catg_pic
		);

		$value=$this->categories_m->updateSubCategory($sub_catg_data,$sub_catg_id);

		if($value==true){
			$this->session->set_flashdata('sub_catg_edit_succ', 'Heads up! Sub Category updated successfully.');
			echo json_encode(array(
				'status' => 'success'
			));
		}
		else{
			$this->session->set_flashdata('sub_catg_edit_err', 'Oh Snap! Sub Category is not updated. Please try again!');
			echo json_encode(array(
				'status' => 'fail'
			));
		}
	}
}
