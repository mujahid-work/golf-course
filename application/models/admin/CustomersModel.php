<?php

    class CustomersModel extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function fetchAllCustomers(){

            $this->db->select("*");
            $this->db->from('users_tbl');
            $this->db->where('role','Customer');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $customers_data =  $result->result();

            if(!empty($customers_data)){
                
                return $customers_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleCustomer($customer_id){

            $this->db->select("*");
            $this->db->from('users_tbl');
            $this->db->where('id',$customer_id);
            $result = $this->db->get();
            $customer_data =  $result->row();

            if(!empty($customer_data)){
                
                return $customer_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleCustomerOrders($customer_id){

            $this->db->select("sales_order_tbl.* , areas_tbl.area_title , seats_tbl.seat_no , seat_types_tbl.seat_type_title");
            $this->db->from('sales_order_tbl')
            ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id' , 'left')
            ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id' , 'left')
            ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id' , 'left');
            $this->db->where('sales_order_tbl.user_id', $customer_id);
            $this->db->order_by("sales_order_tbl.id", "desc");
            $result = $this->db->get();
            $customer_orders =  $result->result();

            if(!empty($customer_orders)){
                
                return $customer_orders;
            }
            else{
                
                return false;
            }
        }

        public function enableCustomer($data,$cus_id){

            $result = $this->db->update('users_tbl',$data,array('id'=>$cus_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function disableCustomer($data,$cus_id){

            $result = $this->db->update('users_tbl',$data,array('id'=>$cus_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function fetchAllChefs(){

            $this->db->select("*");
            $this->db->from('users_tbl');
            $this->db->where('role','Chef');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $chefs_data =  $result->result();

            if(!empty($chefs_data)){
                
                return $chefs_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleChef($chef_id){

            $this->db->select("*");
            $this->db->from('users_tbl');
            $this->db->where('id',$chef_id);
            $result = $this->db->get();
            $chef_data =  $result->row();

            if(!empty($chef_data)){
                
                return $chef_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleChefOrders($chef_id){

            $this->db->select("sales_order_tbl.* , areas_tbl.area_title , seats_tbl.seat_no , seat_types_tbl.seat_type_title");
            $this->db->from('sales_order_tbl')
            ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id' , 'left')
            ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id' , 'left')
            ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id' , 'left');
            $this->db->where('sales_order_tbl.chef_id', $chef_id);
            $this->db->order_by("sales_order_tbl.id", "desc");
            $result = $this->db->get();
            $chef_orders =  $result->result();

            if(!empty($chef_orders)){
                
                return $chef_orders;
            }
            else{
                
                return false;
            }
        }

        public function enableChef($data,$chef_id){

            $result = $this->db->update('users_tbl',$data,array('id'=>$chef_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function disableChef($data,$chef_id){

            $result = $this->db->update('users_tbl',$data,array('id'=>$chef_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function addChefAccount($chef_data){

            $result = $this->db->insert('users_tbl',$chef_data);

            if($result==true){
                return true;
            }
            else{
                return true;
            }
        }
    }
?>