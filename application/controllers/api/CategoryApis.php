<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class CategoryApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/CategoriesModel', 'catgs_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function fetch_active_main_categories_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $main_catgs_data = $this->catgs_m->fetchActiveMainCategories();
        
                    if(!empty($main_catgs_data)){

                        foreach ($main_catgs_data as $value) {
                            
                            $value->main_catg_image = base_url().'uploads/'.$value->main_catg_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Main Categories fetched successfully.",
                            'data' => $main_catgs_data
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

        public function fetch_active_sub_categories_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $main_catg_id = $this->post('main_catg_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $sub_catgs_data = $this->catgs_m->fetchActiveSubCategories($main_catg_id);
        
                    if(!empty($sub_catgs_data)){

                        foreach ($sub_catgs_data as $value) {
                            
                            $value->sub_catg_image = base_url().'uploads/'.$value->sub_catg_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Sub Categories fetched successfully.",
                            'data' => $sub_catgs_data
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