<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Seats extends CI_Controller {

        public function __construct() {
            
            parent::__construct();
            
            $this->session->set_userdata('current_page','Seats');
            
            if(!isset($_SESSION['logged_in_id'])){
                redirect('login','refresh');
            }

            $this->load->model("admin/SeatsModel","seats_m");
            $this->load->model("admin/DashboardModel","dash_m");
		
            $total_submitted_orders = $this->dash_m->fetchSubmittedOrdersCount();
            $total_accepted_orders = $this->dash_m->fetchAcceptedOrdersCount();
            $total_ready_orders = $this->dash_m->fetchReadyOrdersCount();
            $total_serving_orders = $this->dash_m->fetchServingOrdersCount();
            $total_completed_orders = $this->dash_m->fetchCompletedOrdersCount();
            $total_cancelled_orders = $this->dash_m->fetchCancelledOrdersCount();

            $orders_count = array(
                'total_submitted_orders' => $total_submitted_orders->total_submitted_orders,
                'total_accepted_orders' => $total_accepted_orders->total_accepted_orders,
                'total_ready_orders' => $total_ready_orders->total_ready_orders,
                'total_serving_orders' => $total_serving_orders->total_serving_orders,
                'total_completed_orders' => $total_completed_orders->total_completed_orders,
                'total_cancelled_orders' => $total_cancelled_orders->total_cancelled_orders
            );

            $this->session->set_userdata('orders_count',$orders_count);
        }

        public function index() {

            $all_seats_data = $this->seats_m->fetchAllSeats();
            $all_active_seat_types_data = $this->seats_m->fetchAllActiveSeatTypes();
            $all_active_areas_data = $this->seats_m->fetchAllActiveAreas();
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/manage_seats";
            $data['page_title']="Manage Seats";
            $data['all_seats_data']=$all_seats_data;
            $data['all_active_seat_types_data']=$all_active_seat_types_data;
            $data['all_active_areas_data']=$all_active_areas_data;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function seatTypes() {

            $all_seat_types_data = $this->seats_m->fetchAllSeatTypes();
            $all_active_areas_data = $this->seats_m->fetchAllActiveAreas();
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/manage_seat_types";
            $data['page_title']="Manage Seat Types";
            $data['all_seat_types_data']=$all_seat_types_data;
            $data['all_active_areas_data']=$all_active_areas_data;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function areas() {

            $all_areas_data = $this->seats_m->fetchAllAreas();
            $area_seat_types_data = $this->seats_m->fetchAllSeatTypesForArea();
            $notifications_data = $this->dash_m->fetchNotifications();

            $data['view_to_load']="admin/pages/manage_areas";
            $data['page_title']="Manage Areas";
            $data['all_areas_data']=$all_areas_data;
            $data['area_seat_types_data']=$area_seat_types_data;
            $data['notifications_data']=$notifications_data;
            $this->load->view('admin/layouts/dashboard_layout',$data);
        }

        public function addSeat(){

            if(isset($_POST['seat_add_btn'])){
    
                $this->form_validation->set_rules('seat_no_field','Seat No','trim|required');
                $this->form_validation->set_rules('seat_type_field','Seat Type','trim|required');
                $this->form_validation->set_rules('area_field','Area','trim|required');
    
                if($this->form_validation->run()==TRUE){
    
                    $seat_data=array(
                        'seat_no' => $this->input->post('seat_no_field'),
                        'area_id' => $this->input->post('area_field'),
                        'seat_type' => $this->input->post('seat_type_field')
                    );
    
                    $value=$this->seats_m->addSeat($seat_data);
    
                    if($value==true){
                        $this->session->set_flashdata('seat_add_succ', 'Heads up! Seat added successfully.'); 
                        redirect('admin/Seats/','refresh');
                    }
                    else{
                        $this->session->set_flashdata('seat_add_err', 'Oh Snap! Seat is not added. Please try again!'); 
                        redirect('admin/Seats/','refresh');
                    }
                }
                else{
                    $this->index();
                }
            }
            else{
                $this->index();
            }
        }

        public function deleteSeat($seat_id){
            
            $value = $this->seats_m->deleteSeat($seat_id);
    
            if($value==true){
                $this->session->set_flashdata('seat_del_succ', '<b>Heads up!</b> Seat deleted successfully.');
                redirect('admin/Seats/','refresh');
            }
            else{
                $this->session->set_flashdata('seat_del_err', '<b>Oh Snap!</b> Seat is not deleted. Please try again!');
                redirect('admin/Seats/','refresh');
            }
        }

        public function fetchSingleSeat(){

            $seat_id = $this->input->post('id');
    
            $single_seat_data = $this->seats_m->fetchSingleSeat($seat_id);
    
            echo json_encode(array(
                'single_seat_data' => $single_seat_data
            ));
        }

        public function updateSeat(){
            
            $seat_id = $this->input->post('id_field');
    
            $seat_data=array(
                'seat_no' => $this->input->post('seat_no_edit_field'),
                'area_id' => $this->input->post('area_edit_field'),
                'seat_type' => $this->input->post('seat_type_edit_field')
            );
    
            $value=$this->seats_m->updateSeat($seat_data,$seat_id);
    
            if($value==true){
                $this->session->set_flashdata('seat_edit_succ', 'Heads up! Seat updated successfully.');
                echo json_encode(array(
                    'status' => 'success'
                ));
            }
            else{
                $this->session->set_flashdata('seat_edit_err', 'Oh Snap! Seat is not updated. Please try again!');
                echo json_encode(array(
                    'status' => 'fail'
                ));
            }
        }

        public function addSeatType(){

            if(isset($_POST['seat_type_add_btn'])){
    
                $this->form_validation->set_rules('seat_type_title_field','Seat Type Title','trim|required');
    
                if($this->form_validation->run()==TRUE){

                    $seat_type_pic='';
						
                    $_FILES['file']['name']       = $_FILES['seat_type_image_field']['name'];
                    $_FILES['file']['type']       = $_FILES['seat_type_image_field']['type'];
                    $_FILES['file']['tmp_name']   = $_FILES['seat_type_image_field']['tmp_name'];
                    $_FILES['file']['error']      = $_FILES['seat_type_image_field']['error'];
                    $_FILES['file']['size']       = $_FILES['seat_type_image_field']['size'];
                    
                    $uploadPath = './uploads/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if($this->upload->do_upload('file')){
                        
                        $attachmentData = $this->upload->data();
                        $seat_type_pic = $attachmentData['file_name'];
                    }
    
                    $seat_type_data=array(
                        'area_id' => $this->input->post('area_field'),
                        'seat_type_title' => $this->input->post('seat_type_title_field'),
                        'seat_type_status' => 'Active',
                        'seat_type_image' => $seat_type_pic
                    );
    
                    $value=$this->seats_m->addSeatType($seat_type_data);
    
                    if($value==true){
                        $this->session->set_flashdata('seat_type_add_succ', 'Heads up! Seat Type added successfully.'); 
                        redirect('admin/Seats/seatTypes','refresh');
                    }
                    else{
                        $this->session->set_flashdata('seat_type_add_err', 'Oh Snap! Seat Type is not added. Please try again!'); 
                        redirect('admin/Seats/seatTypes','refresh');
                    }
                }
                else{
                    $this->index();
                }
            }
            else{
                $this->index();
            }
        }

        public function fetchSingleSeatType(){

            $seat_type_id = $this->input->post('id');
    
            $single_seat_type_data = $this->seats_m->fetchSingleSeatType($seat_type_id);
    
            echo json_encode(array(
                'single_seat_type_data' => $single_seat_type_data
            ));
        }

        public function updateSeatType(){
            
            $seat_type_pic='';
            $seat_type_id = $this->input->post('id_field');
            $area_id = $this->input->post('area_edit_field');
            $seat_type_pic = $this->input->post('seat_type_old_pic_field');
                            
            $_FILES['file']['name']       = $_FILES['seat_type_edit_image_field']['name'];
            $_FILES['file']['type']       = $_FILES['seat_type_edit_image_field']['type'];
            $_FILES['file']['tmp_name']   = $_FILES['seat_type_edit_image_field']['tmp_name'];
            $_FILES['file']['error']      = $_FILES['seat_type_edit_image_field']['error'];
            $_FILES['file']['size']       = $_FILES['seat_type_edit_image_field']['size'];
            
            $uploadPath = './uploads/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = '*';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('file')){
                
                $attachmentData = $this->upload->data();
                $seat_type_pic = $attachmentData['file_name'];
            }
    
            $seat_type_data=array(
                'area_id' => $area_id,
                'seat_type_title' => $this->input->post('seat_type_title_edit_field'),
                'seat_type_image' => $seat_type_pic
            );
    
            $value=$this->seats_m->updateSeatType($seat_type_data,$seat_type_id);
    
            if($value==true){
                $this->session->set_flashdata('seat_type_edit_succ', 'Heads up! Seat Type updated successfully.');
                echo json_encode(array(
                    'status' => 'success'
                ));
            }
            else{
                $this->session->set_flashdata('seat_type_edit_err', 'Oh Snap! Seat Type is not updated. Please try again!');
                echo json_encode(array(
                    'status' => 'fail'
                ));
            }
        }

        public function enableSeatType($seat_type_id){

            $data = array(
                'seat_type_status' => 'Active'
            );
            
            $value = $this->seats_m->enableSeatType($data,$seat_type_id);
    
            if($value==true){
                $this->session->set_flashdata('seat_type_enable_succ', '<b>Heads up!</b> Seat Type enabled successfully.');
                redirect('admin/Seats/seatTypes','refresh');
            }
            else{
                $this->session->set_flashdata('seat_type_enable_err', '<b>Oh Snap!</b> Seat Type is not enabled. Please try again!');
                redirect('admin/Seats/seatTypes','refresh');
            }
        }
    
        public function disableSeatType($seat_type_id){
    
            $data = array(
                'seat_type_status' => 'In-Active'
            );
            
            $value = $this->seats_m->disableSeatType($data,$seat_type_id);
    
            if($value==true){
                $this->session->set_flashdata('seat_type_disable_succ', '<b>Heads up!</b> Seat Type disabled successfully.');
                redirect('admin/Seats/seatTypes','refresh');
            }
            else{
                $this->session->set_flashdata('seat_type_disable_err', '<b>Oh Snap!</b> Seat Type is not disabled. Please try again!');
                redirect('admin/Seats/seatTypes','refresh');
            }
        }

        public function addArea(){

            if(isset($_POST['area_add_btn'])){
    
                $this->form_validation->set_rules('area_title_field','Area Title','trim|required');
    
                if($this->form_validation->run()==TRUE){

                    $area_pic='';
						
                    $_FILES['file']['name']       = $_FILES['area_image_field']['name'];
                    $_FILES['file']['type']       = $_FILES['area_image_field']['type'];
                    $_FILES['file']['tmp_name']   = $_FILES['area_image_field']['tmp_name'];
                    $_FILES['file']['error']      = $_FILES['area_image_field']['error'];
                    $_FILES['file']['size']       = $_FILES['area_image_field']['size'];
                    
                    $uploadPath = './uploads/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if($this->upload->do_upload('file')){
                        
                        $attachmentData = $this->upload->data();
                        $area_pic = $attachmentData['file_name'];
                    }
    
                    $area_data=array(
                        'area_title' => $this->input->post('area_title_field'),
                        'area_status' => 'Active',
                        'area_image' => $area_pic
                    );
    
                    $value=$this->seats_m->addArea($area_data);
    
                    if($value==true){
                        $this->session->set_flashdata('area_add_succ', 'Heads up! Area added successfully.'); 
                        redirect('admin/Seats/areas','refresh');
                    }
                    else{
                        $this->session->set_flashdata('area_add_err', 'Oh Snap! Area is not added. Please try again!'); 
                        redirect('admin/Seats/areas','refresh');
                    }
                }
                else{
                    $this->index();
                }
            }
            else{
                $this->index();
            }
        }

        public function fetchSingleArea(){

            $area_id = $this->input->post('id');
    
            $single_area_data = $this->seats_m->fetchSingleArea($area_id);
    
            echo json_encode(array(
                'single_area_data' => $single_area_data
            ));
        }

        public function updateArea(){
            
            $area_pic='';
            $area_id = $this->input->post('id_field');
            $area_pic = $this->input->post('area_old_pic_field');
                            
            $_FILES['file']['name']       = $_FILES['area_edit_image_field']['name'];
            $_FILES['file']['type']       = $_FILES['area_edit_image_field']['type'];
            $_FILES['file']['tmp_name']   = $_FILES['area_edit_image_field']['tmp_name'];
            $_FILES['file']['error']      = $_FILES['area_edit_image_field']['error'];
            $_FILES['file']['size']       = $_FILES['area_edit_image_field']['size'];
            
            $uploadPath = './uploads/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = '*';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('file')){
                
                $attachmentData = $this->upload->data();
                $area_pic = $attachmentData['file_name'];
            }
    
            $area_data=array(
                'area_title' => $this->input->post('area_title_edit_field'),
                'area_image' => $area_pic
            );
    
            $value=$this->seats_m->updateArea($area_data,$area_id);
    
            if($value==true){
                $this->session->set_flashdata('area_edit_succ', 'Heads up! Area updated successfully.');
                echo json_encode(array(
                    'status' => 'success'
                ));
            }
            else{
                $this->session->set_flashdata('area_edit_err', 'Oh Snap! Area is not updated. Please try again!');
                echo json_encode(array(
                    'status' => 'fail'
                ));
            }
        }

        public function enableArea($area_id){

            $data = array(
                'area_status' => 'Active'
            );
            
            $value = $this->seats_m->enableArea($data,$area_id);
    
            if($value==true){
                $this->session->set_flashdata('area_enable_succ', '<b>Heads up!</b> Area enabled successfully.');
                redirect('admin/Seats/areas','refresh');
            }
            else{
                $this->session->set_flashdata('area_enable_err', '<b>Oh Snap!</b> Area is not enabled. Please try again!');
                redirect('admin/Seats/areas','refresh');
            }
        }
    
        public function disableArea($area_id){
    
            $data = array(
                'area_status' => 'In-Active'
            );
            
            $value = $this->seats_m->disableArea($data,$area_id);
    
            if($value==true){
                $this->session->set_flashdata('area_disable_succ', '<b>Heads up!</b> Area disabled successfully.');
                redirect('admin/Seats/areas','refresh');
            }
            else{
                $this->session->set_flashdata('area_disable_err', '<b>Oh Snap!</b> Area is not disabled. Please try again!');
                redirect('admin/Seats/areas','refresh');
            }
        }
    }
?>