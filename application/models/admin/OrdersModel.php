<?php

    class OrdersModel extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function fetchAllOrders(){

            $this->db->select("sales_order_tbl.* , users_tbl.full_name , areas_tbl.area_title , seats_tbl.seat_no , seat_types_tbl.seat_type_title");
            $this->db->from('sales_order_tbl')
            ->join('users_tbl', 'users_tbl.id = sales_order_tbl.user_id')
            ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id')
            ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id')
            ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id');
            $this->db->order_by("sales_order_tbl.id", "desc");
            $result = $this->db->get();
            $orders_data =  $result->result();

            if(!empty($orders_data)){
                return $orders_data;
            }
            else{
                return false;
            }
        }

        public function fetchOrders($order_status){

            $this->db->select("sales_order_tbl.* , users_tbl.full_name , areas_tbl.area_title , seats_tbl.seat_no , seat_types_tbl.seat_type_title");
            $this->db->from('sales_order_tbl')
            ->join('users_tbl', 'users_tbl.id = sales_order_tbl.user_id')
            ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id')
            ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id')
            ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id');
            $this->db->where('sales_order_tbl.order_status', $order_status);
            $this->db->order_by("sales_order_tbl.id", "desc");
            $result = $this->db->get();
            $orders_data =  $result->result();

            if(!empty($orders_data)){
                return $orders_data;
            }
            else{
                return false;
            }
        }

        public function fetchSingleOrder($order_id){

            $this->db->select("sales_order_tbl.* , users_tbl.full_name , seats_tbl.seat_no , seat_types_tbl.seat_type_title");
            $this->db->from('sales_order_tbl')
            ->join('users_tbl', 'users_tbl.id = sales_order_tbl.user_id')
            ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id')
            ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id');
            $this->db->where('sales_order_tbl.id', $order_id);
            $result = $this->db->get();
            $order_data =  $result->row();

            if(!empty($order_data)){
                return $order_data;
            }
            else{
                return false;
            }
        }

        public function fetchSingleOrderItems($order_no){
            $this->db->select("sales_order_items_tbl.* , items_tbl.item_title , items_tbl.item_image , main_categories_tbl.main_catg_title , sub_categories_tbl.sub_catg_title");
            $this->db->from('sales_order_items_tbl')
                ->join('items_tbl', 'sales_order_items_tbl.item_id = items_tbl.id')
                ->join('main_categories_tbl', 'items_tbl.main_catg_id = main_categories_tbl.id')
                ->join('sub_categories_tbl', 'items_tbl.sub_catg_id = sub_categories_tbl.id');
            $this->db->where('sales_order_items_tbl.order_no',$order_no);
            $this->db->order_by("sales_order_items_tbl.id", "desc");
            $result = $this->db->get();
            $order_items_data =  $result->result();

            if(!empty($order_items_data)){
                return $order_items_data;
            }
            else{
                return false;
            }
        }

        public function updateOrderDetails($order_data,$order_id){

            $this->db->where('id',$order_id);
            $value = $this->db->update('sales_order_tbl',$order_data);

            if($value==true){
                return true;
            }
            else{
                return false;
            }
        }
    }

?>