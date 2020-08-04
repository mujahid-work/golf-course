<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		
		$this->session->set_userdata('current_page','Items');
		
		if(!isset($_SESSION['logged_in_id'])){
			redirect('login','refresh');
		}

		$this->load->model("admin/CatgeoriesModel","categories_m");
		$this->load->model("admin/ItemsModel","items_m");
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

		$main_active_catgs_data = $this->categories_m->fetchActiveMainCategories();
		$sub_active_catgs_data = $this->categories_m->fetchActiveSubCategories();
		$all_items_data = $this->items_m->fetchAllItems();
		$notifications_data = $this->dash_m->fetchNotifications();
        
		$data['view_to_load']="admin/pages/manage_items";
		$data['main_active_catgs_data']=$main_active_catgs_data;
		$data['sub_active_catgs_data']=$sub_active_catgs_data;
		$data['all_items_data']=$all_items_data;
		$data['notifications_data']=$notifications_data;
		$data['page_title']="Manage Items";
		$this->load->view('admin/layouts/dashboard_layout',$data);
	}
	
	public function addItem(){

		if(isset($_POST['item_add_btn'])){

			$this->form_validation->set_rules('item_title_field','Item Title','trim|required');
			$this->form_validation->set_rules('item_main_catg_field','Main Category','trim|required');
			$this->form_validation->set_rules('item_sub_catg_field','Sub Category','trim|required');
			$this->form_validation->set_rules('item_description_field','Item Description','trim|required');
			$this->form_validation->set_rules('item_price_field','Item Price','trim|required');
			$this->form_validation->set_rules('item_availability_field','Item Availability','trim|required');
			$this->form_validation->set_rules('item_status_field','Item Status','trim|required');

			if($this->form_validation->run()==TRUE){

				$item_pic='';
						
				$_FILES['file']['name']       = $_FILES['item_image_field']['name'];
				$_FILES['file']['type']       = $_FILES['item_image_field']['type'];
				$_FILES['file']['tmp_name']   = $_FILES['item_image_field']['tmp_name'];
				$_FILES['file']['error']      = $_FILES['item_image_field']['error'];
				$_FILES['file']['size']       = $_FILES['item_image_field']['size'];
				
				$uploadPath = './uploads/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){
					
					$attachmentData = $this->upload->data();
					$item_pic = $attachmentData['file_name'];
				}

				$item_data=array(
					'main_catg_id' => $this->input->post('item_main_catg_field'),
					'sub_catg_id' => $this->input->post('item_sub_catg_field'),
					'item_title' => $this->input->post('item_title_field'),
					'item_description' => $this->input->post('item_description_field'),
					'item_price' => $this->input->post('item_price_field'),
					'item_availability' => $this->input->post('item_availability_field'),
					'item_status' => $this->input->post('item_status_field'),
					'item_image' => $item_pic
				);

				$value=$this->items_m->addItem($item_data);

				if($value==true){
					$this->session->set_flashdata('item_add_succ', 'Heads up! Item added successfully.'); 
					redirect('admin/Items/','refresh');
				}
				else{
					$this->session->set_flashdata('item_add_err', 'Oh Snap! Item is not added. Please try again!'); 
					redirect('admin/Items/','refresh');
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

	public function enableItem($item_id){

		$data = array(
			'item_status' => 'Active'
		);
		
		$value = $this->items_m->enableItem($data,$item_id);

		if($value==true){
			$this->session->set_flashdata('item_enable_succ', '<b>Heads up!</b> Item enabled successfully.');
			redirect('admin/Items/','refresh');
		}
		else{
			$this->session->set_flashdata('item_enable_err', '<b>Oh Snap!</b> Item is not enabled. Please try again!');
			redirect('admin/Items/','refresh');
		}
	}

	public function disableItem($item_id){

		$data = array(
			'item_status' => 'In-Active'
		);
		
		$value = $this->items_m->disableItem($data,$item_id);

		if($value==true){
			$this->session->set_flashdata('item_disable_succ', '<b>Heads up!</b> Item disabled successfully.');
			redirect('admin/Items/','refresh');
		}
		else{
			$this->session->set_flashdata('item_disable_err', '<b>Oh Snap!</b> Item is not disabled. Please try again!');
			redirect('admin/Items/','refresh');
		}
	}

	public function fetchSingleItem(){

		$item_id = $this->input->post('id');

		$single_item_data = $this->items_m->fetchSingleItem($item_id);

		echo json_encode(array(
			'single_item_data' => $single_item_data
		));
	}

	public function updateItem(){

		$item_pic='';
		$item_id = $this->input->post('id_field');
		$item_pic = $this->input->post('item_old_pic_field');
						
		$_FILES['file']['name']       = $_FILES['item_edit_image_field']['name'];
		$_FILES['file']['type']       = $_FILES['item_edit_image_field']['type'];
		$_FILES['file']['tmp_name']   = $_FILES['item_edit_image_field']['tmp_name'];
		$_FILES['file']['error']      = $_FILES['item_edit_image_field']['error'];
		$_FILES['file']['size']       = $_FILES['item_edit_image_field']['size'];
		
		$uploadPath = './uploads/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('file')){
			
			$attachmentData = $this->upload->data();
			$item_pic = $attachmentData['file_name'];
		}

		$item_data=array(
			'main_catg_id' => $this->input->post('item_edit_main_catg_field'),
			'sub_catg_id' => $this->input->post('item_edit_sub_catg_field'),
			'item_title' => $this->input->post('item_edit_title_field'),
			'item_description' => $this->input->post('item_edit_description_field'),
			'item_price' => $this->input->post('item_edit_price_field'),
			'item_availability' => $this->input->post('item_edit_availability_field'),
			'item_status' => $this->input->post('item_edit_status_field'),
			'item_image' => $item_pic
		);

		$value=$this->items_m->updateItem($item_data,$item_id);

		if($value==true){
			$this->session->set_flashdata('item_edit_succ', 'Heads up! Item updated successfully.');
			echo json_encode(array(
				'status' => 'success'
			));
		}
		else{
			$this->session->set_flashdata('item_edit_err', 'Oh Snap! Item is not updated. Please try again!');
			echo json_encode(array(
				'status' => 'fail'
			));
		}
	}
}
