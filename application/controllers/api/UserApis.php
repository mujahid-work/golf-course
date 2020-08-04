<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class UserApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function validate_user_login_post(){

            $email = $this->post('email');					
            $password = $this->post('password');

            if(!empty($email) && !empty($password)){

                $data = array(
                    'email' => $email,
                    'password' => md5($password),
                    'status' => 'Active'
                );
        
                $user_data = $this->users_m->validateUserLogin($data);
        
                if(!empty($user_data)){
        
                    $tokken = md5($email.time());
        
                    $tokken_result = $this->users_m->updateLoginTokken($tokken,$user_data->id);
        
                    if($tokken_result == true){
                        
                        $user_data->tokken = $tokken;
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Login Successful.",
                            'user_data' => $user_data
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
                        "message" => "Invalid Credentials, Please try again."
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please provide email address and password."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        public function register_user_post() {

            $name = $this->post('name');
            $email = $this->post('email');
            $password = $this->post('password');
            $phone = $this->post('phone');

            if(!empty($email) && !empty($password) && !empty($name) && !empty($phone)){
                
                $is_existed = $this->users_m->checkExistedEmail($email);
    
                if($is_existed == true){
    
                    $this->response(array(
                        "status" => 'fail',
                        "message" => "Email already exists.",
                      ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                    
                }
                else{
        
                    $data = array(
                        'full_name' => $name,
                        'email' => $email,
                        'password' => md5($password),
                        'phone' => $phone,
                        'status' => 'Active'
                    );
        
                    $result = $this->users_m->saveUserData($data);
        
                    if($result == true){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "User registered successfully."
                          ), REST_Controller::HTTP_OK
                        );
                    }
                    else{
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Either no data found or something went wrong please try again."
                          ), REST_Controller::HTTP_OK
                        );
                    }
                }
            }
            else{

                $this->response(array(
                    "status" => 'fail',
                    "message" => "Please fill all required fileds."
                  ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }
    }
?>