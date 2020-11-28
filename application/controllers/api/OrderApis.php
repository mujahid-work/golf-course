<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class OrderApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/OrdersModel', 'orders_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function place_order_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $seat = $this->post('seat');
            $seat_type = $this->post('seat_type');
            $area_id = $this->post('area_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $order_no = $this->orders_m->placeOrder($user_id,$seat,$seat_type,$area_id);

                    if($order_no !== false){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Order placed successfully.",
                            'data' => $order_no
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function place_course_order_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $lat = $this->post('lat');
            $lang = $this->post('lang');
            $address = $this->post('address');
            $area_id = $this->post('area_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $order_no = $this->orders_m->placeCourseOrder($user_id,$lat,$lang,$address,$area_id);

                    if($order_no !== false){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Order placed successfully.",
                            'data' => $order_no
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function place_not_sitting_order_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $package = $this->post('package');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $order_no = $this->orders_m->placeNotSittingOrder($user_id,$package);

                    if($order_no !== false){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Order placed successfully.",
                            'data' => $order_no
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function fetch_current_user_orders_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $order_data = $this->orders_m->fetchCurrentUserOrders($user_id);

                    if(!empty($order_data)){

                        foreach ($order_data as $value) {

                            $dt = new DateTime($value->created_at);
                            $time = $dt->format('H:i');
                            $date = $dt->format('Y-m-d');
                            
                            $value->time = $time;
                            $value->date = $date;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Current user order list fetched successfully.",
                            'data' => $order_data
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function fetch_status_based_orders_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_status  = $this->post('order_status');
            $area_id  = $this->post('area_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $order_data = $this->orders_m->fetchStatusBasedOrders($order_status,$area_id);

                    if(!empty($order_data)){

                        foreach ($order_data as $value) {

                            $dt = new DateTime($value->created_at);
                            $time = $dt->format('H:i');
                            $date = $dt->format('Y-m-d');
                            
                            $value->time = $time;
                            $value->date = $date;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Status based order list fetched successfully.",
                            'data' => $order_data
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function fetch_area_based_orders_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $area_id  = $this->post('area_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $order_data = $this->orders_m->fetchAreaBasedOrders($area_id);

                    if(!empty($order_data)){
                        
                        foreach ($order_data as $value) {

                            $dt = new DateTime($value->created_at);
                            $time = $dt->format('H:i');
                            $date = $dt->format('Y-m-d');
                            
                            $value->time = $time;
                            $value->date = $date;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Area based order list fetched successfully.",
                            'data' => $order_data
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function fetch_single_order_details_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $order_data = $this->orders_m->fetchSingleOrderDetails($order_no);
                    $order_items_data = $this->orders_m->fetchSingleOrderItemsDetails($order_no);

                    if(!empty($order_data)){

                        $dt = new DateTime($order_data->created_at);
                        $time = $dt->format('H:i');
                        $date = $dt->format('Y-m-d');
                        $order_data->time = $time;
                        $order_data->date = $date;

                        foreach ($order_items_data as $value) {
                            
                            $value->item_image = base_url().'uploads/'.$value->item_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Order details fetched placed.",
                            'data' => array(
                                'order_data' => $order_data,
                                'order_items_data' => $order_items_data
                            )
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function cancel_order_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $value = $this->orders_m->cancelOrder($user_id,$order_no);

                    if($value == true){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Order cancelled successfully."
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function re_order_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $orders_data = $this->orders_m->reOrder($user_id,$order_no);

                    if(!empty($orders_data)){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Your re-order request successfull.",
                            "data" => $orders_data
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Either no data found or something went wrong, please try again."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function update_order_status_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');
            $order_status = $this->post('order_status');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    if(!empty($order_status)){
                        $value = $this->orders_m->updateOrderStatus($order_no,$order_status,$user_data->id);

                        if($value == true){
        
                            $this->response(array(
                                "status" => 'success',
                                "message" => "Order status updated successfully."
                              ), REST_Controller::HTTP_OK
                            );
                        }else{
        
                            $this->response(array(
                                "status" => 'fail',
                                "message" => "Either no data found or something went wrong, please try again."
                              ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                            );
                        }
                    }else{
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Please provide a status for order."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                                    
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function update_order_time_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');
            $expected_time = $this->post('expected_time');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    if(!empty($expected_time)){
                        $value = $this->orders_m->updateOrderTime($order_no,$expected_time);

                        if($value == true){
        
                            $this->response(array(
                                "status" => 'success',
                                "message" => "Order expected time updated successfully."
                              ), REST_Controller::HTTP_OK
                            );
                        }else{
        
                            $this->response(array(
                                "status" => 'fail',
                                "message" => "Either no data found or something went wrong, please try again."
                              ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                            );
                        }
                    }else{
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Please provide a expected time for order."
                          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }                                    
                }
                else{
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Invalid tokken, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide a tokken."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

    }
