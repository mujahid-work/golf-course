<?php

    class DashboardModel extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function fetchSubmittedOrdersCount(){

            $this->db->select("count(*) as total_submitted_orders");
            $this->db->from('sales_order_tbl');
            $this->db->where('order_status','Submitted');
            $result = $this->db->get();
            $total_submitted_orders =  $result->row();

            if(!empty($total_submitted_orders)){
                return $total_submitted_orders;
            }
            else{
                return false;
            }
        }

        public function fetchAcceptedOrdersCount(){

            $this->db->select("count(*) as total_accepted_orders");
            $this->db->from('sales_order_tbl');
            $this->db->where('order_status','Accepted');
            $result = $this->db->get();
            $total_accepted_orders =  $result->row();

            if(!empty($total_accepted_orders)){
                return $total_accepted_orders;
            }
            else{
                return false;
            }
        }

        public function fetchReadyOrdersCount(){

            $this->db->select("count(*) as total_ready_orders");
            $this->db->from('sales_order_tbl');
            $this->db->where('order_status','Ready');
            $result = $this->db->get();
            $total_ready_orders =  $result->row();

            if(!empty($total_ready_orders)){
                return $total_ready_orders;
            }
            else{
                return false;
            }
        }

        public function fetchServingOrdersCount(){

            $this->db->select("count(*) as total_serving_orders");
            $this->db->from('sales_order_tbl');
            $this->db->where('order_status','Serving');
            $result = $this->db->get();
            $total_serving_orders =  $result->row();

            if(!empty($total_serving_orders)){
                return $total_serving_orders;
            }
            else{
                return false;
            }
        }

        public function fetchCompletedOrdersCount(){

            $this->db->select("count(*) as total_completed_orders");
            $this->db->from('sales_order_tbl');
            $this->db->where('order_status','Completed');
            $result = $this->db->get();
            $total_completed_orders =  $result->row();

            if(!empty($total_completed_orders)){
                return $total_completed_orders;
            }
            else{
                return false;
            }
        }

        public function fetchCancelledOrdersCount(){

            $this->db->select("count(*) as total_cancelled_orders");
            $this->db->from('sales_order_tbl');
            $this->db->where('order_status','Cancelled');
            $result = $this->db->get();
            $total_cancelled_orders =  $result->row();

            if(!empty($total_cancelled_orders)){
                return $total_cancelled_orders;
            }
            else{
                return false;
            }
        }
        
        public function fetchUsersCount(){

            $this->db->select("count(*) as total_users");
            $this->db->from('users_tbl');
            $result = $this->db->get();
            $total_users =  $result->row();

            if(!empty($total_users)){
                return $total_users;
            }
            else{
                return false;
            }
        }

        public function fetchItemsCount(){

            $this->db->select("count(*) as total_items");
            $this->db->from('items_tbl');
            $result = $this->db->get();
            $total_items =  $result->row();

            if(!empty($total_items)){
                return $total_items;
            }
            else{
                return false;
            }
        }

        public function fetchSeatsCount(){

            $this->db->select("count(*) as total_seats");
            $this->db->from('seats_tbl');
            $result = $this->db->get();
            $total_seats =  $result->row();

            if(!empty($total_seats)){
                return $total_seats;
            }
            else{
                return false;
            }
        }

        public function updateAdminProfile($admin_profile_data,$admin_id){

            $this->db->where('id',$admin_id);
            $value=$this->db->update('admins_tbl',$admin_profile_data);

			if($value==true){
				$this->db->close();
				return true;
			}
			else{
				$this->db->close();
				return false;
			}
        }

        public function updateAdminPassword($password_data,$admin_id){

            $this->db->where('id',$admin_id);
            $value=$this->db->update('admins_tbl',$password_data);

			if($value==true){
				$this->db->close();
				return true;
			}
			else{
				$this->db->close();
				return false;
			}
        }

        public function fetchAdminProfile(){
            $this->db->select("*");
            $this->db->where('id' , $_SESSION['logged_in_id']);
            $this->db->from('admins_tbl');
            $result = $this->db->get();
            $admin_profile_data =  $result->row();

            if(!empty($admin_profile_data)){
                return $admin_profile_data;
            }
            else{
                return false;
            }
        }

        public function readNotification($notification_data,$notification_id){

            $this->db->where('id',$notification_id);
            $value = $this->db->update('notifications_tbl' , $notification_data);

            if($value==true){
                return true;
            }
            else{
                return false;
            }
        }

        public function fetchNotifications(){

            $this->db->select("notifications_tbl.* , users_tbl.full_name , sales_order_tbl.id as order_id");
            $this->db->from('notifications_tbl')
                ->join('sales_order_tbl', 'sales_order_tbl.order_no=notifications_tbl.order_no')
                ->join('users_tbl', 'users_tbl.id=notifications_tbl.user_id');
            $this->db->where("notifications_tbl.is_read", "No");
            $this->db->order_by("notifications_tbl.id", "desc");
            $result = $this->db->get();
            $notifications_data = $result->result();

            if(!empty($notifications_data)){
                return $notifications_data;
            }
            else{
                return false;
            }
        }

    }
?>