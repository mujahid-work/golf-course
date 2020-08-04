<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class ItemApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/ItemsModel', 'items_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function fetch_active_items_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $sub_catg_id = $this->post('sub_catg_id');
            $main_catg_id = $this->post('main_catg_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $items_data = $this->items_m->fetchActiveItems($sub_catg_id,$main_catg_id);
        
                    if(!empty($items_data)){

                        foreach ($items_data as $value) {
                            
                            $value->item_image = base_url().'uploads/'.$value->item_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Items fetched successfully.",
                            'data' => $items_data
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

        public function fetch_item_details_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $item_id = $this->post('item_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $item_data = $this->items_m->fetchItemDetails($item_id);
        
                    if(!empty($item_data)){
                            
                        $item_data->item_image = base_url().'uploads/'.$item_data->item_image;
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Item Details fetched successfully.",
                            'data' => $item_data
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