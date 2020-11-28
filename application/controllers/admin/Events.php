<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		
		$this->session->set_userdata('current_page','Events');
		
		if(!isset($_SESSION['logged_in_id'])){
			redirect('login','refresh');
        }
        
		$this->load->model("admin/EventsModel","events_m");
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

		$all_events_data = $this->events_m->fetchAllEvents();
		$notifications_data = $this->dash_m->fetchNotifications();
        
		$data['view_to_load']="admin/pages/manage_events";
		$data['all_events_data']=$all_events_data;
		$data['notifications_data']=$notifications_data;
		$data['page_title']="Manage Events";
		$this->load->view('admin/layouts/dashboard_layout',$data);
	}
	
	public function addEvent(){

		if(isset($_POST['event_add_btn'])){

			$this->form_validation->set_rules('event_title_field','Event Title','trim|required');
			$this->form_validation->set_rules('event_description_field','Event Description','trim|required');
			$this->form_validation->set_rules('event_date_field','Event Date','trim|required');
			$this->form_validation->set_rules('event_status_field','Event Status','trim|required');

			if($this->form_validation->run()==TRUE){

				$event_pic='';
						
				$_FILES['file']['name']       = $_FILES['event_image_field']['name'];
				$_FILES['file']['type']       = $_FILES['event_image_field']['type'];
				$_FILES['file']['tmp_name']   = $_FILES['event_image_field']['tmp_name'];
				$_FILES['file']['error']      = $_FILES['event_image_field']['error'];
				$_FILES['file']['size']       = $_FILES['event_image_field']['size'];
				
				$uploadPath = './uploads/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = '*';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('file')){
					
					$attachmentData = $this->upload->data();
					$event_pic = $attachmentData['file_name'];
                }

				$event_data=array(
					'event_title' => $this->input->post('event_title_field'),
					'event_description' => $this->input->post('event_description_field'),
					'event_date' => date("Y-m-d", strtotime($this->input->post('event_date_field'))),
					'event_status' => $this->input->post('event_status_field'),
					'event_image' => $event_pic
				);

				$value=$this->events_m->addEvent($event_data);

				if($value==true){
					$this->session->set_flashdata('event_add_succ', 'Heads up! Event added successfully.'); 
					redirect('admin/events/','refresh');
				}
				else{
					$this->session->set_flashdata('event_add_err', 'Oh Snap! Event is not added. Please try again!'); 
					redirect('admin/events/','refresh');
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

	public function enableEvent($event_id){

		$data = array(
			'event_status' => 'Active'
		);
		
		$value = $this->events_m->enableEvent($data,$event_id);

		if($value==true){
			$this->session->set_flashdata('event_enable_succ', '<b>Heads up!</b> Event enabled successfully.');
			redirect('admin/events/','refresh');
		}
		else{
			$this->session->set_flashdata('event_enable_err', '<b>Oh Snap!</b> Event is not enabled. Please try again!');
			redirect('admin/events/','refresh');
		}
	}

	public function disableEvent($event_id){

		$data = array(
			'event_status' => 'In-Active'
		);
		
		$value = $this->events_m->disableEvent($data,$event_id);

		if($value==true){
			$this->session->set_flashdata('event_disable_succ', '<b>Heads up!</b> Event disabled successfully.');
			redirect('admin/events/','refresh');
		}
		else{
			$this->session->set_flashdata('event_disable_err', '<b>Oh Snap!</b> Event is not disabled. Please try again!');
			redirect('admin/events/','refresh');
		}
	}

	public function fetchSingleEvent(){

		$event_id = $this->input->post('id');

		$single_event_data = $this->events_m->fetchSingleEvent($event_id);

		echo json_encode(array(
			'single_event_data' => $single_event_data
		));
	}

	public function updateEvent(){

		$event_pic='';
		$event_id = $this->input->post('id_field');
		$event_pic = $this->input->post('event_old_pic_field');
						
		$_FILES['file']['name']       = $_FILES['event_edit_image_field']['name'];
		$_FILES['file']['type']       = $_FILES['event_edit_image_field']['type'];
		$_FILES['file']['tmp_name']   = $_FILES['event_edit_image_field']['tmp_name'];
		$_FILES['file']['error']      = $_FILES['event_edit_image_field']['error'];
		$_FILES['file']['size']       = $_FILES['event_edit_image_field']['size'];
		
		$uploadPath = './uploads/';
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('file')){
			
			$attachmentData = $this->upload->data();
			$event_pic = $attachmentData['file_name'];
		}

		$event_data=array(
			'event_title' => $this->input->post('event_edit_title_field'),
			'event_description' => $this->input->post('event_edit_description_field'),
			'event_date' => date("Y-m-d", strtotime($this->input->post('event_edit_date_field'))),
			'event_status' => $this->input->post('event_edit_status_field'),
			'event_image' => $event_pic
		);

		$value=$this->events_m->updateEvent($event_data,$event_id);

		if($value==true){
			$this->session->set_flashdata('event_edit_succ', 'Heads up! Event updated successfully.');
			echo json_encode(array(
				'status' => 'success'
			));
		}
		else{
			$this->session->set_flashdata('event_edit_err', 'Oh Snap! Event is not updated. Please try again!');
			echo json_encode(array(
				'status' => 'fail'
			));
		}
	}
}
