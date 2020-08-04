<?php

    class OrdersModel extends CI_Model {
        function __construct() {
            parent::__construct();

            $this->load->model('apis/CartModel', 'cart_m');
        }

        public function placeOrder($user_id,$seat,$seat_type,$area_id){

            $is_cart_existed = $this->cart_m->fetchCurrentUserCartItems($user_id);

            if(!empty($is_cart_existed)){

                $sub_total = 0;
                $grand_total = 0;
                $sub_total = array_sum(array_column($is_cart_existed, 'item_total'));

                $grand_total = $sub_total;
                $order_no = 'ord-'.time();

                $sales_order_data = array(
                    'user_id' => $user_id,
                    'area_id' => $area_id,
                    'seat_type_id' => $seat_type,
                    'seat_id' => $seat,
                    'order_no' => $order_no,
                    'sub_total' => $sub_total,
                    'grand_total' => $grand_total,
                    'order_status' => 'Submitted'
                );

                foreach ($is_cart_existed as $item) {
                    $sales_order_items_data[] = array(
                        'order_no' => $order_no,
                        'item_id' => $item->item_id,
                        'item_price' => $item->item_price,
                        'item_quantity' => $item->item_quantity,
                        'item_total' => $item->item_total
                    );
                }

                
                $value = $this->db->insert('sales_order_tbl',$sales_order_data);

                if($value == true){
                    
                    foreach ($sales_order_items_data as $sales_order_item) {
                        
                        $value1 = $this->db->insert('sales_order_items_tbl',$sales_order_item);
                    }

                    if($value1 == true){
                        
                        $this->cart_m->emptyUserCart($user_id);

                        $orders_data = $this->fetchCurrentUserOrders($user_id);

                        $notification_data = array(
                            'user_id' => $user_id,
                            'order_no' => $order_no,
                            'description' => 'I have placed an order by ID <br><b>'.$order_no.'</b>, please have a look.'
                        );

                        $this->addNotification($notification_data);

                        return $orders_data;
                    }
                    else{

                        $this->removeSaleOrderData($order_no);
                        return false;
                    }
                }
                else{

                    return false;
                } 
            }

            return false;
        }

        public function removeSaleOrderData($order_no){
            
            $this->db->where('order_no',$order_no);
            $value=$this->db->delete('sales_order_tbl');

            if($value==true){
                return true;
            }
            else{
                return false;
            }
        }

        public function fetchCurrentUserOrders($user_id){

            $this->db->select("sales_order_tbl.* , seat_types_tbl.seat_type_title , seat_types_tbl.seat_type_image , seats_tbl.seat_no , areas_tbl.area_title");
            $this->db->from('sales_order_tbl')
                ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id')
                ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id')
                ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id');
            $this->db->where('sales_order_tbl.user_id',$user_id);
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

        public function fetchStatusBasedOrders($order_status){

            $this->db->select("sales_order_tbl.* , seat_types_tbl.seat_type_title, seat_types_tbl.seat_type_image , seats_tbl.seat_no , areas_tbl.area_title");
            $this->db->from('sales_order_tbl')
                ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id')
                ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id')
                ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id');
            $this->db->where('sales_order_tbl.order_status',$order_status);
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

        public function fetchAreaBasedOrders($area_id){

            $this->db->select("sales_order_tbl.* , seat_types_tbl.seat_type_title, seat_types_tbl.seat_type_image , seats_tbl.seat_no , areas_tbl.area_title");
            $this->db->from('sales_order_tbl')
                ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id')
                ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id')
                ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id');
            $this->db->where('sales_order_tbl.area_id',$area_id);
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

        public function fetchSingleOrderDetails($user_id,$order_no){
            $this->db->select("sales_order_tbl.* , seat_types_tbl.seat_type_title, seat_types_tbl.seat_type_image , seats_tbl.seat_no , areas_tbl.area_title");
            $this->db->from('sales_order_tbl')
                ->join('areas_tbl', 'areas_tbl.id = sales_order_tbl.area_id')
                ->join('seat_types_tbl', 'seat_types_tbl.id = sales_order_tbl.seat_type_id')
                ->join('seats_tbl', 'seats_tbl.id = sales_order_tbl.seat_id');
            $this->db->where('sales_order_tbl.user_id',$user_id);
            $this->db->where('sales_order_tbl.order_no',$order_no);
            $result = $this->db->get();
            $order_data =  $result->row();

            if(!empty($order_data)){
                return $order_data;
            }
            else{
                return false;
            }
        }

        public function fetchSingleOrderItemsDetails($order_no){
            $this->db->select("sales_order_items_tbl.* , items_tbl.item_title , items_tbl.item_description , items_tbl.item_image");
            $this->db->from('sales_order_items_tbl')
                ->join('items_tbl', 'sales_order_items_tbl.item_id = items_tbl.id');
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

        public function cancelOrder($user_id,$order_no){

            $data = array(
                'order_status' => 'Cancelled'
            );

            $this->db->where('order_no',$order_no);
            $this->db->where('user_id',$user_id);
            $value=$this->db->update('sales_order_tbl',$data);

            if($value == true){

                return true;
            }
            else{

                return false;
            }
        }

        public function reOrder($user_id,$order_no){

            $order_details = $this->fetchSingleOrderDetails($user_id,$order_no);
            $order_items_details = $this->fetchSingleOrderItemsDetails($order_no);

            if(!empty($order_details) && !empty($order_items_details)){
                
                $order_no = 'ord-'.time();

                $sales_order_data = array(
                    'user_id' => $user_id,
                    'area_id' => $order_details->area_id,
                    'seat_type_id' => $order_details->seat_type_id,
                    'seat_id' => $order_details->seat_id,
                    'order_no' => $order_no,
                    'sub_total' => $order_details->sub_total,
                    'discount' => $order_details->discount,
                    'discount_type' => $order_details->discount_type,
                    'tax' => $order_details->tax,
                    'tax_type' => $order_details->tax_type,
                    'grand_total' => $order_details->grand_total,
                    'order_status' => 'Submitted'
                );

                $value = $this->db->insert('sales_order_tbl',$sales_order_data);

                if($value == true){
                    
                    foreach ($order_items_details as $item) {

                        $sales_order_items_data = array(
                            'order_no' => $order_no,
                            'item_id' => $item->item_id,
                            'item_price' => $item->item_price,
                            'item_quantity' => $item->item_quantity,
                            'item_total' => $item->item_total
                        );
                        
                        $value1 = $this->db->insert('sales_order_items_tbl',$sales_order_items_data);
                    }

                    if($value1 == true){

                        $orders_data = $this->fetchCurrentUserOrders($user_id);

                        return $orders_data;
                    }
                    else{

                        $this->removeSaleOrderData($order_no);
                        return false;
                    }
                }
                else{

                    return false;
                }
            }
            else{
                return false;
            }
        }

        public function addNotification($notification_data){

            $value = $this->db->insert('notifications_tbl' , $notification_data);

            if($value==true){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>