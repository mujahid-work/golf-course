<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class SeatApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/SeatsModel', 'seats_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function fetch_areas_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $areas_data = $this->seats_m->fetchActiveAreas();
        
                    if(!empty($areas_data)){

                        foreach ($areas_data as $value) {
                            
                            $value->area_image = base_url().'uploads/'.$value->area_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Areas fetched successfully.",
                            'data' => $areas_data
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

        public function fetch_seat_types_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $area_id = $this->post('area_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $seat_types_data = $this->seats_m->fetchActiveSeatTypes($area_id);
        
                    if(!empty($seat_types_data)){

                        foreach ($seat_types_data as $value) {
                            
                            $value->area_image = base_url().'uploads/'.$value->area_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Seat Types fetched successfully.",
                            'data' => $seat_types_data
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

        public function fetch_seats_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $seat_type = $this->post('seat_type');
            $area_id = $this->post('area_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $seats_data = $this->seats_m->fetchSeats($seat_type,$area_id);
        
                    if(!empty($seats_data)){

                        foreach ($seats_data as $value) {
                            
                            $value->area_image = base_url().'uploads/'.$value->area_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Seats fetched successfully.",
                            'data' => $seats_data
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