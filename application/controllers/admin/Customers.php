<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Customers extends CI_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->session->set_userdata('current_page','Customers');
            
            if(!isset($_SESSION['logged_in_id'])){
                redirect('login','refresh');
            }

            $this->load->model("admin/CustomersModel","cus_m");
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
            
            $customers_data = $this->cus_m->fetchAllCustomers();
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/manage_customers";
            $data['page_title']="Manage Customers";
            $data['customers_data']=$customers_data;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function viewCustomerDetails($customer_id) {
            
            $customer_data = $this->cus_m->fetchSingleCustomer($customer_id);
            $customer_orders = $this->cus_m->fetchSingleCustomerOrders($customer_id);
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/view_customer_details";
            $data['page_title']="Manage Customers";
            $data['customer_data']=$customer_data;
            $data['customer_orders']=$customer_orders;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function enableCustomer($cus_id){

            $data = array(
                'status' => 'Active'
            );
            
            $value = $this->cus_m->enableCustomer($data,$cus_id);
    
            if($value==true){
                $this->session->set_flashdata('customer_enable_succ', '<b>Heads up!</b> Customer account enabled successfully.');
                redirect('admin/Customers/','refresh');
            }
            else{
                $this->session->set_flashdata('customer_enable_err', '<b>Oh Snap!</b> Customer account is not enabled. Please try again!');
                redirect('admin/Customers/','refresh');
            }
        }
    
        public function disableCustomer($cus_id){
    
            $data = array(
                'status' => 'In-Active'
            );
            
            $value = $this->cus_m->disableCustomer($data,$cus_id);
    
            if($value==true){
                $this->session->set_flashdata('customer_disable_succ', '<b>Heads up!</b> Customer account disabled successfully.');
                redirect('admin/Customers/','refresh');
            }
            else{
                $this->session->set_flashdata('customer_disable_err', '<b>Oh Snap!</b> Customer account is not disabled. Please try again!');
                redirect('admin/Customers/','refresh');
            }
        }
    }
?>