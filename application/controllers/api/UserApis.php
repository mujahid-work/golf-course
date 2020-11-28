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

        public function fetch_user_profile_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $users_data = $this->users_m->fetchUserProfile($user_data->id);
        
                    if(!empty($users_data)){
                            
                        $users_data->user_pic = base_url().'uploads/'.$users_data->user_pic;
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "User profile fetched successfully.",
                            'data' => $users_data
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

        public function update_user_profile_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $name = $this->post('name');
            $email = $this->post('email');
            $phone = $this->post('phone');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
                    
                    $user_profile_data = array(
                        'full_name' => $name,
                        'email' => $email,
                        'phone' => $phone
                    );
                    $result = $this->users_m->updateUserProfile($user_data->id,$user_profile_data);
        
                    if($result == true){
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "User profile updated successfully."
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

        public function fetch_user_profile_image_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $users_data = $this->users_m->fetchUserProfile($user_data->id);
        
                    if(!empty($users_data)){
                            
                        $image_url = base_url().'uploads/'.$users_data->user_pic;
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "User profile image fetched successfully.",
                            'image_url' => $image_url
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

        public function update_user_profile_image_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
                  
                    $id=date('YmdHis').rand();

                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        
                        $image = $_POST['pic'];

                        if (strpos($image,'http') !== false) {
                            $data['pic'] = $image;
                        }else{
                            $image = str_replace('data:image/png;base64,', '', $image);
                            $image = str_replace(' ', '+', $image);
                            $image_name = $id.".jpeg";
                        }
                        
                    }else{
                        $this->response(array(
                            "status" => 'failed',
                            "message" => "Please Upload an image."
                          ), REST_Controller::HTTP_OK
                        );
                    }

                    $user_image_data = array(
                        'user_pic' => $image_name
                    );
        
                    $result = $this->users_m->updateUserProfileImage($user_data->id,$user_image_data);
        
                    if($result == true){

                        file_put_contents("./uploads/".$id.".jpeg",base64_decode($image));
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "User Profile image updated successfully."
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
    }
