<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Chefs extends CI_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->session->set_userdata('current_page','Chefs');
            
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
            
            $chefs_data = $this->cus_m->fetchAllChefs();
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/manage_chefs";
            $data['page_title']="Manage Chefs";
            $data['chefs_data']=$chefs_data;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function viewChefDetails($chef_id) {
            
            $chef_data = $this->cus_m->fetchSingleChef($chef_id);
            $chef_orders = $this->cus_m->fetchSingleChefOrders($chef_id);
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/view_chef_details";
            $data['page_title']="Manage Chefs";
            $data['chef_data']=$chef_data;
            $data['chef_orders']=$chef_orders;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function addChef() {

            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/add_chef";
            $data['page_title']="Create Chef Account";
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function addChefAccount(){

            if(isset($_POST['add_chef_btn'])){
    
                    $chef_data=array(
                        'full_name' => $this->input->post('full_name_field'),
                        'email' => $this->input->post('email_field'),
                        'password' => md5($this->input->post('pass_field')),
                        'phone' => $this->input->post('number_field'),
                        'role' => 'Chef'
                    );
    
                    $value=$this->cus_m->addChefAccount($chef_data);
    
                    if($value==true){
                        $this->session->set_flashdata('add_chef_succ', 'Heads up! Chef added successfully.'); 
                        redirect('admin/Chefs/','refresh');
                    }
                    else{
                        $this->session->set_flashdata('add_chef_err', 'Oh Snap! Chef is not added. Please try again!'); 
                        redirect('admin/Chefs/','refresh');
                    }
            }
            else{
                $this->index();
            }
        }

        public function enableChef($chef_id){

            $data = array(
                'status' => 'Active'
            );
            
            $value = $this->cus_m->enableChef($data,$chef_id);
    
            if($value==true){
                $this->session->set_flashdata('chef_enable_succ', '<b>Heads up!</b> Chef account enabled successfully.');
                redirect('admin/Chefs/','refresh');
            }
            else{
                $this->session->set_flashdata('chef_enable_err', '<b>Oh Snap!</b> Chef account is not enabled. Please try again!');
                redirect('admin/Chefs/','refresh');
            }
        }
    
        public function disableChef($chef_id){
    
            $data = array(
                'status' => 'In-Active'
            );
            
            $value = $this->cus_m->disableChef($data,$chef_id);
    
            if($value==true){
                $this->session->set_flashdata('chef_disable_succ', '<b>Heads up!</b> Chef account disabled successfully.');
                redirect('admin/Chefs/','refresh');
            }
            else{
                $this->session->set_flashdata('chef_disable_err', '<b>Oh Snap!</b> Chef account is not disabled. Please try again!');
                redirect('admin/Chefs/','refresh');
            }
        }
    }
