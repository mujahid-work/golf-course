<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->session->set_userdata('current_page','Dashboard');
		
		
		if(!isset($_SESSION['logged_in_id'])){
			redirect('login','refresh');
		}

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
		
		$total_submitted_orders = $this->dash_m->fetchSubmittedOrdersCount();
		$total_users = $this->dash_m->fetchUsersCount();
		$total_items = $this->dash_m->fetchItemsCount();
		$total_seats = $this->dash_m->fetchSeatsCount();
		$notifications_data = $this->dash_m->fetchNotifications();

		$data['view_to_load']="admin/pages/dashboard";
		$data['page_title']="Dashboard";
		$data['total_submitted_orders']=$total_submitted_orders;
		$data['total_users']=$total_users;
		$data['total_items']=$total_items;
		$data['total_seats']=$total_seats;
		$data['notifications_data']=$notifications_data;
		$this->load->view('admin/layouts/dashboard_layout',$data);
	}

	public function accountSettings() {

		$this->session->set_userdata('current_page','Account Settings');
		$admin_profile_data=$this->dash_m->fetchAdminProfile();
		$notifications_data = $this->dash_m->fetchNotifications();

		$data['view_to_load']="admin/pages/account_settings";
		$data['page_title']="Account Settings";
		$data['admin_profile_data'] = $admin_profile_data;
		$data['notifications_data']=$notifications_data;
		$this->load->view('admin/layouts/dashboard_layout',$data);
	}

	public function updateAdminProfile(){

		if(isset($_POST['admin_profile_updt_btn'])){

			$admin_id = $_SESSION['logged_in_id'];

			$admin_profile_data=array(
				'full_name' => $this->input->post('full_name_field'),
				'email' => $this->input->post('email_field'),
				'phone' => $this->input->post('number_field')
			);

			$value=$this->dash_m->updateAdminProfile($admin_profile_data,$admin_id);

			if($value==true){
				$this->session->set_flashdata('admin_profile_updt_succ', 'Heads up! Profile updated successfully.'); 
				redirect('admin/Dashboard/accountSettings','refresh');
			}
			else{
				$this->session->set_flashdata('admin_profile_updt_err', 'Oh Snap! Profile is not updated. Please try again!'); 
				redirect('admin/Dashboard/accountSettings','refresh');
			}
		}
		else{
			$this->accountSettings();
		}
	}
	
	public function updateAdminPassword(){

		if(isset($_POST['admin_password_updt_btn'])){

			$this->form_validation->set_rules('current_pass_field','Current Password','trim|required|min_length[6]|alpha_numeric');
			$this->form_validation->set_rules('new_pass_field', 'New Password', 'trim|required|min_length[6]|alpha_numeric');
			$this->form_validation->set_rules('confirm_pass_field', 'Confirm New Password', 'trim|required|min_length[6]|alpha_numeric|matches[new_pass_field]');

			if($this->form_validation->run()==TRUE){

				$admin_profile_data=$this->dash_m->fetchAdminProfile();

				if($admin_profile_data->password == md5($this->input->post('current_pass_field'))){
					
					$admin_id = $_SESSION['logged_in_id'];

					$password_data=array(
						'password' => md5($this->input->post('new_pass_field'))
					);

					$value=$this->dash_m->updateAdminPassword($password_data,$admin_id);

					if($value==true){
						$this->session->set_flashdata('admin_password_updt_succ', 'Heads up! Password Updated successfully.'); 
						redirect('Login/logout','refresh');
					}
					else{
						$this->session->set_flashdata('admin_password_updt_err', 'Oh Snap! Password is not updated. Please try again!'); 
						redirect('admin/Dashboard/accountSettings','refresh');
					}
				}
				else{
					$this->session->set_flashdata('admin_password_updt_err', 'Oh Snap! Your current password does not match. Please try again!'); 
					redirect('admin/Dashboard/accountSettings','refresh');
				}
			}
			else{
				$this->accountSettings();
			}
		}
		else{
			$this->accountSettings();
		}
	}

	public function readNotification($notification_id,$order_id){

		$notification_data = array(
			'is_read' => 'Yes'
		);
		
		$this->dash_m->readNotification($notification_data,$notification_id);
			
		redirect('admin/Orders/viewOrderDetails/'.$order_id,'refresh');
	}
}
