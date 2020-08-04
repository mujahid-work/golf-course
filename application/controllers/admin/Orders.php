<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Orders extends CI_Controller {

        public function __construct() {
            
            parent::__construct();
            
            $this->session->set_userdata('current_page','Orders');
            
            if(!isset($_SESSION['logged_in_id'])){
                redirect('login','refresh');
            }

            $this->load->model("admin/OrdersModel","orders_m");
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

            $orders_data = $this->orders_m->fetchAllOrders();
            $notifications_data = $this->dash_m->fetchNotifications();
            
            $data['view_to_load']="admin/pages/manage_orders";
            $data['orders_data']=$orders_data;
            $data['notifications_data']=$notifications_data;
            $data['page_title']="Submitted Orders";
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function fetchOrders($order_status) {

            $orders_data = $this->orders_m->fetchOrders($order_status);
            $notifications_data = $this->dash_m->fetchNotifications();
            
            $data['view_to_load']="admin/pages/manage_orders";
            $data['orders_data']=$orders_data;
            $data['page_title']=$order_status." Orders";
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function viewOrderDetails($order_id) {

            $order_data = $this->orders_m->fetchSingleOrder($order_id);
            $order_items_data = $this->orders_m->fetchSingleOrderItems($order_data->order_no);
            $notifications_data = $this->dash_m->fetchNotifications();
            
            $data['view_to_load']="admin/pages/view_order_details";
            $data['order_data']=$order_data;
            $data['order_items_data']=$order_items_data;
            $data['notifications_data']=$notifications_data;
            $data['page_title']="Order Details";
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function updateOrderDetails(){

            if(isset($_POST['update_order_btn'])){

                $order_id = $this->input->post('order_id_field');
                $sub_total = $this->input->post('sub_total_field');
                $discount_value = $this->input->post('discount_value_field');
                $discount_type = $this->input->post('discount_type_field');
                $tax_value = $this->input->post('tax_value_field');
                $tax_type = $this->input->post('tax_type_field');
                $order_status = $this->input->post('order_status_field');

                $tax_amount = 0;
                $discount_amount = 0;

                if($tax_type == 'amount'){
                    
                    $tax_amount = $tax_value;
                }else{
                    
                    $tax_amount = ( $sub_total / 100 ) * $tax_value;
                }

                if($discount_type == 'amount'){

                    $discount_amount = $discount_value;
                }else{ 

                    $discount_amount = ( $sub_total / 100 ) * $discount_value;
                }

                $grand_total = ($sub_total + $tax_amount) - $discount_amount;
    
                $order_data=array(
                    'discount' => $discount_value,
                    'discount_type' => $discount_type,
                    'discount_amount' => $discount_amount,
                    'tax' => $tax_value,
                    'tax_type' => $tax_type,
                    'tax_amount' => $tax_amount,
                    'order_status' => $order_status,
                    'grand_total' => $grand_total
                );

                $value=$this->orders_m->updateOrderDetails($order_data,$order_id);

                if($value==true){                    
                    $this->session->set_flashdata('order_update_succ', 'Heads up! Seat added successfully.'); 
                    redirect('admin/Orders/','refresh');
                }
                else{
                    $this->session->set_flashdata('order_update_err', 'Oh Snap! Seat is not added. Please try again!'); 
                    redirect('admin/Orders/','refresh');
                }
            }
            else{
                $this->index();
            }
        }
    }
?>