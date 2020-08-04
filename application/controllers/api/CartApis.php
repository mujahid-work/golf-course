<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class CartApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/CartModel', 'cart_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }


        public function add_item_to_cart_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $item_id = $this->post('item_id');
            $item_quantity = $this->post('item_quantity');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $cart_items_data = $this->cart_m->addItemToCart($user_id,$item_id,$item_quantity);

                    if(!empty($cart_items_data)){

                        foreach ($cart_items_data as $value) {
                            
                            $value->item_image = base_url().'uploads/'.$value->item_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Item added to cart and fetched current cart items successfully.",
                            'data' => $cart_items_data
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

        public function remove_item_from_cart_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $item_id = $this->post('item_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $cart_items_data = $this->cart_m->removeItemFromCart($user_id,$item_id);

                    if(!empty($cart_items_data)){
                        
                        foreach ($cart_items_data as $value) {
                            
                            $value->item_image = base_url().'uploads/'.$value->item_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Item removed from cart and fetched current cart items successfully.",
                            'data' => $cart_items_data
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

        public function update_item_quantity_in_cart_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $item_id = $this->post('item_id');
            $item_quantity = $this->post('item_quantity');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $cart_items_data = $this->cart_m->updateItemQuantityInCart($user_id,$item_id,$item_quantity);

                    if(!empty($cart_items_data)){

                        foreach ($cart_items_data as $value) {
                            
                            $value->item_image = base_url().'uploads/'.$value->item_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Item quantity updated in cart and fetched current cart items successfully.",
                            'data' => $cart_items_data
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

        public function fetch_current_user_cart_items_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $current_user_cart_items_data = $this->cart_m->fetchCurrentUserCartItems($user_id);
                    
                    if(!empty($current_user_cart_items_data)){

                        foreach ($current_user_cart_items_data as $value) {
                            
                            $value->item_image = base_url().'uploads/'.$value->item_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Fetched current user cart items successfully.",
                            'data' => $current_user_cart_items_data
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

        public function empty_user_cart_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){

                    $user_id = $user_data->id;
        
                    $value = $this->cart_m->emptyUserCart($user_id);
                    
                    if(!empty($value)){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "User cart removed successfully."
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
?>