<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'libraries/REST_Controller.php';

    class EventApis extends REST_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('apis/EventsModel', 'events_m');
            $this->load->model('apis/UsersModel', 'users_m');
        }

        public function fetch_active_events_post(){ //tested and working fine

            $tokken = $this->post('tokken');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $events_data = $this->events_m->fetchActiveEvents();
        
                    if(!empty($events_data)){

                        foreach ($events_data as $value) {
                            
                            $value->event_image = base_url().'uploads/'.$value->event_image;
                        }
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Events data fetched successfully.",
                            'data' => $events_data
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

        public function fetch_single_event_post(){ //tested and working fine

            $tokken = $this->post('tokken');
            $event_id = $this->post('event_id');

            if(!empty($tokken)){

                $data = array(
                    'tokken' => $tokken
                );
        
                $user_data = $this->users_m->validateUserTokken($data);
        
                if(!empty($user_data)){
        
                    $event_data = $this->events_m->fetchEventDetails($event_id);
        
                    if(!empty($event_data)){
                            
                        $event_data->event_image = base_url().'uploads/'.$event_data->event_image;
    
                        $this->response(array(
                            "status" => 'success',
                            "message" => "Event Details fetched successfully.",
                            'data' => $event_data
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