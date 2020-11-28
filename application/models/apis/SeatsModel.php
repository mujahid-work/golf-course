<?php

    class SeatsModel extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        public function fetchSeats($seat_type,$area_id){

            $this->db->select("seats_tbl.* , seat_types_tbl.seat_type_title , seat_types_tbl.seat_type_image , areas_tbl.area_title , areas_tbl.area_image");
            $this->db->from('seats_tbl')
                ->join('areas_tbl', 'areas_tbl.id = seats_tbl.area_id' , 'left')
                ->join('seat_types_tbl', 'seats_tbl.seat_type = seat_types_tbl.id' , 'left');
            $this->db->where('seats_tbl.seat_type' , $seat_type);
            $this->db->where('seats_tbl.area_id' , $area_id);
            $this->db->order_by("seats_tbl.seat_no", "desc");
            $result = $this->db->get();
            $seats_data = $result->result();

            if(!empty($seats_data)){
                
                return $seats_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchActiveSeatTypes($area_id){

            $this->db->select("seat_types_tbl.* , areas_tbl.area_title , areas_tbl.area_image");
            $this->db->from('seat_types_tbl')
                ->join('areas_tbl', 'areas_tbl.id=seat_types_tbl.area_id' , 'left');
            $this->db->where('seat_types_tbl.area_id' , $area_id);
            $this->db->where('seat_types_tbl.seat_type_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $seat_types_data = $result->result();

            if(!empty($seat_types_data)){
                
                return $seat_types_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchActiveAreas(){

            $this->db->select("*");
            $this->db->from('areas_tbl');
            $this->db->where('area_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $areas_data = $result->result();

            if(!empty($areas_data)){
                
                return $areas_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchAreaTimings($area_id){

            $this->db->select("*");
            $this->db->from('area_timings_tbl');
            $this->db->where('area_id' , $area_id);
            $result = $this->db->get();
            $area_timings_data = $result->result();

            if(!empty($area_timings_data)){
                
                return $area_timings_data;
            }
            else{
                
                return false;
            }
        }
    }
