<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class ChatApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/ChatModel', 'chat_m');
            $this->load->model('apis/OrdersModel', 'orders_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function send_message_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');
            $message = $this->post('message');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $order_data = $this->orders_m->fetchSingleOrderDetails($order_no);

                    
                    $added_by = $user_data->role;

                    if($added_by == 'Chef'){

                        $sender_id = $user_data->id;
                        $reciever_id = $order_data->user_id;
                    }
                    else{
                        $sender_id = $user_data->id;
                        $reciever_id = $order_data->chef_id;
                    }

                    $chat_data = array(
                        'order_no' => $order_no,
                        'sender_id' => $sender_id,
                        'reciever_id' => $reciever_id,
                        'message' => $message,
                        'added_by' => $added_by 
                    );
                    
                    $result = $this->chat_m->saveMessage($chat_data);

                    if($result == true){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Message sent successfully."
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'fail',
                            "message" => "Something went wrong, please try again."
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

        public function fetch_order_based_chat_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $order_no = $this->post('order_no');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $chat_data = $this->chat_m->fetchOrderBasedChat($order_no);

                    if(!empty($chat_data)){

                        foreach ($chat_data as $value) {

                            $dt = new DateTime($value->created_at);
                            $time = $dt->format('H:i');
                            
                            $value->time = $time;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Order based chat fetched successfully.",
                            'data' => $chat_data
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

        public function fetch_chat_heads_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $chat_heads_data = $this->chat_m->fetchChatHeads($user_data->id);

                    if(!empty($chat_heads_data)){

                        // foreach ($chat_data as $value) {

                        //     $dt = new DateTime($value->created_at);
                        //     $time = $dt->format('H:i');
                            
                        //     $value->time = $time;
                        // }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Chat heads fetched successfully.",
                            'data' => $chat_heads_data
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
    }
